<?php
// Require composer autoloader

use Lib\Router;

require __DIR__.'/vendor/autoload.php';


// Create Router instance
$router = new Router();

$router->addRoute('GET', '/', function() {
    echo 'Hello, world!';
});

$router->addRoute('GET', '/about', function() {
    echo 'this is about page';
});

$router->addRoute('GET', '/users/:id/profile/:section', function($id, $section) {
    echo 'User ID: ' . $id . ' sectionnya ' . $section;
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);