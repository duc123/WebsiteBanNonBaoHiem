<?php
session_start();
?>
<?php
if($_SESSION["user"]&& $_SESSION["pass"])
{
    session_destroy();
    header("location:Login.php");
}
else
{
    header("location:Login.php");
}

?>