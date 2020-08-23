## helpers.php

The "helpers.php" file is supposed to include some simple helping functions to debug our PHP code.

#### consoleLogger($log)

For now, there is only one method, `consoleLogger($log)`, which is used to run the simple `console.log()` command in javascript. What we does is, appending the `$log` to the `echo` statement, with normal html `<script></script>` tag. The `$log` contains the message we need to print in the console window ( ⌘ + option + J ). 

FYI: This kind of methods are used to implement javascript through PHP.

Please refer [DataUtility](DataUtility.php) class's Constructor for example.

As we progress, new methods will be added.