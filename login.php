<?php
    $servername = "localhost";
    $username = "id11636272_root";
    $password = "society@123#";
    $dbname = "id11636272_society";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,password FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$uname);
        $uname = $_POST['username'];
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if(!($r = $stmt->fetch())) {
                echo "User doesn't exist/0";
            }
            else{
                if($_POST['password'] === $r['password'])
                {
                    echo "Successfully signed in/1";
                }
                else
                {
                    echo "Incorrect Password!/0";
                }
            }
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
    ?>