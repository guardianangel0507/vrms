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

    public function isAuthorized($userType)
    {
        if ($_SESSION['userData']->userType === $userType) {
            return isset($_SESSION['authorized']) && $_SESSION['authorized'] == true;
        } else {
            return false;
        }
    }

    public function findUserByID($userID)
    {
        $findUserQuery = "SELECT userID, name, username, email, phoneNo, address, userType FROM tb_users WHERE userID = :userID";
        $this->dbo->query($findUserQuery);
        $this->dbo->bind(':userID', $userID);
        if ($userData = $this->dbo->fetchSingleResult()) {
            return $userData;
        } else {
            return false;
        }
    }

    public function addUser($userData)
    {
        $authErrors = array();
        if ($userData['userType'] === "dealer") {
            $addDealer = "INSERT INTO tb_users SET username = :username, password = :password, name = :name, email = :email, phoneNo = :phoneNo, address = :address, userType = :userType";
            $this->dbo->query($addDealer);
            foreach ($userData as $key => $data) {
                $this->dbo->bind(":$key", $data);
            }
            if ($this->dbo->execute()) {
                $this->dbo->query("SELECT userID from tb_users WHERE username = :username");
                $this->dbo->bind(":username", $userData['username']);
                if ($user = $this->dbo->fetchSingleResult()) {
                    $this->initializeUser($user->userID, $userData['userType'], $userData['manufacturerID']);
                } else {
                    array_push($authErrors, "User not found");
                }
            } else {
                array_push($authErrors, "Adding Dealer failed");
            }
        }
        if (empty($authErrors)) {
            return true;
        } else {
            $_SESSION['messages']['authErrors'] = $authErrors;
            return false;
        }
    }

    private function initializeUser($userID, $userType, $manufacturerID = null)
    {
        switch ($userType) {
            case "customer":
                $addUserToTable = "INSERT INTO tb_customers SET customerID = :userID";
                $this->dbo->query($addUserToTable);
                $this->dbo->bind(':userID', $userID);
                $this->dbo->execute() or die("Error");
                break;
            case "manufacturer":
                $addUserToTable = "INSERT INTO tb_manufacturers SET manufacturerID = :userID";
                $this->dbo->query($addUserToTable);
                $this->dbo->bind(':userID', $userID);
                $this->dbo->execute() or die("Error");
                break;
            case "dealer":
                if (isset($manufacturerID)) {
                    $addUserToTable = "INSERT INTO tb_dealers SET dealerID = :userID, manufacturerID = :manufacturerID";
                    $this->dbo->query($addUserToTable);
                    $this->dbo->bind(':userID', $userID);
                    $this->dbo->bind(':manufacturerID', $manufacturerID);
                    $this->dbo->execute() or die("Error");
                } else {
                    if (isset($_SESSION['messages']['authErrors'])) {
                        $_SESSION['messages']['authErrors'] = array_merge($_SESSION['messages']['authErrors'], array("No Manufacturer found for Dealer"));
                    } else {
                        $_SESSION['messages']['authErrors'] = array("No Manufacturer found for Dealer");
                    }
                    return false;
                }
                break;
            default:
                return true;
        }
        return true;
    }

    public function authRegister($authData)
    {
        if ($this->findUser($authData['username'], $authData['email'])) {
            $_SESSION['messages']['authErrors'] = array("Username or Email Already Exists");
            return false;
        }
        $regQuery = "INSERT INTO tb_users SET username = :username, password = :password, name = :name, email = :email, phoneNo = :phoneNo, address = :address, userType = :userType, activeStatus = :activeStatus";
        $this->dbo->query($regQuery);
        foreach ($authData as $key => $data) {
            if ($key == "userType") {
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

    private function findUser($username, $email)
    {
        $findUserQuery = "SELECT userID FROM tb_users WHERE username = :username OR email = :email";
        $this->dbo->query($findUserQuery);
        $this->dbo->bind(':username', $username);
        $this->dbo->bind(':email', $email);
        return $this->dbo->fetchSingleResult() ? true : false;
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
                    if (!$this->checkInitialized($user->userID, $user->userType)) {
                        if ($this->initializeUser($user->userID, $user->userType)) {
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
                            array_push($authErrors, "Initialization failed");
                            if (isset($_SESSION['messages']['authErrors'])) {
                                $_SESSION['messages']['authErrors'] = array_merge($_SESSION['messages']['authErrors'], $authErrors);
                            } else {
                                $_SESSION['messages']['authErrors'] = $authErrors;
                            }
                            return false;
                        }
                    } else {
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
                    }
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

    private function checkInitialized($userID, $userType)
    {
        if ($userType === "manufacturer") {
            $this->dbo->query("SELECT ID FROM tb_manufacturers WHERE manufacturerID = $userID");
            if ($this->dbo->fetchSingleResult()) {
                return true;
            } else {
                return false;
            }
        } else if ($userType === "dealer") {
            $this->dbo->query("SELECT ID FROM tb_dealers WHERE dealerID = $userID");
            if ($this->dbo->fetchSingleResult()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
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
