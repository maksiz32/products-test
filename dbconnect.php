<?php

return new PDO('mysql:host=localhost:3306;dbname=prods_test', 'prodsT', '123456Qw!', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
