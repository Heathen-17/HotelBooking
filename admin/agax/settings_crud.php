<?php
    require('../inc/essential.php');
    require('../inc/db_config.php');
    adminLogin();

    if(isset($_POST['get_general']))
    {
        $q = "SELECT * FROM `settings` WHERE  `sr_no`=?";
        $values =[1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);

        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_general']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `settings` SET `site_title`=?, `site_about`=?  WHERE `sr_no`=?";
        $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
        $res = update($q, $values, 'ssi');
        echo $res;
    }

    if(isset($_POST['get_contacts']))
    {
        $q = "SELECT * FROM `contact_details` WHERE  `sr_no`=?";
        $values =[1];
        $res = select($q, $values, "i");
        $data = mysqli_fetch_assoc($res);

        $json_data = json_encode($data);
        echo $json_data;
    }

    if(isset($_POST['upd_contacts']))
    {
        $frm_data = filteration($_POST);

        $q = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`twi`=?,`iframe`=? WHERE `sr_no`=?";
        $values = [$frm_data['address'], $frm_data['gmap'], $frm_data['pn1'],$frm_data['pn2'], $frm_data['email'], $frm_data['fb'], $frm_data['insta'], $frm_data['twi'], $frm_data['iframe'], 1];
        $res = update($q, $values, 'sssssssssi');
        echo $res;
    }
    
?>