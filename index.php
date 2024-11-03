<?php

require_once 'config/config.php';
require_once 'autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$urlArray = explode('/', $_SERVER['REQUEST_URI']);
$user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// При расширении функционала эту часть изменить и перенести в роуты
if (($method === 'GET' && $user_id && $user_id > 0) || ($method === 'POST')) {
    require_once 'controller/ProductController.php';
} else {
    require_once 'controller/MainController.php';
}
