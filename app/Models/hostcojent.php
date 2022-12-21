<?php
http: //testphp.vulnweb.com/search.php?test=query

$pdo = new PDO('msql:host=vulnweb.com;dbname=vulnweb', 'dbuser', 'dbpassword');
$query = "SELECT * FROM searchabletable WHERE topic LIKE :keyword";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':keyword', '%' . $variable . '%');
$stmt->execute();

// fetch results 
$fetch = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($fetch) {
    // do something
} else {
    //do something else
}

/**
 * 
 * There are alot of Stealthy and complex xss attack, to be more safer, we can use the plugin, html purifier.
 * 
 * To fix xss attack is usually a situatuion where the user's input are not properly being sanitized hence a javascirpt or html code will be excecuted when the input is displayed on the page.
 * 
 * One include filtering input on arrival:
 
 * Using php, Native approaches involve the use of htmlspecialchars() to escape special characters in the user input.
 * 
 * 
 * No 2 approach will be to use 
 */

//2
//Another thing you may want to do to mitigate xss vulnerabiltiy is using the CSP  (Content security policy).

//Here, the URLs that can be loaded using script interfaces are limited by Connect-src function 

//CSP  (Content security policy) function, By using CSP Header with PHP
header("Content-Security-Policy: default-src 'self'");

// There are other Stealthy and complex xss attack, to be more safer, we can use the plugins. Example is html purifier plugin which is still being maintained by its founders

/** HTML Purifier library Approach **/
//require the  HTML Purifier library
require_once '/path/to/htmlpurifier/library/HTMLPurifier.auto.php';

// instantiate 
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

// get user inputed data
$user_data = "<p>This is some <strong>dirty</strong> HTML.</p>";

// clean HTML input using HTML Purifier
$purified = $purifier->purify($user_data);

// print cleaned HTML
echo $purified;

