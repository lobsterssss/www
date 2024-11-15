<?php

class Database {
//SELECT users.name, leaderboard.id FROM users INNER JOIN leaderboard ON users.id = leaderboard.userName;
    private $conn;
    private $binary;
    const key = "aes-128-ctr";


   function __construct()
    {
    $hostname = '127.0.0.1';
    // $hostname = '195.168.0.3:3306';
    $username = 'root';
    $password = 'root';
    $dbname = 'mediturn';
    $this->binary = hex2bin('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');
    $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
   }

   function close()
   {
    $this->conn = null;
   }

   function set_user($email, $password, $name)
   {

       $temp = $this->conn->query("SELECT accounts.Email FROM accounts WHERE accounts.Email = '$email'")->fetchAll();
       if(!isset($temp[0])){

           $password = $this->encryped($password);
           $result = $this->conn->query("INSERT INTO accounts (Email, GB, WW) VALUES ('$email','$name','$password')");
           // if($result)
           //     $this->conn->query("INSERT INTO user_settings (user_settings.user) SELECT users.id FROM users WHERE users.email = '$email'");
           return $result;
       }
   }

    function get_Login($email, $password)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT accounts.GB, accounts.Acount_ID, accounts.WW FROM accounts WHERE accounts.Email = '$email'")->fetch();
        if(!$result)
        return;
        if($this->decryped($result["WW"]) == $password)
        return $result;
    }

    function get_all_medicine()
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT * FROM medicine")->fetch();
        return $result;
    }

    function get_current_user($id)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT users.naam, users.email, users.achternaam, users.telefoon, users.leeftijd, users.woonplaats, users.woonplaats, users.postcode, users.adres FROM users WHERE users.klant_id = $id")->fetch();
        return $result;
    }

    function get_all_user_customers()
    {
                //check validation AND users.verified = 1
                $result = $this->conn->query("SELECT * FROM klanten")->fetchAll();
                return $result;
        
    }

    function set_klant($email, $password, $name, $lastname, $telefoon)
    {

        $temp = $this->conn->query("SELECT users.email FROM users WHERE users.email = '$email'")->fetchAll();
        if(!isset($temp[0])){

            $result = $this->conn->query("INSERT INTO users (email, naam, achternaam, telefoon) VALUES ('$email','$name','$lastname','$telefoon')");
            // if($result)
            //     $this->conn->query("INSERT INTO user_settings (user_settings.user) SELECT users.id FROM users WHERE users.email = '$email'");
            return $result;
        }
    }

    function edit_klant($email, $password, $name, $lastname, $telefoon)
    {


            $result = $this->conn->query("UPDATE users set (email, naam, achternaam, telefoon) VALUES ('$email','$name','$lastname','$telefoon') where ");
            // if($result)
            //     $this->conn->query("INSERT INTO user_settings (user_settings.user) SELECT users.id FROM users WHERE users.email = '$email'");
            return $result;
    }

    function delete_klant($klant_id)
    {
        $result = $this->conn->query("DELETE FROM klanten WHERE Klant_ID = '$klant_id' ");
        return $result;
    }




    //encryption
    function encryped($message){

        $nonceSize = openssl_cipher_iv_length(self::key);
        $nonce = openssl_random_pseudo_bytes($nonceSize);
        
        $ciphertext = openssl_encrypt(
            $message,
            self::key,
            $this->binary,
            OPENSSL_RAW_DATA,
            $nonce
        );
        
        // Now let's pack the IV and the ciphertext together
        // Naively, we can just concatenate

        return base64_encode($nonce.$ciphertext);
    }

    function decryped($message){
        $message = base64_decode($message, true);

        $nonceSize = openssl_cipher_iv_length(self::key);
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
        
        $plaintext = openssl_decrypt(
            $ciphertext,
            self::key,
            $this->binary,
            OPENSSL_RAW_DATA,
            $nonce
        );
        
        return $plaintext;
    }


}