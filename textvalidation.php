<?php

    function validateUserName($username){
        return preg_match('/^[a-z0-9_]+$/i', $username) > 0;
    }

    function clearBadChars($string){
        return trim($string);
    }

?>