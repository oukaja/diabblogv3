$("document").ready(function () {
    $(".datep").change(function () {
        var d="0"+new Date($(this).val()).getDay()+"-0"+new Date($(this).val()).getMonth()+"-"+new Date($(this).val()).getFullYear();
        console.log(d);
       $.ajax({
            type: 'get',
            url: "http://127.0.0.1/diabblogv3/web/app_dev.php/admin/visite/list/" + d,
            beforeSend: function () {
                console.log("ok");
            },
            success: function (data) {
               
                console.log(typeof data);
            }
        });
    });
});
