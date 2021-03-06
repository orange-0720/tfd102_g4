<?php

    $account = htmlspecialchars($_POST['account']);
    $pwd = htmlspecialchars($_POST['pwd']);

    include("./connection.php");
    $pdo = MemberDB();

    //建立SQL語法
    // $sql = "SELECT * FROM member WHERE NAME = '$account' and PWD = '$pwd'";

    if($account !='' && $pwd !=''){

        $sql = "SELECT * FROM CUSTOMER WHERE EMAIL = ?";
    
        //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
        // $statement = $pdo->query($sql);
        $statement = $pdo->prepare($sql);
        $statement->bindParam(1, $account);
        $statement->execute();
    
        //抓出全部且依照順序封裝成一個二維陣列
        $data = $statement->fetchAll();
        
        if(count($data)>0){

            $sql = "SELECT * FROM CUSTOMER WHERE EMAIL = ? and PWD =? ";
    
            //執行並查詢，會回傳查詢結果的物件，必須使用fetch、fetchAll...等方式取得資料
            // $statement = $pdo->query($sql);
            $statement = $pdo->prepare($sql);
            $statement->bindParam(1, $account);
            $statement->bindParam(2, $pwd);
            $statement->execute();

            $data = $statement->fetchAll();

            if(count($data) > 0){
                $memberID = "";
                $memberEMAIL = "";
        
                foreach($data as $index => $row){
                    $memberID = $row['CUSTOMER_ID'];
                    $memberEMAIL = $row["EMAIL"];
                    $qualify = $row["QUALIFY"];
                }
    
                //判斷是否有會員資料?
                if($memberEMAIL != "" && $memberID != "" && $qualify == 1){
                    // include("./Lib/Member.php");        
                
                    //將會員資訊寫入session
                    // setMemberInfo($memberEMAIL, $memberPWD);
                    
                    //先判斷session是否存在
                    if(!isset($_SESSION)){
                        session_start(); 
                    }
        
                    //Table 'CUSTOMER'裡的EMAIL欄位值
                    $_SESSION["MemberEMAIL"] = $memberEMAIL; 
        
                    //Table 'CUSTOMER'裡的PWD欄位值
                    $_SESSION["MemberID"] = $memberID; 
        
                    //導回產品頁        
                    // echo json_encode($data); 
                    // echo json_encode($_SESSION['MemberID]);
                    echo json_encode(1); 
                }else{
                    echo json_encode(4);
                }
            }else{
                echo json_encode(2);
            }
        }else{
            echo json_encode(3); 
        }
    }
    
?>