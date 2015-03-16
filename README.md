Simple App to show add/remove Suppliers and their addresses. It uses Zend2, Composer and angularJS

Please follow below steps for setup.

Add virtual host as below, of course change drive letter or directory accordingly. 

<VirtualHost *:80>
	DocumentRoot I:\AngularJSZend2Example\public
	ServerName AngularJSZend2Example
	SetEnv APPLICATION_ENV "development"
	<Directory "I:\AngularJSZend2Example\public">
		Options Indexes FollowSymLinks Includes ExecCGI
		AllowOverride All
		Order allow,deny
		Allow from all
		Require all granted
	</Directory>
</VirtualHost>


Also make sure, your ServerName is AngularJSZend2Example as that is hardcorded in public\app\js\controllers.js, if you are using some other name please change there as well.

Run composer install and composer update in your directory.

Make sure you visit it using http://AngularJSZend2Example/app (& not only http://AngularJSZend2Example), after that click on Suppliers on top left.
