<?php

       $name = htmlspecialchars($_POST['name']);
       $phone = htmlspecialchars($_POST['phone']);
       $address = htmlspecialchars($_POST['address']);

       include("../connection.php");
       $pdo = MemberDB();

       include("../Lib/Member.php");
       getMemberID();
       $memberID = $_SESSION['MemberID'];

       //---------------------------------------------------

       //建立SQL
       $sql = "UPDATE `CUSTOMER` SET NAME = ? , PHONE = ? , ADDRESS = ? WHERE CUSTOMER_ID = ?";

       //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $phone);
        $statement->bindParam(3, $address);
        $statement->bindParam(4, $memberID);
        $statement->execute();

        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();

        echo json_encode(1);
       
?>