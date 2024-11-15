<?php

if(isset($_POST["userName"]) && isset($_POST["userEmail"]) && isset($_POST["userPass"]) && isset($_POST["re-userPass"]) && trim($_POST["userEmail"]) != "@" && trim($_POST["userPass"]) != "" && trim($_POST["re-userPass"]) != "" && trim($_POST["userName"]) != ""):
    if($_POST["userName"] == preg_replace('/[^a-zA-Z0-9_ -]/s','',$_POST["userName"])):
        if($_POST["userPass"] == $_POST["re-userPass"]):
            $db = new Database;
            $result = $db->set_user($_POST["userEmail"], $_POST["userPass"], $_POST["userName"]);
            $db->close();
                if($result):
                header("HX-Location: ./login");
                else:
                    print("this email is already in use");
                endif;
        else:
            print("password is not the same");
        endif;
    else:
        print("remove special characters from username");
endif;
else:
    print( "please fill in the form");
endif;