
function initMap() {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 10.787573, lng: 106.665183}
    });
    var marker = new google.maps.Marker({
        position: {lat: 10.787573, lng: 106.665183},
        title: 'Tech Line Company',
        animation: google.maps.Animation.BOUNCE,
        map: map});
    directionsDisplay.setMap(map);
    var valueEnd = document.getElementById('end').value;
    if (valueEnd !== null) {
        var onChangeHandler = function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('end').addEventListener('blur', onChangeHandler);

    }

}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: {lat: 10.787573, lng: 106.665183},
        destination: document.getElementById('end').value,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            computeTotalDistance(directionsDisplay.getDirections());
        } else {
            sweetAlert("Oops...", "Please input address correctly", "error");
            document.getElementById('btnCheckOut').disabled = true;
        }
    });
}

// ham xu ly tinh khoang cach
function computeTotalDistance(result) {
    var total = 0;
    var hour = "";
    var myroute = result.routes[0];
    var productSubTotal = 0;
    var memberDiscount = 0;
    productSubTotal = document.getElementById("txtProductTotalPrice").value;
    memberDiscount = document.getElementById("txtMemberDiscounts").value;
    total = myroute.legs[0].distance.value;
    hour = myroute.legs[0].duration.text;
    total = total / 1000;
    $.post('MapServlet', {
        action: "countDeliveryFee",
        distance: total
    }, function(jsonResponse) {
//        window.alert(jsonResponse);
        var tongFEE = jsonResponse.fee;
        var tongFEE2 = jsonResponse.fee;
        document.getElementById("deliveryFee").innerHTML = tongFEE;
        document.getElementById("deliveryFee2").innerHTML = tongFEE2;
        document.getElementById("totalPriceOrder").innerHTML = parseInt(tongFEE2) + parseInt(productSubTotal) - parseInt(memberDiscount);
        document.getElementById("txtTotalPrice").value = parseInt(tongFEE2) + parseInt(productSubTotal) - parseInt(memberDiscount);
    });
    document.getElementById("hourID").innerHTML = hour;
    document.getElementById("distanceID").innerHTML = total;
    document.getElementById("btnCheckOut").disabled = false;
}
