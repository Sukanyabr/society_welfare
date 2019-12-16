<html>
<body>
    <?php
    $servername = "localhost";
    $username = "id11636272_root";
    $password = "society@123#";
    $dbname = "id11636272_society";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT name FROM users WHERE username = :username OR email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$uname);
        $stmt->bindParam(':email',$email);

        $uname = $_POST['username'];
        $email = $_POST['email'];
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if(!($r = $stmt->fetch())) {
                $sql = "INSERT INTO users(name,email,username,password)
                VALUES('{$_POST["Name"]}','{$_POST["email"]}','{$_POST["username"]}','{$_POST["password"]}')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                echo "<script>alert(\"Signed Up successfully\")</script>";
                echo "<meta http-equiv=\"refresh\" content=\"1;index.html\">";
            }
            else{
                echo "<script>alert(\"given user {$r['name']} already exists\")</script>";
                echo "<meta http-equiv=\"refresh\" content=\"1;signup.html\">";
            }
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
    ?>
</body>
</html>