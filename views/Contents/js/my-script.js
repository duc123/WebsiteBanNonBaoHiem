function cartAction(action, sanpham_id) {
    var queryString = "";
    if (action !== "") {
        switch (action) {
            case "add":
                queryString = 'action=' + action + '&id=' + sanpham_id;
                break;
            case "remove":
                queryString = 'action=' + action + '&id=' + sanpham_id;
                break;
            case "empty":
                queryString = 'action=' + action;
        }
    }
    $.ajax({
        url: "/WebsiteBanHang/controllers/cart_action.php",
        data: queryString,
        dataType: 'json',
        type: "POST",
        success: function (data) {
            $("#cart-total").html(data.tong_so_luong);
            $('#price').html(data.tong_tien);
            if (action === "add") {
                alert("Đã thêm hàng vào giỏ");
            }
            if (action === "remove") {
                deleteRow(data.rowid);
            }
            if (action === "empty") {
                $("#tbody").html("");
            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("Xay ra loi " + jqXHR.status() + " " + textStatus);
        }
    });
}

function deleteRow(rowid) {
    var row = document.getElementById(rowid);
    row.parentNode.removeChild(row);
}

$().ready(function(){
   $("#form1").validate({
       rules:{
           ten: "required",
           email:{
               required: true,
               email: true,
               remote: {
                   url: "/WebsiteBanHang/controllers/check-email.php",
                   type: "POST"
               }
           },
           diachi: "required",
           quan_huyen: "required",
           thanhpho: "required",
           phuong_xa: "required",
           dtthoai: {
               required: true,
               maxlength: 10,
               minlength: 10,
               digits: true
           }
       },
       submitHandler: function(form){
           swal({
               title: "Bạn muốn đặt hàng?",
               text: "Xin hãy kiểm tra kỹ thông tin !, Sau khi đăt hàng xin hãy kiểm tra email, và shop sẽ gọi số điện thoại được nhập để kiểm tra",
               type: "info",
               showCancelButton: true,
               confirmButtonClass: "btn btn-primary",
               confirmButtonText: "Đặt hàng!",
               closeOnConfirm: true
           },function(){
               form.submit();
           });
       },
       messages:{
           ten: "Bạn cần nhập tên người nhận",
           email: {
               required: "Shop cần email để gửi phiếu đặt hàng cho bạn",
               email: "Email phải đúng định dạng examlpe@domain.com",
               remote: "Đã có tài khoản tồn tại với email này xin hãy đăng nhập"
           },
           diachi: "cần nhập địa chỉ",
           quan_huyen: "cần chọn quận-huyện",
           thanhpho: "cần chọn thành phố",
           phuong_xa: "cần chọn phường-xã",
           dtthoai: {
               required: "cần nhập điện thoại để shop có thể liên lạc để xác nhận đơn hàng",
               maxlength: "nhập số điện thoại gồm 10 số",
               minlength: "nhập số điện thoại gồm 10 số",
               digits: "nhập số điện thoại gồm 10 số"
           }
       }
   }); 
});