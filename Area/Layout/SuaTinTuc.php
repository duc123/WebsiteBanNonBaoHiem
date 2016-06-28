<html>
<head>
    <title>SỬA TIN TỨC</title>
    <link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<?php
include 'MenuAdmin.php';
?>

<?php

include '../../Controller/ActionController.php';
$ac = new ActionController;
$temp = $_GET["MaQuangCao"];
$res = $ac->DetailoneNews($temp);
$list = $ac->GetLoaiTinTuc();

while($row = $res->fetch_assoc()) {
echo'

<form action="../Action/SuaTin.php" method="post">

    <input type="hidden" name="MaQuangCao" value="'.$row['MaQuangCao'].'" />

    <div>
        <label>Tiêu đề </label>
        <br />
        <input type="text" name="Tieude" value="'.$row['Tieude'].'" required />
    </div>

    <div>
        <label>Nội dung ngắn</label>
        <br />
        <input type="text" name="NoiDung" value="'.$row['NoiDung'].'" required />
    </div>

    <div>
        <label>Link </label>
        <br />
        <input type="text" name="Link" value="'.$row['Link'].'" required />
    </div>
    <div>
        <label>Ngày đăng </label>
        <br />
        <input type="datetime" name="NgayDang" value="'.$row['NgayDang'].'" required />
    </div>
    <div>
            <label>Loại </label>
                    <br />
                    <select name="loai">
                        <option value="'.$row['LoaiQuangCao_MaLoaiQuangCao'].'">'.$row['LoaiQuangCao_MaLoaiQuangCao'].'</option>';

            while($rows = $list->fetch_assoc())
            {
                 echo '	  <option value="'.$rows['LoaiQuangCao_MaLoaiQuangCao'].'">'.$rows['TenLoaiQuangCao'].'</option>		';
            }
        echo'
          	 </select>
    </div>
    <div>
        <label>Hình Ảnh </label>
                    <br />
                    <select class="sls" name="img">
                        <option value="'.$row['HInhAnh'].'">'.$row['HInhAnh'].'</option>
                            ';
                        $directory = "../../IMG/";
                        $images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                        $temp = "col-md-4";

                        foreach($images as $image)
                        {
                            $loc1 = strstr($image , "IMG/");
                            $loc2 = strstr($loc1 , "/");
                            $loc3 = substr($loc2 ,1);

                            echo ' <option value="'.$loc3.'">'.$loc3.' </option>';
                        }echo'
                     </select>
    </div>
         <img class="img-responsive" id="imgshow" src="../../IMG/ICON_HOME.jpg">
          <br />
           <input type="Submit" value="Submit" class="btn btn-default" />
</form>
    ';
}
?>

<script src="../../JS/jquery-2.2.4.min.js"></script>
<script src="../../JS/bootstrap.min.js"></script>
<script type="text/javascript">
    var str = "";
    str +="../../IMG/" + $(".sls option:selected").text() + " ";
    $('#imgshow').attr('src',str);

    $('.sls').change(function() {
        var str = "";
        $(".sls option:selected").each(function() {
            str +="../../IMG/" + $(this).text() + " ";
        });
        $('#imgshow').attr('src',str);
    });

</script>

</body>
</html>