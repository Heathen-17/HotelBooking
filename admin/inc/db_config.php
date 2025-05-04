<?php

// Read Railway environment variables, providing defaults only for local testing if needed
$hname = getenv("MYSQLHOST") ?: "localhost"; // Railway provides this
$uname = getenv("MYSQLUSER") ?: "root";      // Railway provides this
$pass = getenv("MYSQLPASSWORD") ?: "";       // Railway provides this
$db = getenv("MYSQLDATABASE") ?: "railway";   // Railway provides this
$port = getenv("MYSQLPORT") ?: 3306;         // Railway provides this

// Establish connection using mysqli
$con = mysqli_connect($hname, $uname, $pass, $db, (int)$port); // Cast port to integer

// Check connection
if (!$con) {
    // Log the detailed error for administrators (consider using error_log)
    // error_log("Database Connection Error: " . mysqli_connect_error());
    // Provide a generic error message to the user
    die("Cannot connect to Database. Error: " . mysqli_connect_error());
}

// --- Helper Functions (Keep existing ones, ensure they use $con) ---

// Filteration function (seems generally okay, but review context of use)
function filteration($data){
    foreach($data as $key => $value){
        $value = trim($value);
        $value = stripslashes($value); // Be cautious if data legitimately contains slashes
        // Use ENT_QUOTES to encode both single and double quotes
        $value = htmlspecialchars($value, ENT_QUOTES);
        // strip_tags can be overly aggressive; consider if HTML is ever needed.
        $value = strip_tags($value); 
        $data[$key] = $value;
    }
    return $data;
}

// Select function (ensure it uses the global $con)
function select($sql, $values, $datatypes) {
    global $con; // Use the global mysqli connection object
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            // Log error: mysqli_error($con)
            die("Query execution failed - Select");
        }
    } else {
        // Log error: mysqli_error($con)
        die("Query preparation failed - Select");
    }
}

// Update function (ensure it uses the global $con)
function update($sql, $values, $datatypes) {
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $affected_rows;
        } else {
            mysqli_stmt_close($stmt);
            // Log error: mysqli_error($con)
            die("Query execution failed - Update");
        }
    } else {
        // Log error: mysqli_error($con)
        die("Query preparation failed - Update");
    }
}

// Insert function (ensure it uses the global $con)
function insert($sql, $values, $datatypes) {
    global $con;
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $affected_rows;
        } else {
            mysqli_stmt_close($stmt);
            // Log error: mysqli_error($con)
            die("Query execution failed - Insert");
        }
    } else {
        // Log error: mysqli_error($con)
        die("Query preparation failed - Insert");
    }
}

// Note: Ensure any other functions from the original db_config.php are included if needed.

?>

