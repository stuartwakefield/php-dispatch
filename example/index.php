<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once "/../Dispatch.php";

require_once "classes/main/MessageCollection.php";
require_once "classes/main/HomeHandler.php";
require_once "classes/main/PreLoginLayout.php";
require_once "classes/main/PostLoginLayout.php";

require_once "classes/security/Security.php";
require_once "classes/security/SignInHandler.php";
require_once "classes/security/SignOutHandler.php";
require_once "classes/security/AccessPlugin.php";
require_once "classes/security/SignInView.php";

require_once "classes/domain/AddTreeHandler.php";
require_once "classes/domain/AddTreeView.php";

$security = new Security("username", "password");
$messageCollection = new MessageCollection();

/* The handlers here need to know about the views to display
 * the correct one */
$dispatch = new Dispatch(array(

	"baseUrl" => "/dispatch/example/",
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
		"home" => "home",
	
		"signin" => "signin",
		"signout" => "signout",
		
		"tree.add" => "addtree"
	),
	
	"routes" => array(
		"/" => "home",
		
		"/signin" => "signin",
		"/signout" => "signout",
		
		"/tree/add" => "tree.add"
	),
	
	"views" => array(
		"/home" => array(
			"path" => "views/home.php",
			"parent" => array(
				"view" => "/layout/postlogin",
				"contentArg" => "content",
				"args" => array(
					"title" => "Welcome"
				)
			)
		),
		"/tree/add" => array(
			"view" => new AddTreeView("views/addtree.php", "addtree", "home"),
			"parent" => array(
				"view" => "/layout/postlogin",
				"contentArg" => "content",
				"args" => array(
					"title" => "Add a tree"
				)
			)
		),
		"/signin" => array(
			"view" => new SignInView("views/signin.php", "signin"),
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
			"view" => new PreLoginLayout("layouts/prelogin.php", $messageCollection)
		),
		"/layout/postlogin" => array(
			"view" => new PostLoginLayout("layouts/postlogin.php", $messageCollection)
		)
	)
	
));

$dispatch->run();
?>