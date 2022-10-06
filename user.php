<?php session_start(); ?>
<html>
<head><title><?php print($_GET['user']); ?></title>
<link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php require_once "navigation.php";navigation(); ?>
    <h2><?php require_once "textdata.php"; print(textData($_GET['user'])); ?></h2>
    <i>Registered on <?php require_once "databaseDAO.php";$dao = DAO::getInstance();print($dao->getUserRegistrationDate($_GET['user'])); ?></i>
    <h3>Description:</h3>
    <?php
        require_once "databaseDAO.php";
        require_once "textdata.php";
        $dao = DAO::getInstance();
        if($_GET['user'] == $_SESSION['username'] and $dao->match($_SESSION['username'], $_SESSION['password'])){
            print("<form method='post' action='#'>");
            print("<textarea name='d'>");
            print(textData($dao->getUserDescription($_GET['user'])));
            print("</textarea><br>");
            
            print("<input type='submit' name='s' value='update'>");
            print("</form>");
        }else{
            print(textData($dao->getUserDescription($_GET['user'])));
        }
    
    ?>

    <?php
        require_once "databaseDAO.php";
        $dao = DAO::getInstance();
        if(isset($_POST['s'])){
            $desc = $_POST['d'];
            //$desc = filter_var($desc,FILTER_SANITIZE_STRING);
            if(!$dao->setUserDescription($_SESSION['username'], $_SESSION['password'], $desc)){
                print("<h2>FAILED<h2>");
            }else{
                print("<meta http-equiv='refresh' content='0'>");
            }
        }

    ?>

    <h3>Posts:</h3>
    <hr>
    <?php
        require_once "databaseDAO.php";
        require_once "textdata.php";
        $dao = DAO::getInstance();

        $r = $dao->getPostsBy($_GET['user']);
        while($p = mysqli_fetch_row($r)){
            print("<h3>".textData($p[2])."</h3>");
            print("<p>".newline(textData($p[3]))."</p>");
            print("<hr>");

        }

    ?>
    
</body>
</html>