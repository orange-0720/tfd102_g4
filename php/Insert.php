<?php

       $account = htmlspecialchars($_POST['account']);
       $pwd = htmlspecialchars($_POST['pwd']);
       $tel = htmlspecialchars($_POST['tel']);
   
       include("./connection.php");
       $pdo = MemberDB();
   
       //---------------------------------------------------
   
       //建立SQL
       $sql = 'SELECT * FROM CUSTOMER WHERE EMAIL = ?';
       $statement = $pdo->prepare($sql);
       $statement->bindValue(1, $account);
       $statement->execute();
       $data = $statement->fetchAll();

       if(count($data) > 0){
              echo 'have';
       }else{

              $sql = "INSERT INTO CUSTOMER(EMAIL, PWD, PHONE , QUALIFY, ADD_DATE, STATUS,DISCOUNT,DISCOUNT_HAVE) VALUES (?, ?, ?, 1, NOW(), 1, 0, 0)";
          
              //執行
              // $pdo->exec($sql);
              $statement = $pdo->prepare($sql);
              $statement->bindValue(1, $account);
              $statement->bindValue(2, $pwd);
              $statement->bindValue(3, $tel);
              $statement->execute();
       
       
              $sql = "SELECT * FROM CUSTOMER WHERE EMAIL = ? and PWD = ? and QUALIFY = 1";
       
              $statement = $pdo->prepare($sql);
              $statement->bindValue(1, $account);
              $statement->bindValue(2, $pwd);
              $statement->execute();
       
              $data = $statement->fetchAll();
       
              foreach ($data as $index => $row) {
                     $memberID = $row['CUSTOMER_ID'];
              };
       
              if(!isset($_SESSION)){
                     session_start(); 
              };
       
              $_SESSION["MemberID"] = $memberID; 
       
              echo 'done';
       }

       
?>