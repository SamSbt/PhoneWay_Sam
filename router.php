<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
  '/' => __DIR__ . '/src/controllers/index.controller.php',
  '/articles' => __DIR__ . '/src/controllers/articles.controller.php',
  '/tag' => __DIR__ . '/src/controllers/tag.controller.php',
  '/connexion' => __DIR__ . '/src/controllers/login.controller.php',
  '/inscription' => __DIR__ . '/src/controllers/register.controller.php',

];

function routeToController($uri, $routes)
{
  if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
  } else {
    abort();
  }
}

function abort($code = 404)
{
  http_response_code($code);
  require __DIR__ . "/src/views/{$code}.php";
  die();
}

routeToController($uri, $routes);