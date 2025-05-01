<?php
    require('inc/essential.php');
    require('inc/db_config.php');
    adminLogin();
    session_regenerate_id(true);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Queries</title>
    <link rel="stylesheet" href="common.css">
    <?php require('inc/link.php');?> 
</head>

<body class="bg-light">
    <?php require('inc/header.php')?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">User Queries</h3>
               
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                <div class="table-responsive-md" style="height: 150px; overflow-y: scroll;">
                 <table class="table table-hover border">
                    <thead class="sticky-top">
                        <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td>John</td>
                        <td>Doe</td>
                        <td>@social</td>
                        </tr>
                    </tbody>
                    </table>
            </div>

            </div>
        </div>




    <?php require('inc/script.php')?>


</body>

</html>
