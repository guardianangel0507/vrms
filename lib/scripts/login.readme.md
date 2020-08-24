## login.php (script)

Here also we need to include the [config/init.php](../../config/init.php). 

The **signin-form**'s `action` attribute directs the form's POST data to [login.php](login.php). Check [authorization.php](../../public/default/authorization.php) for this in detail.

The signup-form's submit button name is `login`. 

Hence, we check if that `$_POST` key-value pair is initialized or not. Remember the concept, `$_POST` is already initialized, but the key-value pairs are not. They are created and initialized only when an http POST request sends data to the server. Here in our case, the signin-form sends POST data to the server, which is received at [login.php](login.php).

now we check whether `login` key value pair is initialized or not, that is if button is clicked or not. If clicked, the server calls `authLogin()` method, which returns userData or false. Check [Authentication](../auth/Authentication.php) class for more details.

if there is userData returned, it is stored in `$user`, the `$_SESSION['authorized']` to `true` and stores the `$user` to another session variable, `userData`.

if `false` is returned, it skips the `if` block and in the `else` block, sets the `$_SESSION['authorized']` to `false`.

For more details about these session initializations, check [home-route.php](../../public/default/home-route.php) and [authorization.php](../../public/default/authorization.php). 

The `header()` function is used to redirect to the specific location we pass in to the function.  This is only one use of `header()` function. Google to get more details about. 

FYI: Anything after `header()` function will not be executed by the server.