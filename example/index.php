<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "/../Phi.php";

require_once "classes/main/MessageCollection.php";
require_once "classes/main/phi/HomeHandler.php";
require_once "classes/main/phi/PreLoginLayout.php";
require_once "classes/main/phi/PostLoginLayout.php";

require_once "classes/security/Security.php";
require_once "classes/security/phi/SignInHandler.php";
require_once "classes/security/phi/SignOutHandler.php";
require_once "classes/security/phi/AccessPlugin.php";
require_once "classes/security/phi/SignInView.php";

require_once "classes/domain/phi/AddTreeHandler.php";
require_once "classes/domain/phi/AddTreeView.php";

$security = new Security("username", "password");
$messageCollection = new MessageCollection();

/* The handlers here need to know about the views to display
 * the correct one */
$phi = new Phi(array(

	"baseUrl" => "/phi/example/",
	"defaultEvent" => "home",
	"exceptionEvent" => "error",
	
	"handlers" => array(
		"signin" => new SignInHandler($security, $messageCollection),
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
		"tree.add" => "addtree"
	),
	
	"routes" => array(
		"/" => "home",
		
		"/signin" => "signin",
		"/signout" => "signout",
		
		"/tree/add" => "tree.add"
	),
	
	"views" => array(
		"/tree/add" => array(
			"view" => new AddTreeView("views/addtree.inc", "addtree", "home"),
			"parent" => array(
				"view" => "/layout/postlogin",
				"contentArg" => "content",
				"args" => array(
					"title" => "Add a tree"
				)
			)
		),
		"/signin" => array(
			"view" => new SignInView("views/signin.inc", "signin"),
			"parent" => array(
				"view" => "/layout/prelogin",
				"contentArg" => "content",
				"args" => array(
					"title" => "Sign in",
					"scripts" => array("assets/signin.js")
				)
			)
		),
		"/layout/prelogin" => array(
			"view" => new PreLoginLayout("layouts/prelogin.inc", $messageCollection)
		),
		"/layout/postlogin" => array(
			"view" => new PostLoginLayout("layouts/postlogin.inc", $messageCollection)
		)
	)
	
));

$phi -> run();
?>