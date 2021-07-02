<?php

/////////////////////////////////////////
///////////////////OCI///////////////////
////////////////////////////////////////

// $conn = oci_connect('admin', 'Password!123', '//localhost/xe');
// if (!$conn) {
//     $m = oci_error();
//     echo $m['message'], "\n";
//     exit;
// }


// function query($sql){
//     global $conn;
//     $stmt = oci_parse($conn, $sql);
//     $result= oci_execute($stmt);

//     if(!$result){
//         die(oci_error($stmt)['message'].":".$sql);   
//     }

//     return true;
// }

// function fetch_all_row($sql){
//     global $conn;
//     $stmt = oci_parse($conn, $sql);
//     oci_execute($stmt);
//     oci_fetch_all($stmt, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);

//     if(!empty(oci_error($stmt)['message'])){
//         die(oci_error($stmt)['message'].":".$sql);   
//     }

//     return $res;
// }

// function fetch_row($sql){
//     global $conn;
//     $stmt = oci_parse($conn, $sql);
//     oci_execute($stmt);
//     $res = oci_fetch_assoc($stmt);

//     if(!empty(oci_error($stmt)['message'])){
//         die(oci_error($stmt)['message'].":".$sql);   
//     }

//     return $res;
// }

// function get_last_id($table) {
//     global $conn;
//     return $table."_seq.currval";
// }

// function toDate($date, $format) {
//     return "TO_DATE('$date','$format')";
// }

// function random_order()
// {
//     return "dbms_random.value";
// }    

// function limit_result($row_count)
// {
//   // return "FETCH FIRST $row_count ROWS ONLY";
//   return "";
// }    


/////////////////////////////////////////
///////////////////PDO///////////////////
////////////////////////////////////////

// try {
//     $conn = new PDO("sqlite:".__DIR__."/../database.sqlite");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }catch(PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

// function query($sql){
//     global $conn;
//     $stmt = $conn->prepare($sql);
//     return $stmt->execute();
// }

// function fetch_all_row($sql){
//     global $conn;
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $res;
// }

// function fetch_row($sql){
//     global $conn;
//     $stmt = $conn->prepare($sql);
//     $res = $stmt->execute();
//     $res = $stmt->fetch(PDO::FETCH_ASSOC);
//     return $res;
// }

// function get_last_id($table) {
//     global $conn;
//     return $conn->lastInsertId();
// }

// function toDate($date, $format) {
//     return "'$date'";
// }

// function random_order()
// {
//     return "RANDOM()";
// }    

// function limit_result($row_count)
// {
//     return "LIMIT $row_count";
// } 


/////////////////////////////////////////
/////////////////MYSQLi/////////////////
////////////////////////////////////////

$conn = new mysqli('localhost', 'root', 'Hello@123', 'OnlineAppetite');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function query($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn) . " : SQL : " . $sql);
    }
    return $result;
}

function fetch_all_row($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn) . " : SQL : " . $sql);
    }
    $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $res;
}

function fetch_row($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn) . " : SQL : " . $sql);
    }
    $res = mysqli_fetch_assoc($result);
    return $res;
}

function get_last_id($table) {
    global $conn;
    return mysqli_insert_id($conn);
}

function toDate($date, $format)
{
    return "STR_TO_DATE('$date', '%Y-%m-%d')";
}

function random_order()
{
    return "RAND()";
}

function limit_result($row_count)
{
    return "LIMIT $row_count";
}
