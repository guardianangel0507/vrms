<?php
require_once SITE_ROOT.'lib/utility/helpers.php';
class Authentication
{
    private $dbo;

    public function __construct()
    {
        $this->dbo = new Database();
        consoleLogger("Authentication Initialized");
    }

    public function authLogin($username, $password)
    {
        $loginQuery = "SELECT userID FROM tb_users WHERE username = :username AND password = :password";
//        $loginQuery = "SELECT userID  FROM tb_users WHERE username = 'amrameen769' AND password = '7025'";
        $this->dbo->query($loginQuery);
        $this->dbo->bind(':username', $username);
        $this->dbo->bind(':password', $password);
        return $this->dbo->fetchSingleResult();
    }

    public function getUserTypes()
    {
        $getQuery = "SELECT DISTINCT(userType) as userType from tb_users WHERE userType is not null";
        $this->dbo->query($getQuery);
        return $this->dbo->fetchMultipleResults();
    }

    public function authRegister($authData)
    {
        $regQuery = "INSERT INTO tb_users SET username = :username, password = :password, name = :name, email = :email, phoneNo = :phoneNo";
        $this->dbo->query($regQuery);
        $this->dbo->bind(':username', $authData['username']);
        $this->dbo->bind(':password', $authData['password']);
        $this->dbo->bind(':name', $authData['name']);
        $this->dbo->bind(':email', $authData['email']);
        $this->dbo->bind(':phoneNo', $authData['phoneNo']);
        if($this->dbo->execute()){
            echo "Insertion successful";
        } else {
            echo "Insertion failed";
        }
    }
}
