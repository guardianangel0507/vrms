## register.php (script)

Here also we need to include the [config/init.php](../../config/init.php). Because we use sessions, and the session_start() is called in [config.php](../../config/config.php), as well as, the [**register.php**](register.php) is an independent script, means it is **not** accessed using [Template](../utility/Template.php) class.  

`$authErrors`  - Array to store error messages.

`$authSuccess`  - Array to store success messages.

`$authData` - Associative array initialized with empty key - value pairs.

The **signup-form**'s `action` attribute directs the form's POST data to [register.php](register.php). Check [authorization.php](../../public/default/authorization.php) for this in detail.

The signup-form's submit button name is `signup`. 

Hence, we check if that `$_POST` key-value pair is initialized or not. Remember the concept, `$_POST` is already initialized, but the key-value pairs are not. They are created and initialized only when an http POST request sends data to the server. Here in our case, the signup-form sends POST data to the server, which is received at [register.php](register.php).

So, if `signup` key is initialized, we create `$logAuth` object of the [Authentication](../auth/Authentication.php) class. 

Then server checks for each key-value pairs sent from signup-form in POST array. If those key-value pairs are initialized, then those values are added to the `$authData`. 

For password validation, we checks one more thing with the value checking `if()`, that is ,

```php
if (isset($_POST['password']) && isset($_POST['cPassword']) && $_POST['cPassword'] === $_POST['password'])
```

if all 3 conditions satisfy true, then only password key-value pair is added to `$authData`.  And if not, we push an error message to `$authErrors` array using `array_push()` method. Google about `array_push()`. 

Then, we have to validate the userType. This is because, hackers can hijack the forms with their own values on radio buttons, and submit them to form. So, if they submit userTypes other than `manufacturer and customer`(Only they have the provision to Register), the server should not accept it. That is why we do this validation. 

For this, first we stored the userType data from POST array to `$userType`. Then we created another array `$vaidUserTypes` with items `"manufacturer"` and `"customer"`. Then, we use the `in_array()` function to check whether the `$userType` is in the `$validUserTypes` array. If there is, it adds the `$userType` to `$authData`. If not, error message is pushed to `$authErrors`. 

Then server should execute the `authRegister()` method only if there is no errors so far. If there is an error, the server should skip executing `authRegister()`. For that, we use the `empty()` method which returns true or false according to whether the passed array is empty or not. Here, the passed array is `$authErrors`. If there is no errors, the `$authErrors` will be empty and `empty()` returns true. If there are errors, `empty()` returns false. If there are no errors, then we execute the `authRegister()` method, which returns true or false according to success or failure of registration respectively. Check [Authentication](../auth/Authentication.php) class for more details about `authRegister()`. 

If success, we push success message to `$authSuccess` array. And makes the `$authData` as null. If failed, we push error message to `$authErrors` array. 

Then to pass these `$authErrors` and `$authSuccess` messages arrays, we use session variables. 

```php
$_SESSION['messages']['authErrors'] = isset($_SESSION['messages']['authErrors']) ? array_merge($_SESSION['messages']['authErrors'], $authErrors) : $authErrors;
$_SESSION['messages']['authSuccess'] = $authSuccess;
$_SESSION['authData'] = $authData;
$_SESSION['formName'] = "signup";
```

here for `$_SESSION['messages']['authErrors']` we used an `isset()` to check if that session variable is already initialized or not. Because, in the `authRegister()` method, for a specific error, we initialize this session variable. So if initialized before, we merges the `$authErrors` with this session variable using `array_merge()` method. and If not, then we initialize it with `$authErrors`.

For more details about these session initializations, check [home-route.php](../../public/default/home-route.php) and [authorization.php](../../public/default/authorization.php). 

The `header()` function is used to redirect to the specific location we pass in to the function.  This is only one use of `header()` function. Google to get more details about. 

FYI: Anything after `header()` function will not be executed by the server.