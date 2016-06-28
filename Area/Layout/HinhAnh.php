<?php
    session_start();
?>
<?php
    if($_SESSION["user"] && $_SESSION["pass"])
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>HÌNH ẢNH</title>
    <link href="../../IMG/ICON_HOME.jpg" rel="shortcut icon" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../JS/jquery-2.2.4.min.js"></script>
    <script src="../../JS/bootstrap.min.js"></script>
    <link href="../../CSS/bootstrap.css" rel="stylesheet" />
    <link href="../../CSS/bootstrap-theme.css" rel="stylesheet" />
    <link href="../../CSS/Main.css" rel="stylesheet">
</head>
<body>
    <?php
		include 'MenuAdmin.php';
    ?>
    <div class="col-sm-12">
        <form action="../Action/Upload.php" method="post" enctype="multipart/form-data">
            <p id="tieude">Chọn hình tải lên:</p>
            <input class="btn btn-info" type="file" name="file" id="fileToUpload">
            <br/>
            <input class="btn btn-success" type="submit" value="Thêm" name="submit">
        </form>
        <div class="container">
            <div class="row">
                <?php

                $directory = "../../views/Contents/images/";
                $images = glob($directory . "*.{jpg,png,gif}",GLOB_BRACE);
                foreach($images as $image)
                {
                    echo '<div class="col-sm-4">
                            <label>'.$image.'</label>
                            <img class="img-responsive" src='.$image.'>
                            </div> ';
                }
                ?>
            </div>
        </div>
        <?php
        }
        else
        {
            header("location:../../Login.php");
        }
        ?>
    </div>

</body>
</html>