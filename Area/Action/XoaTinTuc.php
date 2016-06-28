<?php

    include '../../Controller/ActionController.php';
    $ac = new ActionController;

    $id = $_GET["MaQuangCao"];
    $ac->XoaTinTuc($id);
    header('Location: ' . $_SERVER["HTTP_REFERER"] );


?>