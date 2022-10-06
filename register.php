<?php session_start(); ?>
<html>
<head><title>REGISTER</title>
<link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h2>REGISTER</h2>
<form method="POST" action="#">
username:<input type="text" name="u"><br>
password:<input type='password' name="p"><br>
<input type='submit' value='Register' name="s"><br>

</form>
<p><a href='index.php'>Log In</a></p>
<?php

    if(isset($_POST['s'])){
        require_once "databaseDAO.php";
        require_once "textvalidation.php";
        $u = $_POST['u'];
        $p = $_POST['p'];

        if(strlen($u)<4){
            print("username too short");
        }else if(strlen($p)<4){
            print("password too short");
        }else if(!validateUserName($u)){
            print("username contains illegal characters");
        }else{

            $dao = DAO::getInstance();
            $p = $dao->hash($p);
            if($dao->createUserTest($u, $p)){
                print("<br>ACCOUNT CREATED SUCCESSFULY");
            }else{
                print("<br>ACCOUNT CREATION FAILED");
            }
        
        }
    }

?>

</body>
</html>