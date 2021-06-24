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
    //     oci_execute($stmt);
    // }

    // function fetch_all_row($sql){
    //     global $conn;
    //     $stmt = oci_parse($conn, $sql);
    //     oci_execute($stmt);
    //     oci_fetch_all($stmt, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
    //     return $res;
    // }

    // function fetch_row($sql){
    //     global $conn;
    //     $stmt = oci_parse($conn, $sql);
    //     oci_execute($stmt);
    //     $res = oci_fetch_assoc($stmt);
    //     return $res;
    // }
    
    /////////////////////////////////////////
    ///////////////////PDO///////////////////
    ////////////////////////////////////////

    try {
        $conn = new PDO("sqlite:database.sqlite");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    function query($sql){
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    function fetch_all_row($sql){
        global $conn;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    function fetch_row($sql){
        global $conn;
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
