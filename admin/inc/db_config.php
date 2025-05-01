<?php
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'Hotelreservation';

    $con = mysqli_connect($hname,$uname,$pass,$db);
    
    if (!$con) {
        die("Cannot conenct to Database".mysqli_connect_error());
    }  

    function filteration($data){
        foreach($data as $key => $value){
            // trim()
            // stripslashes()
            // htmlspecialchars()
            // strip_tags()

            $data[$key] = trim($value);
            $data[$key] = stripcslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
            
        }
        return $data;
    }

    function select($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query not executed --select");
            }
        
        }
        else{
            die("Query not prepared --Select");
        }
    }


    function update($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query not executed --Update");
            }       
        }
        else{
            die("Query not prepared --Update");
        }
    }


    function insert($sql, $values, $datatypes)
    {
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query not executed --Insert");
            }       
        }
        else{
            die("Query not prepared --Insert");
        }
    }
    
?>