<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "/../Phi.php";

require_once "classes/security/SecurityModule.php";

$module = new SecurityModule(array(
	"password" => "hocuspocusfocus",
	"signinviewpath" => "views/signin.php",
	"notificationviewpath" => "views/notifications.php",
	"validationviewpath" => "views/validation_errors.php",
	"signineventurl" => "?event=signin", // buildUrl("signin")
	"signinevent" => "signin",
	"homeevent" => "home", // defaultevent
	"layoutpath" => "views/page.php"
));

require_once "phi/HomeHandler.php";

$phi = new Phi(array(
	"baseurl" => "/phi/example",
	"defaultevent" => "home",
	"exceptionevent" => "error",
	"handlers" => array(
		"signin" => $module -> getSignInHandler(),
		"signout" => $module -> getSignOutHandler(),
		"home" => new HomeHandler()
	),
	"plugins" => array(
		$module -> getAccessPlugin()
	),
	"events" => array(
		"signin" => "signin",
		"signout" => "signout",
		"home" => "home"
	)
));
$phi -> run();
?>