<?php
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
        $res = $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_row($sql){
        global $conn;
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>