<?php


session_start();
require_once('conn.php');

$academic_year = $_POST["academic_year"];
$semester = $_POST["semester"];
$apply_date = $_POST["apply_date"];
$state = $_POST["state"];
$pay_fee_or_not = $_POST["pay_fee_or_not"];
$progress = $_POST["progress"];
$apply_data_id = $_POST["apply_data_id"];
$student_account = $_POST["student_account"];
$system_manager_account = $_POST["system_manager_account"];
// $_POST['key-name'] 取得輸入的資料
// 以 empty() 判斷值是否為 null
// if (empty($_POST['username'])) {
//     // 中斷後面程序並顯示內容，() 內可輸入訊息字串
//     die('請輸入 username');
// }

// sprintf() 裡面可以放入替代字元
$sql = sprintf("INSERT INTO Apply_Data VALUES('%s','%d','%s','%s','%s','%s','%d','%s','%s')" 
    ,$academic_year,$semester,$apply_date,$state,$pay_fee_or_not,$progress,$apply_data_id,$student_account,$system_manager_account);
$result = mysqli_query($conn, $sql);
// 確認是否有拿到結果
if (!$result) {
    die($conn->error);
}

header("Location: student.php"); // 自動跳轉回 index.php
?>

<!-- 
    echo $_POST["account"];
    echo $_POST["password"];
-->
