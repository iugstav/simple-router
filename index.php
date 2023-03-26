<?php

require_once "controllers/Home.php";
require_once "Router.php";
use Iugstav\Router;

$router = new Router\Router();

$router->get("/", [\Iugstav\Controllers\Home::class, "Index"]);

$router->get("/duvidas", [\Iugstav\Controllers\Home::class, "Doubts"]);

$router->run();