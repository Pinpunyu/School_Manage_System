<?php

    session_start();
    require_once('connect_sql.php');
    $conn = connect_sql();
    $account = $_SESSION['account'];
    $permission = $_SESSION['permission'];
    print("Hello " . $_SESSION['name'] . '.<br>'."Your permission is ".$permission . '.<br>');

    switch($permission){

        case 'student': //學生

            //輸出違規紀錄
            $sql = "SELECT * FROM `Violate_Record` WHERE `student_account` =  ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("違規紀錄：" . '<br>');
            if (mysqli_num_rows($result) > 0) { // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
                while ($row = mysqli_fetch_assoc($result)) {
                    print('date:' . $row["date"] . ', point:' . $row["point"] . ', rule:' . $row["rule_id"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);  // 釋放資料庫查到的記憶體

            //輸出房間資料
            $sql = "SELECT * FROM `Room` JOIN live_in USING(room_number) WHERE student_account = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("房間資料：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('academic_year:' . $row["academic_year"] . ', semester:' . $row["semester"] . ', dormitory_id :' . $row["dormitory_id"] . ', room_number:' . $row["room_number"] . ', num_of_people:' . $row["num_of_people"] . ', fee:' . $row["fee"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);

            //輸出申請資料
            $sql = "SELECT * FROM `Apply_Data` WHERE `student_account` =  ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $account);
            $stmt->execute();
            $result = $stmt->get_result();
            print("申請資料：" . '<br>');
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    print('academic_year:' . $row["academic_year"] . ', semester:' . $row["semester"] . ', apply_date:' . $row["apply_date"] . ', state:' . $row["state"] . ', 	pay_fee_or_not:' . $row["pay_fee_or_not"] . '<br>');
                }
            }
            mysqli_stmt_close($stmt);

            echo '<form action="./apply_data.php" method="post">

    <input required type="number" placeholder="academic_year" name="academic_year"><br>
    <input required type="text" placeholder="semester" name="semester"><br>

    <input type="submit" value="Apply">

</form>';



            break;

    }
