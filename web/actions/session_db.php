<?php

class session_db implements ArrayAccess {

    private  mysqli $db; // adatbázis kapcsolat
    private string $_session_id; // session azonosító
    public function __construct(){}
    public function session_db_start(): void{
        $user = "infogy";
        $host = "localhost";
        $pass = "PF15kap*";
        $db = "feladatbank";

        try {
            $conn = mysqli_connect($host, $user, $pass, $db);
        } catch (mysqli_sql_exception $e) {
            die("Hiba lépett fel az adatbázis kapcsolódása közben: " . $e->getMessage());
        }
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $this->db = $conn;
        $this->_session_id = session_id();
    }

    // ArrayAccess
    public function offsetExists($offset): bool
    {
        $sql = "SELECT session_data FROM session_db WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $this->_session_id);
        $query->execute();


        if ($row = $query->get_result()->fetch_assoc()) {
            $session_data = json_decode($row['session_data'], true); // Decode JSON to an array
            return isset($session_data[$offset]); // Check if the key exists in the JSON
        }
        return false;
    }

    public function offsetGet($offset) : mixed
    {
        $sql = "SELECT session_data FROM session_db WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $this->_session_id);
        $query->execute();

        if($row = $query->get_result()->fetch_assoc()){
            $session_data = json_decode($row['session_data'], true); // TEXT-ből JSON struct
            return $session_data[$offset] ?? null; // ha létezik a JSON ben akkor visszaadja az értéket value-t
        }

        return null;
    }

    public function offsetSet($offset, $value): void
    {
        $sql = "SELECT session_data FROM session_db WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $this->_session_id);
        $query->execute();
        $result = $query->get_result();

        if($result->num_rows === 1){ // ha létezik a session
            $row = $result->fetch_assoc();
            $session_data = json_decode($row['session_data'], true) ?? null;

            $session_data[$offset] = $value; // érték beállítása a JSON key-en

            $sql = "UPDATE session_db SET session_data = ? WHERE session_id = ?";
            $query = $this->db->prepare($sql);
            $json_data = json_encode($session_data);
            $query->bind_param("ss", $json_data, $this->_session_id);
            $query->execute();
        }else{
            $session_data = json_encode([$offset => $value]); // key value JSON encode

            $sql = "INSERT INTO session_db (session_id, session_data) VALUES (?, ?)";
            $query = $this->db->prepare($sql);
            $query->bind_param("ss", $this->_session_id, $session_data);
            $query->execute();
        }


    }

    public function offsetUnset($offset): void
    {
        $sql = "SELECT session_data FROM session_db WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $this->_session_id);
        $query->execute();

        if($row = $query->get_result()->fetch_assoc()){
            $session_data = json_decode($row['session_data'], true) ?? null;
            if(isset($session_data[$offset])){
                unset($session_data[$offset]); // érték nullára állítása
            }

            $json_data = json_encode($session_data);


            $sql = "UPDATE session_db SET session_data = ? WHERE session_id = ?"; // firssíti a sessiont
            $query = $this->db->prepare($sql);
            $query->bind_param("ss", $json_data, $this->_session_id);
            $query->execute();
        }
    }
    public function session_db_destroy(): void
    {
        $sql = "DELETE FROM session_db WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s", $this->_session_id);
        $query->execute();
        $_SESSION = []; // destroy session in PHP too
    }
    public function session_db_unset(): void
    {
        $sql = "UPDATE session_db SET session_data = '' WHERE session_id = ?";
        $query = $this->db->prepare($sql);
        $query->bind_param("s",$this->_session_id);
        $query->execute();
        session_unset();
    }

}

$_SESSION_DB = new session_db();
