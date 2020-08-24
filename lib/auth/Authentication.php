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

    private function findUser($username, $email){
        $findUserQuery = "SELECT userID FROM tb_users WHERE username = :username OR email = :email";
        $this->dbo->query($findUserQuery);
        $this->dbo->bind(':username', $username);
        $this->dbo->bind(':email', $email);
        return $this->dbo->fetchSingleResult() ? true : false;
    }

    public function authRegister($authData)
    {
        if($this->findUser($authData['username'], $authData['email'])){
            $_SESSION['messages']['authErrors'] = array("Username or Email Already Exists");
            return false;
        }
        $regQuery = "INSERT INTO tb_users SET username = :username, password = :password, name = :name, email = :email, phoneNo = :phoneNo, address = :address, userType = :userType, activeStatus = :activeStatus";
        $this->dbo->query($regQuery);
        foreach($authData as $key => $data){
            if($key == "userType"){
                if ($data == "customer") {
                    $this->dbo->bind(":activeStatus", true);
                } else {
                    $this->dbo->bind(":activeStatus", 0);
                }
            }
            $this->dbo->bind(":$key", $data);
        }
        if ($this->dbo->execute()) {
            return true;
        } else {
            return false;
        }
    }

    private function isUserLoggedIn($userID, $username)
    {
        $isLogQuery = "SELECT token FROM tb_auth WHERE userID = :userID AND username = :username";
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

    public function authLogin($username, $password)
    {
        $authErrors = array();
        $loginQuery = "SELECT userID, userType, activeStatus FROM tb_users WHERE username = :username AND password = :password";
//        $loginQuery = "SELECT userID  FROM tb_users WHERE username = 'amrameen769' AND password = '7025'";
        $this->dbo->query($loginQuery);
        $this->dbo->bind(':username', $username);
        $this->dbo->bind(':password', $password);
//        return $this->dbo->fetchSingleResult();
        if ($user = $this->dbo->fetchSingleResult()) {
            if ($user->activeStatus) {
                $token = $this->isUserLoggedIn($user->userID, $username);
                if ($token === "") {
                    tryTokenAgain:
                    try {
                        $token = bin2hex(random_bytes(32));
                    } catch (Exception $e) {
                        goto tryTokenAgain;
//                        consoleLogger("Authentication Failed, Token Error, Try Again" . $e->getMessage());
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
                    } else return false;
                } else {
                    consoleLogger("Authenticated");
                    $user->username = $username;
                    $user->token = $token;
                    return $user;
                }
            } else {
                array_push($authErrors, "User is not yet Approved");
                $_SESSION['messages']['authErrors'] = $authErrors;
//                print_r($authErrors);
                return false;
            }
        } else {
            array_push($authErrors, "Authentication Failed, Invalid Username or Password");
//            print_r($authErrors);
            $_SESSION['messages']['authErrors'] = $authErrors;
            return false;
        }
    }

    public function authLogout($userID, $username, $token)
    {
        $updateLoginQuery = "UPDATE tb_auth SET isLoggedIn = false WHERE userID = :userID AND username = :username AND token = :token";
        $this->dbo->query($updateLoginQuery);
        $this->dbo->bind(':userID', $userID);
        $this->dbo->bind(':username', $username);
        $this->dbo->bind(':token', $token);
        return $this->dbo->execute() ? true : false;
    }

    public function getUserTypes()
    {
        $getQuery = "SELECT DISTINCT(userType) as userType from tb_users WHERE userType is not null";
        $this->dbo->query($getQuery);
        return $this->dbo->fetchMultipleResults();
    }
}
