<?php

    include("./connection.php");
    $pdo = MemberDB();

    //建立SQL語法


    // 從$_SETTION抓出顧客ID，透過顧客ID撈出此顧客的活動。
    $sql = "SELECT * FROM ACTIVITY where ACTIVITY_STATUS_ID = 1";



    //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
    // $statement = $pdo->query($sql);
    $statement = $pdo->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();

    echo json_encode($data);
        
    
    

?>