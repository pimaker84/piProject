<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function(Slim\Http\Request $request, Slim\Http\Response $response, array $args) {
    $response->write('Hello, world!');
    return $response;
});

$app->run();
?>