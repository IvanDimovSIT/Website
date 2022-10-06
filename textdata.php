<?php
    function textData($string){
        return str_replace(">","&gt;",str_replace("<", "&lt;", $string));
    }

    function textForUsername($string){
        return str_replace("\t","",str_replace("\"","",str_replace("\'","",str_replace("\n","",str_replace(" ","",str_replace(";", "", $string))))));
    }

    function newline($string){
        return str_replace("\n", "<BR>\n", $string);
    }

?>