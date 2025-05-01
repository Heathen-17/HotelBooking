<?php 
    require('inc/essential.php');
    require('inc/db_config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <?php require('inc/link.php'); ?>

    <style>
        div.login-form{
            position:absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 50%);
            width:40;
        }
        .custom-alert{
            position:fixed;
            top: 25px;
            right: 25px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="login-form text-center bg-white shadow rounded overflow-hidden"> 
        <form method="POST">
            <h4 class="bg-dark text-white py-3"> Admin Login Panel</h4>
            <div class="p-4">
            <div class="mb-3">
                <input name="admin_name" type="text" class="form-control shadow-none text-center" placeholder="Admin" required>
              </div>    
              <div class="mb-4">
                <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password" required>
              </div>
              <button name="login" type="submit" class="btn btn-success text-white shadow-none mb-2">Login</button>
            </div>
        </form>
    </div>


    <?php 
    if(isset($_POST['login']))
    {
        $frm_data = filteration($_POST);
        // print_r($_POST);
        // echo "<h1>$frm_data[admin_name]</h1>";
        // echo "<h1>$frm_data[admin_pass]</h1>";
        // print($frm_data);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=?  AND `admin_pass`=?";
        $values = [$frm_data['admin_name'],$frm_data['admin_pass']];

        $res = select($query,$values,"ss");
        print_r($res->num_rows);
        
        if($res->num_rows==1){
            $row =mysqli_fetch_assoc($res);
            session_start();
            $_SESSION['adminLogin']=true;
            $_SESSION['adminId']=$row['sr_no'];

            redirect('dashboard.php');
        }
        else{
            alert('error', 'Login failed -- Invalid Credentials');
    }
}
    ?>
    <?php require('inc/script.php')?>
</body>
</html>