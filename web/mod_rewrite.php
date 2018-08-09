<?php
/**
 * @file
 * Provide basic mod_rewrite like functionality.
 *
 * Pass through requests for root php files and forward all other requests to
 * index.php with $_GET['q'] equal to path. The following are examples that
 * demonstrate how a request using mod_rewrite.php will appear to a PHP script.
 *
 * - /install.php: install.php
 * - /update.php?op=info: update.php?op=info
 * - /foo/bar: index.php?q=/foo/bar
 * - /: index.php?q=/
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$x = explode('/', $path);

if(array_key_exists(1,$x)){
	$checkIf = $x[1];	
}
else {
	$checkIf = '';	
}


if ($checkIf == 'deals'){
	$subPath = explode('/',$path);
	$file = 'index.php';
	if(array_key_exists(2,$subPath)){

		$_GET['q'] = $subPath[2];	
	}
	else {
		$_GET['q'] = '';
	}
	

}

else if ($checkIf == 'deal'){

	$subPath = explode('/',$path);
	$file = 'deal.php';

	if(array_key_exists(2,$subPath)){

		$_GET['deal_id'] = $subPath[2];
	}
	else {
		$_GET['deal_id'] = $subPath[2];
	}

	if(array_key_exists(3,$subPath)){

		$_GET['deal_slug'] = $subPath[3];
	}
	else {
		$_GET['deal_slug'] = '';
	}

	
}

else if ($checkIf == ''){
	
	$file = 'index.php';

}
// Provide mod_rewrite like functionality. If a php file in the root directory
// is explicitly requested then load the file, otherwise load index.php and
// set get variable 'q' to $_SERVER['REQUEST_URI'].
else{

  $file = $_SERVER['REQUEST_URI'];
  $file = ltrim($file,'/');

  // Provide mod_rewrite like functionality by using the path which excludes
  // any other part of the request query (ie. ignores ?foo=bar).
}

// Override the script name to simulate the behavior without mod_rewrite.php.
// Ensure that $_SERVER['SCRIPT_NAME'] always begins with a / to be consistent
// with HTTP request and the value that is normally provided.
$_SERVER['SCRIPT_NAME'] = '/' . $file;
require $file;
