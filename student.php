<?php
function print_array($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    $datas = array();
    if ($result) {
        if (mysqli_num_rows($result) > 0) { // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            while ($row = mysqli_fetch_assoc($result)) {
                $datas[] = $row; // 每跑一次迴圈就抓一筆值，最後放進data陣列中
            }
        }

        mysqli_free_result($result);  // 釋放資料庫查到的記憶體
    } else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($conn);
    }

    if (!empty($result)) { // 資料處理完後印出資料
        print_r($datas);
        echo "<br>";
    } else { // 為空表示沒資料
        echo "查無資料";
    }
}

session_start();
require_once('conn.php');



// 用 empty 檢查表單是否為空
if (empty($_POST["account"]) || empty($_POST["password"])) {
    $account = $_SESSION["account"];
    $password = $_SESSION["password"];
    if (empty($account) || empty($password)) {
        echo '資料有缺，請再次填寫<br>';
        exit();   // 終止程序
    }
}else{
    $account = $_POST["account"];
    $password = $_POST["password"];
    $_SESSION['account'] = $account;
    $_SESSION['password'] = $password;
}
// 接收 method 為 GET 的 From input
echo "account = " . $account . " <br>";
echo "password = " . $password . " <br>";

// print_r($_POST);


$sql = sprintf("SELECT * FROM `Violate_Record` WHERE `student_account` =  '%s';", $account);
echo "違規紀錄：";
print_array($conn, $sql);

$sql = sprintf("SELECT * FROM `Room` AS r WHERE r.room_number = (
        SELECT l.room_number FROM `live_in` AS l WHERE l.student_account = '%s');", $account);
echo "房間資料：";
print_array($conn, $sql);

$sql = sprintf("SELECT * FROM `Apply_Data` WHERE `student_account` =  '%s';", $account);
echo "申請資料：";
print_array($conn, $sql);

?>

<form action="./apply_data.php" method="post">

    <input required type="number" placeholder="academic_year" name="academic_year">
    <input required type="text" placeholder="semester" name="semester">
    <input required type="date" placeholder="apply_date" name="apply_date">
    <input required type="text" placeholder="state" name="state">
    <input required type="text" placeholder="pay_fee_or_not" name="pay_fee_or_not">
    <input required type="text" placeholder="progress" name="progress">
    <input required type="number" placeholder="apply_data_id" name="apply_data_id">
    <input required type="text" placeholder="student_account" name="student_account">
    <input required type="text" placeholder="system_manager_account" name="system_manager_account">

    <input type="submit" value="Apply">

</form>
