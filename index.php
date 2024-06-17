<?php

define('ROOT', __DIR__);

/**
 * customAutoloader
 *
 * @param  mixed $className
 * @return void
 */
function customAutoloader($className)
{
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/';


    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        // No, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relativeClass = substr($className, $len);

    // Replace namespace separators with directory separators in the relative class name,
    // append with .php, and check if the file exists
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}

// Register the autoloader
spl_autoload_register('customAutoloader');

use App\AppFactory;

$newsApp = AppFactory::createNewsApp();
$newsApp->displayNewsWithComments();

/*
    Changes Made
    1. Namespaces: Introduced namespaces to avoid naming conflicts and organize code.
    2. Custom Autoloader: Implemented a custom autoloader to dynamically include class files based on namespaces, avoiding the need for manual require_once statements.
    3. Separation of Concerns: Moved the presentation logic to the NewsApp class to separate it from the data retrieval logic.
    4. Factory Pattern: Used a factory class (AppFactory) to encapsulate the creation logic of the NewsApp class, making it easier to manage dependencies.
    5. Code Organization: Organized the project structure into appropriate directories, improving maintainability and scalability.
    6. Removed Unnecessary Code: Removed the unused variable assignment ($c).
    7. Single Responsibility Principle: The NewsApp class is responsible only for handling the logic of displaying news and comments, improving separation of concerns.
*/


// OLD CODE

// <?php
// define('ROOT', __DIR__);
// require_once(ROOT . '/utils/NewsManager.php');
// require_once(ROOT . '/utils/CommentManager.php');

// foreach (NewsManager::getInstance()->listNews() as $news) {
// 	echo("############ NEWS " . $news->getTitle() . " ############\n");
// 	echo($news->getBody() . "\n");
// 	foreach (CommentManager::getInstance()->listComments() as $comment) {
// 		if ($comment->getNewsId() == $news->getId()) {
// 			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
// 		}
// 	}
// }

// $commentManager = CommentManager::getInstance();
// $c = $commentManager->listComments();