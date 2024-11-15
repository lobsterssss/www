<?php

if(isset($_POST["userLastName"]) && isset($_POST["userTel"]) && isset($_POST["userName"]) && isset($_POST["userEmail"]) && trim($_POST["userEmail"]) != "@" && trim($_POST["userPass"]) != "" && trim($_POST["userName"]) != "" && trim($_POST["userLastName"]) != "" && trim($_POST["userTel"]) != ""):
    if($_POST["userName"] == preg_replace('/[^a-zA-Z0-9_ -]/s','',$_POST["userName"])):
        if($_POST["userPass"] == $_POST["userrePass"]):
            $db = new Database;
            $result = $db->set_klant($_POST["userEmail"], $_POST["userPass"], $_POST["userName"], $_POST["userLastName"], $_POST["userTel"]);
            $db->close();
                if($result):
                header("HX-Location: /");
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