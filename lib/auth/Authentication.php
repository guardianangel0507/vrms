<?php
require_once SITE_ROOT . 'lib/utility/helpers.php';

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
//        return $this->dbo->fetchSingleResult();
        if ($user = $this->dbo->fetchSingleResult()) {
            $token = $this->isUserLoggedIn($user->userID, $username);
            if ($token === "") {
                try {
                    $token = bin2hex(random_bytes(32));
                } catch (Exception $e) {
                    consoleLogger("Authentication Failed, Token Error, Try Again" . $e->getMessage());
                }
                $tokenQuery = "INSERT INTO tb_auth SET userID = :userID, username = :username, token = :token, isLoggedIn = true";
                $this->dbo->query($tokenQuery);
                $this->dbo->bind(':userID', $user->userID);
                $this->dbo->bind(':username', $username);
                $this->dbo->bind(':token', $token);
                if ($this->dbo->execute()) {
                    consoleLogger("Authenticated");
                    $user->username = $username;
                    $user->token = $token;
                    return $user;
                } else return 0;
            } else {
                consoleLogger("Authenticated");
                $user->username = $username;
                $user->token = $token;
                return $user;
            }
        } else {
            return 0;
        }
    }

    private function isUserLoggedIn($userID, $username)
    {
        $isLogQuery = "SELECT username, token FROM tb_auth WHERE userID = :userID AND username = :username";
        $this->dbo->query($isLogQuery);
        $this->dbo->bind(':userID', $userID);
        $this->dbo->bind(':username', $username);
        if ($loggedUser = $this->dbo->fetchSingleResult()) {
            $updateLoginQuery = "UPDATE tb_auth SET isLoggedIn = true WHERE userID = :userID AND username = :username";
            $this->dbo->query($updateLoginQuery);
            $this->dbo->bind(':userID', $userID);
            $this->dbo->bind(':username', $username);
            $this->dbo->execute();
            return $loggedUser->token;
        } else {
            return "";
        }
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
        if ($this->dbo->execute()) {
            echo "Insertion successful";
        } else {
            echo "Insertion failed";
        }
    }
}
