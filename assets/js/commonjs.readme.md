## Common.Js

This common.js file is used to perform simple form transition in a click of button. Check [authorization.php](../../public/default/authorization.php). There we got two divisions with id's, *signin-form* and *signup-form*. And check the [home-route.php](../../public/default/home-route.php). There under the first *if statement*, you can see the template object, and a runtime argument called *authNav*. It has two buttons with id's, *signin* and *signup*. When the [header.php](../../public/default/header.php) is included, check the div with id *navbarCollapse*. The runtime argument *authNav* is echoed there as **$authNav**. 

Then we called the *switchAuth()* function at the bottom of [authorization.php](../../public/default/authorization.php). 

What this function does is,

first stores the div ids in two variables signinform and signupform.

then, we check if the *#signin* button is clicked or not. If clicked we remove a class **d-none** and add class **d-block** from **signinForm**, and remove class **d-block** and add class **d-none** on **signupForm**. And the vice versa.

The next two **btn** id's are there in [authorization.php](../../public/default/authorization.php). try to findout and deduce.



NP:
the **$** symbol used in javascript is called JQuery Call. It is more like a common function to do everything simply with Javascript.

The function declaration looks like:

**$(\<any args>\)**{

statement blocks;

}

