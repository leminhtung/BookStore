<?php

// initialize shopping cart class

include 'Cart.php';

$cart = new Cart;

// include database configuration file

include 'dbConfig.php';
function lastId($queryID) {
    sqlsrv_next_result($queryID);
    sqlsrv_fetch($queryID);
    return sqlsrv_get_field($queryID, 0);
}

if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])) {
        $productID = $_REQUEST['id'];

        // get product details

        $query = sqlsrv_query($conn, "SELECT * FROM Books WHERE BookID = " . $productID);
        
        $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        $itemData = array(
            'id' => $row['BookID'],
            'name' => $row['BookName'],
            'price' => $row['Price'],
            'qty' => isset($_REQUEST['qty']) ? $_REQUEST['qty'] : 1
        );
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem ? 'viewCart.php' : 'index.php';
        header("Location: " . $redirectLoc);
    }
    elseif ($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])) {
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem ? 'ok' : 'err';
        die;
    }
    elseif ($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }
    elseif ($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])) {

        // insert order details into database
        $insertOrder = sqlsrv_query($conn,"INSERT INTO Orders (UsersID, total_price, created, modified, Status, Enabled) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', 1, 1); SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME");
        if ($insertOrder) {
            $orderID = lastId($insertOrder);
            $sql = '';

            // get cart items

            $cartItems = $cart->contents();
            foreach($cartItems as $item) {
                $insertOrderItems  = sqlsrv_query($conn,"INSERT INTO OrdersDetail (OrderID, BookID, Quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');");

            }

            // insert order items into database

            if ($insertOrderItems) {
                $sql = "UPDATE Books SET Quantity=Quantity-" . $item['qty']. " WHERE BookID=".$item['id'];
                sqlsrv_query($conn, $sql);
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }
            else {
                print_r(sqlsrv_errors());

                // header("Location: checkout.php");

            }
        }
        else {
             print_r(sqlsrv_errors());
            //header("Location: checkout.php");
        }
    }
    elseif ($_REQUEST['action'] == 'd') {
$cart->destroy();
    }
    else {
        header("Location: index.php");
    }
}
else {
        header("Location: index.php");
    }
?>