<html>
<head>
	<title>Admin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body>
<?php

		if(isset($_POST['submit'])){ // Người dùng đã ấn submit
		    if($_FILES['file']['name'] != NULL){ // Đã chọn file
		        // Tiến hành code upload file
		        if($_FILES['file']['type'] == "image/jpeg"
		        || $_FILES['file']['type'] == "image/png"
		        || $_FILES['file']['type'] == "image/gif"){
		        
		            if($_FILES['file']['size'] > 1048576){
		                echo "File không được lớn hơn 1mb";
		            }else{
		                
		                $path = "../../views/Contents/images/";
		                $tmp_name = $_FILES['file']['tmp_name'];
		                $name = $_FILES['file']['name'];
		                $type = $_FILES['file']['type']; 
		                $size = $_FILES['file']['size']; 
		                
		                move_uploaded_file($tmp_name,$path.$name);
		                echo "Hình ảnh đã đượ tải lên! </br>";
		                echo "Tên file : ".$name."<br />";
		                echo "Kiểu file : ".$type."<br />";
		                echo "File size : ".$size;
		           }
		        }else{		           
		           echo "Kiểu file không hợp lệ";
		        }
		   }else{
		        echo "Vui lòng chọn file";
		   }
		}
?>

</body>
</html>
