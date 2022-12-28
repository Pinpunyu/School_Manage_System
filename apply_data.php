<?php

    session_start();
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];

    //新增申請資料
    $root = '3'; //放root權限，system menager更改時再update
    $sql = "INSERT INTO Apply_Data(academic_year, semester, state, pay_fee_or_not, progress, student_account, system_manager_account) VALUES(?, ?, '審核中','not','', ?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $_POST["academic_year"], $_POST["semester"], $account, $root);
    $stmt->execute();

    header("Location: ./student.php"); // 自動跳轉回 student.php
?>
