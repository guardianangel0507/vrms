## Authentication.php

This Authentication class is used to make Authorisation processes, such as Login, Register, etc., at ease. It has only one private data member, the `$dbo`, which is the [Database Class](../dbconnect/Database.php) Object.

The `$dbo` is initialised inside the `__construct()` method.

```php
$this->dbo = new Database();
```

And all else functions, you can refer to and understand. Read the [Database Readme](../dbconnect/Database.readme.md) for more details and then only continue.

#### *findUser($username, $email)*

This method is called from `authRegister()` in order to check whether a user already exists with same email or not. 

We use `$findUserQuery` to return `userID` of an existing user. 

The `return` statement, returns `true` if there is a result, returns `false` if there is not.

#### *authRegister($authData)*

This method is called from [register.php](../scripts/register.php).

`$authData` is an associative array with all user data needed for user registration. 

it will look like,

```php
$authData = array(
    'name' => '',
    'email' => '',
    'username' => '',
    'password' => '',
    'phoneNo' => '',
    'address' => '',
    'userType' => ''
);
```

Refer [register.php](../scripts/register.php) for more details.

When this `$authData` comes inside `authRegister()` there will be real data inside. 

Here, first we need to do is, check whether there is a user with same username or email. For that we call the `findUser()` method, and sets the session variable,

```php
$_SESSION['messages']['authErrors'] = array("Username or Email Already Exists");
```

 and then returns `false` to [register.php](../scripts/register.php). 

Then we created the `$regQuery`. Then we prepared `$regQuery` with the `query()` method of `dbo` [Database](../dbconnect/Database.php) Object initialised inside `__construct()`. Then we use the `bind()` method to bind data to the `$regQuery`.  

We use a `foreach()` to iterate through `$authData` an bind each value. Make sure the **placeholder** names are identical to `key`'s of `$authData`.

During binding, we need to check the `userType` of the registering user, in order to set their `activeStatus`. 

FYI(For Your Info) : Our system has only one type of user except admin, whose `activeStatus` is `true` or `1` by default, who's that? The Customer.  All other users' `activeStatus` is `false` or `0`  by default. 

So, what we do is, check the `userType` came from the [register.php](../scripts/register.php), through `$authData` by,

```php
if($authData['userType'] == "customer")
```

if it is `"customer"` we bind `activeStatus` with `true`. Else, we bind `activeStatus` with `0`. We can't pass `false` to bind with the query, because PHP's `false` doesn't have any value, it is empty. So we pass `0` instead of `false`. Meanwhile, PHP's `true` has value `1`. 

```php
echo true; // 1
echo "<br>";
echo false; // nothing will be shown
echo "<br>";
echo true; // 1
```

Try this in [tester.php](../../temp/tester.php). 

Then we execute the prepared query using `execute()` method of `dbo` [Database](../dbconnect/Database.php) Class Object. And returns `true` if execution is success or `false` if execution is failure. Check [Database.php](../dbconnect/Database.php) or [Database.readme](../dbconnect/Database.readme.md). and do little googling.

When it returns true, the User is Registered for VRMS. Check [register.php](../scripts/register.php) and [register.readme](../scripts/register.readme.md) for the rest of this process.

#### *isUserLoggedIn($userID, $username)*

This method is used to find out whether the user is logged into the VRMS system before, and forgot to log out. We use Token Authentication in VRMS in order to implement better security. 

In order to use that, we need to Create another table called `tb_auth`, with following attributes,

| Attribute Name | Datatype     | Constraint                      |
| -------------- | ------------ | ------------------------------- |
| id             | int          | PRIMARY KEY, AUTO INCREMENT     |
| userID         | int          | FOREIGN KEY references tb_users |
| username       | varchar(255) |                                 |
| token          | varchar(255) | UNIQUE                          |
| isLoggedIn     | boolean      |                                 |

Also, this method comes in handy, when a user accidentally closed the VRMS website, then, they don't have to login again using the signin form, instead, they will be logged in  according to the token provided. This method is called from the `authLogin()` function below.

So, what this does is,

First we execute the `$isLogQuery`, which returns the `token` of the user from `tb_auth` with bound `username` and `userID`. 

