<?php session_start(); ?>
<html>
<head><title>LOG IN</title>
<link rel="stylesheet" href="style/main.css">
</head>
<body>
    <h2>LOG IN</h2>
<table>
<form method="POST" action="#">
username:<input type="text" name="u"><br>
password:<input type='password' name="p"><br>
<input type='submit' value='Log In' name="s"><br>

</form>

<p><a href='register.php'>Create Account</a></p>
<?php

    if(isset($_POST['s'])){
        require_once "databaseDAO.php";
        $u = $_POST['u'];
        $p = $_POST['p'];
        $dao = DAO::getInstance();
        $p = $dao->hash($p);
        //var_dump($u, $p);
        

        if($dao->match($u, $p)){
            $_SESSION['username'] = $u;
            $_SESSION['password'] = $p;
            print("<p><a href='post.php'>See Posts</a></p>");

        }else{
            print("<p>Incorrect Username Or Password!</p><br>");
        }

    }

?>

</body>
</html>