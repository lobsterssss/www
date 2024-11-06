<?php

if(isset($_POST["userEmail"]) && isset($_POST["userPass"]) && trim($_POST["userEmail"]) != "" && trim($_POST["userPass"]) != ""):

$db = new Database;
$result = $db->get_login($_POST["userEmail"], $_POST["userPass"]);
$db->close();
    if(!empty($result)):
        unset($result['password']);
        unset($result[2]);
        $_SESSION["user"] = $result;
        header("HX-location:/");
    else:
        print("wrong password or email");
    endif;
else:
    print( "please fill in the form");
endif;