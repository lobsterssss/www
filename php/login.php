<?php

if(isset($_POST["userEmail"]) && isset($_POST["userPass"]) && trim($_POST["userEmail"]) != "" && trim($_POST["userPass"]) != ""):

$db = new Database;
$result = $db->get_login($_POST["userEmail"], $_POST["userPass"]);
    if(!empty($result)):
        unset($result['WW']);
        $_SESSION["user"] = $result;
        header("HX-location:/");
    else:
        print("wrong password or email");
        
    endif;
else:
    print( "please fill in the form");
endif;