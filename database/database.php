<?php

class Database
{
    //SELECT users.name, leaderboard.id FROM users INNER JOIN leaderboard ON users.id = leaderboard.userName;
    private $conn;
    private $binary;
    const key = "aes-128-ctr";


    function __construct()
    {
        $hostname = '192.168.155.208:3306';
        $username = 'KADIR';
        $password = 'RIAQCTzg5!_@g[sJ';
        $dbname = 'MediTurn';
        $this->binary = hex2bin('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');
        $this->conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    }

    function close()
    {
        $this->conn = null;
    }

    function set_user($email, $password, $name)
    {

        $temp = $this->conn->query("SELECT Accounts.E-mail FROM Accounts WHERE Accounts.E-mail = '$email'")->fetchAll();
        if (!isset($temp[0])) {

            $password = $this->encryped($password);
            $result = $this->conn->query("INSERT INTO Accounts (E-mail, GB, WW) VALUES ('$email','$name','$password')");
            // if($result)
            //     $this->conn->query("INSERT INTO user_settings (user_settings.user) SELECT users.id FROM users WHERE users.email = '$email'");
            return $result;
        }
    }

    function get_Login($email, $password)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT Accounts.GB, Accounts.Account_ID, Accounts.WW FROM Accounts WHERE Accounts.`E-mail` = '$email'")->fetch();
        if (!$result)
            return;
        if ($this->decryped($result["WW"]) == $password)
            return $result;
    }

    function get_all_medicine()
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT * FROM schedule")->fetch();
        return $result;
    }

    function get_customer($id)
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT Klanten.Naam_Klant, Klanten.Email, Klanten.Achternaam, Klanten.Telefoonnummer, Klanten.Leeftijd, Klanten.Woonplaats, Klanten.Postcode, Klanten.Adres FROM Klanten WHERE Klanten.Klant_ID = $id")->fetch();
        return $result;
    }

    function get_all_user_customers()
    {
        //check validation AND users.verified = 1
        $result = $this->conn->query("SELECT * FROM Klanten")->fetchAll();
        return $result;
    }

    function get_all_plannings()
    {
        $result = $this->conn->query("SELECT p.*, k.Naam_Klant FROM Planning p JOIN Klanten k ON p.Klant_ID = k.Klant_ID")->fetchAll();
        return $result;
    }


    function set_klant($email, $name, $lastname, $telefoon)
    {

        $temp = $this->conn->query("SELECT Klanten.email FROM Klanten WHERE Klanten.Email = '$email'")->fetchAll();
        if (!isset($temp[0])) {

            $result = $this->conn->query("INSERT INTO Klanten (email, Naam_Klant, Achternaam, Telefoonnummer) VALUES ('$email','$name','$lastname','$telefoon')");

            return $result;
        }
    }

    function get_all_medicijnen()
    {
        $query = "SELECT medicijn_id, medicijn_naam FROM medicijnen";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function get_schedule()
    {
        $query = "SELECT schedule.*, patienten.patient_naam, medicijnen.medicijn_naam 
              FROM schedule
              JOIN patienten ON schedule.patient_id = patienten.patient_id
              JOIN medicijnen ON schedule.medicijn_id = medicijnen.medicijn_id";  // Join on medicatie (which stores medicijn_id)
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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



    function create_planning($klant_id, $medicatie, $inname_frequentie, $datum, $tijd, $dosering, $beperking)
    {
        // Prepare the SQL query to insert the data into the Planning table
        $query = "INSERT INTO Planning (Klant_ID, Medi_ID, Inname_frequentie, Datum, Tijd, Dosering, Beperking) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Execute the query with the provided data
        $success = $stmt->execute([$klant_id, $medicatie, $inname_frequentie, $datum, $tijd, $dosering, $beperking]);

        // Return true if the insertion was successful, false otherwise
        return $success;
    }




    function update_schedule($id, $patient_id, $medicijn_id, $dosering, $datum, $tijdstip)
    {
        try {
            $query = "UPDATE schedule 
                      SET patient_id = :patient_id,
                          medicijn_id = :medicijn_id,
                          dosering = :dosering,
                          datum = :datum,
                          tijdstip = :tijdstip
                      WHERE schedule_id = :id";

            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                ':id' => $id,
                ':patient_id' => $patient_id,
                ':medicijn_id' => $medicijn_id,
                ':dosering' => $dosering,
                ':datum' => $datum,
                ':tijdstip' => $tijdstip
            ]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    function delete_schedule($id)
    {
        $query = "DELETE FROM schedule WHERE schedule_id = :id"; // Use the actual primary key column name
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }


    function get_schedule_by_id($id)
    {
        $query = "SELECT schedule.*, patienten.patient_naam, medicijnen.medicijn_naam 
                  FROM schedule 
                  JOIN patienten ON schedule.patient_id = patienten.patient_id 
                  JOIN medicijnen ON schedule.medicijn_id = medicijnen.medicijn_id 
                  WHERE schedule.schedule_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //encryption
    function encryped($message)
    {

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

        return base64_encode($nonce . $ciphertext);
    }

    function decryped($message)
    {
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
