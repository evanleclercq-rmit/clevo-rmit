Budding Sharemarket Investor
============================


To run Budding Sharemarket Investor in a development environment the following tools and programs are required:

* **Composer**- a tool for dependency management in PHP

* **Laravel**- a PHP framework

* **Local web host** - ie. XAMPP, WAMP, MAMP

* **GitHub client** - ie. Git, SourceTree, Tower

* **Project files** from GitHub


__Installing Composer__
-----------------------

*Skip this step if Composer is already installed on your system*


**Windows**

**1.** Download and install Composer. 

[https://getcomposer.org/download](https://getcomposer.org/download/)

**2.** Find Composer’s install path

**Windows 10**: *C:\Users/USERNAME\AppData\Roaming\Composer\vendor\bin*

**3.** Add the Composer path to your system’s environment variables. This will vary between systems. 

**Windows 10**: System Properties > Advanced > Environment Variables > Path


**Linux / Unix / OSX**

**1.** From Terminal run the following commands

	php -r "copy('[https://getcomposer.org/installer](https://getcomposer.org/installer)', 'composer-setup.php');"
	php composer-setup.php
	php -r "unlink('composer-setup.php');"

**2.** Make the Composer installation global by moving composer.phar to a directory that is in your PATH

	mv composer.phar /usr/local/bin/composer

*For more in-depth instructions on installing Composer on Linux or OSX see **[https://getcomposer.org/doc/00-intro.md#installation-linux-unix-os*x](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)


__Installing Laravel__
----------------------

*Skip this step if Laravel is already installed on your system*

**1.** Open Command Prompt or Terminal and run - 

	composer global require "laravel/installer"


__Installing Local Web Server__
-------------------------------

*Skip this step if a local web server is already installed on your system*

**1.** Download and install a local web server with PHP support.

The following are suitable options:

[XAMPP](https://www.apachefriends.org/index.html) (Windows, OSX & Linux)

[MAMP](https://www.mamp.info/en/downloads/) (Windows & OSX)

[WAMP](http://www.wampserver.com/en/) (Windows)


__Setting up the project__
--------------------------

**1.** Git clone [https://github.com/evanleclercq-rmit/clevo-rmit](https://github.com/evanleclercq-rmit/clevo-rmit)

This should be done into the public access folder of your local web server. This folder’s name will vary between programs and systems but is generally one of the following: htdocs, public_html, www

**2.** In Command Prompt or Terminal navigate to the folder that now contains the project files.

	cd c:/xampp/htdocs/clevo-rmit

**3.** Run the following command to install any dependencies required by the project.

	composer install


__Running the application__
---------------------------

**1.** Ensure that the local web server is running.

**2.** Open a web browser and navigate to the public folder inside the project folder.

[http://localhost/clevo-rmit/public/](http://localhost/clevo-rmit/public/)

**3.** This should take you to the Budding Sharemarket Investor homepage. Before you can proceed any further you must register a new account. Once you are logged in you will be redirected to the Dashboard where you can browse, buy and sell shares.

*Refer to the User Guide for usage information.*

