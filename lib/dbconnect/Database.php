<?php

class Database
{
    // DB Properties
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_password = DB_PASS;
    private $db_name = DB_NAME;

    private $db_handler;
    private $db_error;
    private $db_stmt;

    // Methods
    public function __construct()
    {
        // PDO Data Source Name 
        $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;

        // PDO Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        // PDO Instance
        try {
            $this->db_handler = new PDO($dsn, $this->db_user, $this->db_password, $options);
        } catch (PDOException $pde) {
            $this->db_error = $pde->getMessage();
        }
    }

    public function query($query)
    {
        $this->db_stmt = $this->db_handler->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        $value = $this->cleanData($value);
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->db_stmt->bindValue($param, $value, $type);
    }

//    public function execute()
//    {
//        try {
//            $this->db_stmt->execute();
//        } catch (PDOException $pde){
//            $this->db_error = $pde->getMessage();
//        }
//        if($this->db_error == ""){
//            return true;
//        } else {
//            echo $this->db_error;
//            $this->db_error = "";
//            return false;
//        }
//    }

    public function execute()
    {
        return $this->db_stmt->execute();
    }

    public function executeWithReturnID(){
		if($this->db_stmt->execute()){
			return $this->db_handler->lastInsertId();
		}
		return 0;
	}

    public function fetchMultipleResults()
    {
        $this->execute();
        return $this->db_stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetchSingleResult()
    {
        $this->execute();
        return $this->db_stmt->fetch(PDO::FETCH_OBJ);
    }

    private function cleanData($data)
    {
        return stripslashes(htmlspecialchars($data));
    }
}
