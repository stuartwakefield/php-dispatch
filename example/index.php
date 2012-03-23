<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "/../Phi.php";

require_once "Security.php";

require_once "SignInHandler.php";
require_once "SignOutHandler.php";
require_once "HomeHandler.php";
require_once "AddTreeHandler.php";
require_once "AccessPlugin.php";

$security = new Security("username", "password");

$phi = new Phi(array(
	"baseurl" => "/phi/example/",
	"defaultevent" => "home",
	"exceptionevent" => "error",
	"handlers" => array(
		"signin" => new SignInHandler($security),
		"signout" => new SignOutHandler($security),
		"home" => new HomeHandler(),
		"addtree" => new AddTreeHandler(true)
	),
	"plugins" => array(
		new AccessPlugin($security)
	),
	"events" => array(
		"signin" => "signin",
		"signout" => "signout",
		"home" => "home",
		"addtree" => "addtree"
	)
));
$phi -> run();
?>