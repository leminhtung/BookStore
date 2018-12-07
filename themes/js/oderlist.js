function  searchOMbyDate($date) {
    window.console.log($date);
    $.post('searchOrderList', {dateO: $date}, function($oDMList) {
        window.console.log($oDMList);
        var tableOM = $('.oMView');
        $(tableOM).empty();
        $.each($oDMList, function(key, oderMaster) {
            var tr = $('<tr><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td><td><p></p></td></tr>');
            $(tr).children().eq(0).addClass('order-number').append('<a href="searchOrderServlet?action=orderDetailCustomer&orderID='+oderMaster[0]+'">' + oderMaster[0] + '</a>');
            $date = null;
            $date = new Date(oderMaster[1]);
            $(tr).children().eq(1).append(('0' + $date.getDate()).slice(-2) + '/' + ('0' + ($date.getMonth() + 1)).slice(-2) + '/' + $date.getFullYear());
            $(tr).children().eq(2).append(oderMaster[2]);
            $(tr).children().eq(3).append(oderMaster[3]);
            $(tr).children().eq(4).append('$' + oderMaster[4].toFixed(1));
            tr.appendTo(tableOM);
        });
    });

}