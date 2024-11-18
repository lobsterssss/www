<?php

if (
    isset($_POST["klantID"]) && isset($_POST["medicatie"]) && isset($_POST["innameFrequentie"]) && 
    isset($_POST["datum"]) && isset($_POST["tijd"]) && isset($_POST["dosering"]) && isset($_POST["beperking"]) &&
    trim($_POST["klantID"]) != "" && trim($_POST["medicatie"]) != "" && trim($_POST["innameFrequentie"]) != "" &&
    trim($_POST["datum"]) != "" && trim($_POST["tijd"]) != "" && trim($_POST["dosering"]) != "" && trim($_POST["beperking"]) != ""
):
    if ($_POST["medicatie"] == preg_replace('/[^a-zA-Z0-9_ -]/s', '', $_POST["medicatie"])): // Example sanitization for "medicatie"
        $db = new Database;

        // Call the create_planning function to insert the data
        $result = $db->create_planning(
            $_POST["klantID"], 
            $_POST["medicatie"], 
            $_POST["innameFrequentie"], 
            $_POST["datum"], 
            $_POST["tijd"], 
            $_POST["dosering"], 
            $_POST["beperking"]
        );

        $db->close();

        if ($result):
            print("Planning successfully created.");
        else:
            print("There was an error creating the planning.");
        endif;
    else:
        print("Remove special characters from the Medicatie field.");
    endif;
else:
    print("Please fill in all fields in the form.");
endif;
