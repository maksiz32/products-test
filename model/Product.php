<?php

class Product
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = PDOConnect::getInstance()->connect();
    }

    public function getProductById(int $user_id) {
        $statement = $this->pdo->prepare('
            SELECT u.first_name, u.second_name, p.title, p.price
            FROM user AS u 
            JOIN user_order AS uo ON u.id = uo.user_id
            LEFT JOIN products AS p ON uo.product_id = p.id
            WHERE u.id = :user_id
            ORDER BY p.title ASC, p.price DESC
        ');
        $statement->execute([
            'user_id' => $user_id,
        ]);
        $res = $statement->fetchall(PDO::FETCH_ASSOC);

        return $res;
    }

    public function addProduct(int $user_id, array $product): int|null {
        $statement = $this->pdo->prepare('INSERT INTO `products` (title, price) VALUES (:title, :price)');
        $statement->execute([
            'title' => $product['title'],
            'price' => $product['price'],
        ]);
        
        return $this->pdo->lastInsertId() ?? null;
    }
}