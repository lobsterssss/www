<?php

class Database {
//SELECT users.name, leaderboard.id FROM users INNER JOIN leaderboard ON users.id = leaderboard.userName;
    private $conn;
    private $binary;
    const key = "aes-128-ctr";


   function __construct()
    {
    // $hostname = '195.168.0.3:3306';
    $username = 'root';
    $password = '';
    $dbname = 'test_kookproject';
    $this->binary = hex2bin('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');
    $this->conn = new PDO("mysql:dbname=$dbname", $username, $password);
   }

   function close()
   {
    $this->conn = null;
   }

    function get_Login($email, $password)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT users.userName, users.id, users.password, user_settings.theme FROM users INNER JOIN user_settings ON users.id = user_settings.user WHERE  users.email = '$email'")->fetch();
        if(!$result)
        return;
        if($this->decryped($result["password"]) == $password)
        return $result;
    }

    function get_all_medicine()
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT * FROM medicine")->fetch();
        return $result;
    }

    function get_user($name, $id)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT users.email, users.userName , user_settings.public FROM users INNER JOIN user_settings ON users.id = user_settings.user  WHERE  users.userName = '$name' AND users.id = $id")->fetch();
        return $result;
    }

    function set_user($email, $password, $username)
    {

        $temp = $this->conn->query("SELECT users.email FROM users WHERE users.email = '$email'")->fetchAll();
        if(!isset($temp[0])){

            $password = $this->encryped($password);
            $result = $this->conn->query("INSERT INTO users (email, userName, password) VALUES ('$email','$username','$password')");
            if($result)
                $this->conn->query("INSERT INTO user_settings (user_settings.user) SELECT users.id FROM users WHERE users.email = '$email'");
            return $result;
        }
    }

    
    function get_schedule()
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT * FROM schedule")->fetchAll();
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