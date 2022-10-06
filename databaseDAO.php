<?php
    class DAO{
        private $conn;
        private static $Dao;
        private function __construct()
        {
            $this->conn = mysqli_connect('localhost', 'root', '');
            try{
                $sql = 'CREATE DATABASE SSITE';
                mysqli_query($this->conn, $sql);
            }catch(Exception $e){
                //print("<script>console.log('".$e->getMessage()."')<script>");
            }
            mysqli_select_db($this->conn, 'SSITE');
            $sql = 'CREATE TABLE IF NOT EXISTS USERS(
                username VARCHAR(32) NOT NULL PRIMARY KEY,
                password VARCHAR(128) NOT NULL,
                description VARCHAR(512),
                registration DATE
                )';
            mysqli_query($this->conn, $sql);

            $sql = 'CREATE TABLE IF NOT EXISTS POST(
                id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(32) NOT NULL REFERENCES USERS(username),
                title VARCHAR(64),
                content VARCHAR(512)
                )';
            mysqli_query($this->conn, $sql);
            
        }

        public static function getInstance(){
            if(self::$Dao==null)
                self::$Dao = new DAO();
            return self::$Dao;
        }

        public function hash($password){
            return hash('sha256', $password, false);
        }

        public function createUser($name, $password){
            //$hashed = hash('sha256', $password, false);
            $sql = 'INSERT INTO USERS(username, password, registration) VALUES("'.$name.'","'.$password.'", (SELECT NOW()))';
            try{
                $result = mysqli_query($this->conn, $sql);
                return $result;
            }catch(Exception $e){
                //print("<script>console.log('".$e->getMessage()."')</script>");

                return false;
            }
        }

        public function createUserTest($name, $password){
            try{
                $sql = 'INSERT INTO USERS(username, password, registration) VALUES(?, ?,(SELECT NOW()))';
                $st = mysqli_prepare($this->conn,$sql);
                $st->bind_param("ss", $name, $password);
                $st->execute();
                $st->close();
            }catch(Exception $e){
                //var_dump($e);
                return false;
            }
            return true;
        }

        public function match($name, $password){
            //$hashed = hash('sha256', $password, false);
            $sql = "SELECT password FROM USERS WHERE username LIKE '".$name."'";
            $result = mysqli_fetch_row(mysqli_query($this->conn, $sql));
            return isset($result[0]) && $result[0] == $password;
        }

        public function createPost($name, $password, $title , $content){
            if($this->match($name, $password)){
                $sql = 'INSERT INTO POST(username, title, content) VALUES("'.$name.'","'.$title.'","'.$content.'")';
                $result = mysqli_query($this->conn, $sql);
                return $result;
            }else{
                return false;
            }
        }

        public function createPostTest($name, $password, $title , $content){
            if($this->match($name, $password)){
                $sql = 'INSERT INTO POST(username, title, content) VALUES(?,?,?)';
                $st = mysqli_prepare($this->conn,$sql);
                $st->bind_param("sss", $name, $title, $content);
                $result = $st->execute();
                $st->close();
                //var_dump($result);
                return $result;
            }else{
                return false;
            }
        }

        public function getAllPosts(){
            $sql = 'SELECT * FROM POST ORDER BY id DESC';
            return mysqli_query($this->conn, $sql);
        }

        public function getPostsBy($username){
            $sql = "SELECT * FROM POST WHERE username LIKE '$username' ORDER BY id DESC";
            return mysqli_query($this->conn, $sql);

        }

        public function getUserDescription($username){
            $sql = "SELECT description FROM USERS WHERE username LIKE '$username'";
            return mysqli_fetch_row( mysqli_query($this->conn, $sql) )[0];
        }

        public function setUserDescription($username, $password, $description){
            //$hashed = hash('sha256',  $password, false);
            if($this->match($username, $password)){
                $sql = "UPDATE USERS SET description = '".$description."' WHERE username LIKE '".$username."'";
                return mysqli_query($this->conn, $sql);
            }else{
                return false;
            }
        }

        public function getUserRegistrationDate($username){
            $sql = "SELECT registration FROM USERS WHERE username LIKE '$username'";
            return mysqli_fetch_row( mysqli_query($this->conn, $sql) )[0];
        }


    }

?>