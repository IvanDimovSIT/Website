<?php session_start(); ?>
<html>
<head><title>POSTS</title>
<link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/post.css">
</head>
<body class="bodyClass">
<?php require_once "navigation.php";navigation(); ?>
    <h2>CREATE POST</h2>
    
<table cellpadding="4">
    <tr>
        <td class="outerTable">
        <table cellpadding="0"><tr><td>
        <form method="POST" action="#">
        <div class="inputLabel">Title:</div><input type="text" name="t"></td></tr><tr><td>
        <div class="inputLabel">Contents:</div></td></tr><tr><td><textarea name="c"></textarea></td></tr><tr><td>
        <input type='submit' value='Post' name="s">
        </form></td>
        </tr>
        </table>
        </td>

        <td class="innerTable">
        <table cellpadding="0"><tr><td>
        <form method="GET" action="#">
        <div class="inputLabel">Posted by:</div><input type="text" name="by"></td></tr><tr><td>
        <input type="submit" value="Search" name="s1"></td></tr>
        </table>
        </td>
    </tr>
</table>

<hr>
<?php
    require_once "databaseDAO.php";
    require_once "textdata.php";
    $dao = DAO::getInstance();
    if(isset($_GET['by']) && strlen(textForUsername($_GET['by']))>3){
        $result = $dao->getPostsBy(textForUsername($_GET['by']));
    }else{
        $result = $dao->getAllPosts();
    }
    $counter = 0;
    while($r = mysqli_fetch_row($result)){
        $counter++;
        print("<h3>".textData($r[2])."</h3>");
        print("<p>".newline(textData($r[3]))."</p>");
        print("<i>By <a href='user.php?user=".$r[1]."'>".textData($r[1])."</a></i>");
        print("<hr>");
        if($counter>100)break;
    }
?>
<?php

    if(isset($_POST['s'])){
        require_once "databaseDAO.php";
        require_once "textvalidation.php";
        $u = $_SESSION['username'];
        $p = $_SESSION['password'];
        $title = clearBadChars($_POST['t']);
        $contents = trim($_POST['c']);
        if(strlen($title)<1 || strlen($contents)<1)return;

        $dao = DAO::getInstance();
        if($dao->match($u, $p)){
            if(!$dao->createPostTest($u, $p, $title, $contents)){
                print("ERROR: Not Posted!<br>");
            }else{
            print("<meta http-equiv='refresh' content='0'>");
            }
        }else{
            print("Incorrect Username Or Password!<br>");
        }

    }

?>

</body>
</html>