## logout.php (script)

Here also we need to include the [config/init.php](../../config/init.php). 

But here, we receive a simple GET with `id` parameter from the `logout` button in the Navigation Bar. Check [home-route.php](../../public/default/home-route.php)'s `authNav` variables for details. There are 4 types of `authNav`'s. Check all of them.

When that `id` is recieved through GET array, we check whether the `userID` we received now is as same as the one present in the session variable also. This is to ensure that the correct user is trying to logout of the system. This will ensure no other user can hijack and logout another user. 

Now, if the `userID` are same, then we retrieve `userName` and `token` from session and stores them in respective variables. Then we call the `authLogout()` method of [Authentication](../auth/Authentication.php) class. Check this function from there for more details. If this returns true, then we reset all session variables using `session_unset()` and destroy the session using `session_destroy()`. if returns false, we initializes the `authErrors` session variable with an error message. 

If `userID` are different, we initializes the `authErrors` session variable with another error. And redirect to [home-route.php](../../public/default/home-route.php) using `header()` function.