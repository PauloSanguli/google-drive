
<?php

    class DB{
        private $host;
        private $username;
        private $db;

        function __construct($host, $username, $db)
        {
            $this->host=$host;
            $this->username=$username;
            $this->db=$db;
        }
        public function connect()
        {
            // conectando ao bancod de dados
            try{
                $str_conn = "mysql:host=".$this->host.";dbname=".$this->db;
                $conn = new PDO($str_conn,$this->username);
            }catch (Exception $er){
                return false;
            }
            return $conn;
        }
    }
?>