If the user is logged in this data is stored in `loggedUser`, and then updates the `isLoggedIn` attribute of `tb_auth` to `true`. And then returns the `token`. If the user is not logged in yet to the system, that is, `$isLogQuery` returns `false`, then this function returns an empty string as token to the `authLogin()` function, when called.

#### *authLogin($username, $password)*

This method is called from [login.php](../scripts/login.php).

`$authErrors` - An empty array to store errors during login.

`$loginQuery` - A PHP String variable to store the query, which retrieves `userID, userType, activeStatus` of the user with corresponding username and password.

Check the query and following to see the implementation of [Database](../dbconnect/Database.php) `bind()` method.

Now,

```php
if ($user = $this->dbo->fetchSingleResult())
```

What this `if statement` does is, it calls the `fetchSingleResut()` method of the [Database](../dbconnect/Database.php) class by the object `dbo`, which executes the `$loginQuery`, because, it is the one that's prepared for execution by the  `query()`method of [Database](../dbconnect/Database.php) class. So, when `fetchSingleResut()` is called, it returns a PDO object with the values of attributes we specified in the query(`userID, userType, activeStatus`), and is stored into the `$user` variable, if there is a User exists.

If not, it returns a `false` value, that means there is no User with provided credentials, that means, the `username` and `password`  are invalid. So PHP run-time skips `if` to the `else` part and pushes an error message to the `$authErrors` . Then it creates session variable  `$_SESSION['messages']['authErrors']` and sets its value as `$authErrors`. And returns `false` to the [login.php](../scripts/login.php). 

```php
array_push($authErrors, "Authentication Failed, Invalid Username or Password");
$_SESSION['messages']['authErrors'] = $authErrors;
return false;
```

Lets recall to, if a PDO object is returned, then:

We know, or the PHP Run-time(can also be referred as Server) knows that, there is a user exists with the provided credentials.

Then, server needs to know is that whether that user is Approved or Not by the Admin. Where did we store this value? Yeah, the `activeStatus` attribute of `tb_users`. 

So, what server has to do is, check if the currently retrieved user is active or not. For that, we use, 

```php
if ($user->activeStatus)
```

You know the basic rule of `if` statement? `if(1 or true)` executes the block and `if(0 or false)` skips the block.

So, according to the value of `activeStatus`, server identifies whether that user is active or not(Approved or Not). For example, lets suppose, value of `activeStatus` is `1 or true`. So, the `if($user->activeStatus)` becomes `if(1)` or `if(true)`, either of them executes the block. Suppose,  value of `activeStatus` is `0 or false`. Then, the `if($user->activeStatus)` becomes `if(0)` or `if(false)`, neither of them executes the block, and skips to `else` block.

So, if user is active, we calls the `isUserloggedIn()` method to check if the user is already logged into the System. 

```php
$token = $this->isUserLoggedIn($user->userID, $username);
```

If yes, it returns the `token` to `$token` variable, if not, it returns an empty string to `$token` variable. 

Then we checks if `$token` is empty or not. If empty, then we creates a token with

```php
tryTokenAgain:
	try {
    	$token = bin2hex(random_bytes(32));
	} catch (Exception $e) {
        goto tryTokenAgain;
	}
```

This method has a chance to generate Exception, so we put it inside a `try catch` block. And in the `catch` block, we used a `goto` statement to try token generation again.

Once the token is generated, we insert this user into the `tb_auth` table with the `$tokenQuery`. After it is executed successfully, we adds `username` and `token` to the `$user` object, we created with the `$loginQuery`. And returns that `$user` object to the [login.php](../scripts/login.php). 

Now, if user is inactive, that means `activeStatus` is `false or 0`, 

```php
array_push($authErrors, "User is not yet Approved");
$_SESSION['messages']['authErrors'] = $authErrors;
return false;
```

The server pushes another error to the `$authErrors` array and put it as the value for `$_SESSION['messages']['authErrors']`.  And returns false to [login.php](../scripts/login.php). 

#### *authLogout($userID, $username, $token)*

This method is called from [logout.php](../scripts/logout.php). 

What we does here is very simple. We updates the value of `isLoggedIn` attribute of the table `tb_auth` to false, of the corresponding `$userID, $username,$token`. It returns `true` or `false` to [logout.php](../scripts/logout.php). 