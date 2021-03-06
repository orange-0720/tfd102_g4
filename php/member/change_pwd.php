<?php

    $old_pwd = htmlspecialchars($_POST['old_pwd']);
    $new_pwd = htmlspecialchars($_POST['new_pwd']);

    include("../connection.php");
    $pdo = MemberDB();

    //---------------------------------------------------

    // 取得目前會員ID
    include("../Lib/Member.php");
    getMemberID();
    $memberID = $_SESSION['MemberID'];

    //建立SQL
    $sql = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = $memberID and PWD = ? and QUALIFY = 1";

    //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
    $statement = $pdo->prepare($sql);
    $statement->bindParam(1, $old_pwd);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();
    
    if($data !=[]){
        $sql = "UPDATE `CUSTOMER` SET PWD = ? WHERE CUSTOMER_ID = $memberID";
        //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $new_pwd);
        $statement->execute();

        echo json_encode(1);
    }else{
        echo json_encode(2);
    }

       
?>