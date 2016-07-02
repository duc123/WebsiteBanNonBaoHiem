<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <?php include 'views/Layout/head.php'; ?>
        
    </head>

    <body class="cms-index-index">
        <div class="page">
            <!-- Header -->

            <?php include 'views/Layout/header.php'; ?>

            <!-- end header -->

            <!-- Navbar -->

            <?php include 'views/Layout/navbar.php'; ?>

            <!-- end nav -->


            <!--Body page-->
            <div class="container">

                <div class="row">
                    <br/>
                    <p style="font-size: 160%"><strong>GIO HANG</strong></p>
                    <table data-toggle="table">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Item 1</td>
                                <td>$1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Item 2</td>
                                <td>$2</td>
                            </tr>
                        </tbody>
                    </table>




                </div>

            </div>
            <!--End body page-->
        </div>

        <?php include 'views/Layout/footer.php'; ?>

    </body>
</html>
