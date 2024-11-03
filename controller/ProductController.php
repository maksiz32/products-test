<?php

// $pdo = require ROOT . '/dbconnect.php';
$pageName = 'Список продуктов';

// GET
if ($method === 'GET') {
    $products = (new Product())->getProductById($user_id);
    $json = json_encode($products ?: []);

    require_once 'view/productList.php';
    return;
}

// POST
if ($post = json_decode(file_get_contents('php://input'), true)) {
    // В системе user_id наверное будет браться из auth()
    $user_id = 2;
    $new_products_titles = [];

    foreach ($post as $item) {
        $new_product = [
            'title' => htmlspecialchars(strip_tags($item['title'])),
            'price' => number_format(floatval($item['price']), 2, '.', ''),
        ];
        if ($new_id = (new Product())->addProduct($user_id, $new_product)) {
            (new UserOrder())->create($user_id, $new_id);
            $new_products_titles[] = $new_product['title'];
        }
    }

    $result_arr = [
        'res' => 1,
        'message' => 'Добавлены продукты: ' . implode(', ', $new_products_titles),
    ];
    
    $result = json_encode($result_arr, JSON_UNESCAPED_UNICODE);
    echo $result;
    die();
}

// Error
$result_arr = [
    'res' => 0,
    'error' => 'Ошибка при вводе продуктов'
];
$result = json_encode($result_arr, JSON_UNESCAPED_UNICODE);
echo $result;
die();