<?php

class UserOrder
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = PDOConnect::getInstance()->connect();
    }

    public function create(int $user_id, int $product_id): void {
        $statement = $this->pdo->prepare("INSERT INTO `user_order` (user_id, product_id) VALUES (:user_id, :product_id)");
        $statement->execute([
            'user_id' => $user_id,
            'product_id' => $product_id,
        ]);
    }
}
