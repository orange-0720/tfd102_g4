<?php
    
    if(!isset($_SESSION)){
        session_start(); 
    }

    $order_id = $_SESSION['ORDER_ID'];

    include("./connection.php");
    $pdo = MemberDB();

    //建立SQL語法


    
    $sql = 'SELECT M.CUSTOM_MADE_IMG, M.CUSTOM_MADE_NAME, M.CUSTOM_MADE_PRICE, D.QUANTITY, D.ORDER_DETAIL_PRICE FROM `tfd102-g4`.ORDER_DETAIL D JOIN `tfd102-g4`.CUSTOM_MADE M on D.CUSTOM_MADE_ID = M.CUSTOM_MADE_ID WHERE D.ORDER_ID = ? and D.CUSTOM_MADE_ID is not null ';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(1, $order_id);
    $statement->execute(); 

    $data = $statement->fetchAll();

    echo json_encode($data);
    
?>