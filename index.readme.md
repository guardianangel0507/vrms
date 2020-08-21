<h4>index.php</h4>

The "index.php" is the root doc of the project, from which is the project begins.
Since, it is the beginning, the directory which "index.php" exists is called the root directory, or server root.
Here, first what we did is, included the "[init.php](https://github.com/guardianangel0507/vrms/tree/development/config/init.php)" file from "[config](https://github.com/guardianangel0507/vrms/tree/development/config)" directory. Because it is   what initiates our Website, like the **engine start button** of a car, which starts the engine with pre-configured settings. From which our "settings" are stored in [config.php](https://github.com/guardianangel0507/vrms/tree/development/config/config.php) file. Read about [init.php](https://github.com/guardianangel0507/vrms/tree/development/config/init.readme.md) here.


The "index.php" uses a Library Class from our framework existing at "[lib](http://github.com/guardianangel0507/vrms/tree/development/lib)", namely "Template" to render the content we pass to the [Template](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.readme.md) class which is existing in "[lib/utility](https://github.com/guardianangel0507/vrms/tree/development/lib/utility)" directory. 

The <i>$indexTemplate</i> is  [Template](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.readme.md) class object, which is initialised by passing the location of the [lander.html](https://github.com/guardianangel0507/vrms/tree/development/public/lander.html). This location is passed down to [Template.php](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.php) for which, the details will be in [Template.readme.md](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.readme.md) file.

The *$indexTemplate->title* means, we are creating  a run time data member for the Template Object using the magic methods, which are detailed in [Template.read.md](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.readme.md) file. You can check the  [lander.html](https://github.com/guardianangel0507/vrms/tree/development/public/lander.html) file to understand the use of *title* data member at the `<title></title>` html tags. These runtime data members are temporary and are vanished when we surf to another webpage which uses another Template Object. 

Then we are simply echoing the *$IndexTemplate* object in our "index.php".

All details about the Template class are in [Template.read.md](https://github.com/guardianangel0507/vrms/tree/development/lib/utility/Template.readme.md) file.


### Animate.css Framework
Please visit [Animate.css](https://animate.style/).
Read more about the usage there. Check [bootstrap/css](https://github.com/guardianangel0507/vrms/tree/development/assets/bootstrap/css) folder to find the animate.css framework stylesheet. download and paste it into your respective folder to use it.