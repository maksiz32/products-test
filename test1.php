<?php

// Только эта страница
$query_string = [];
parse_str($_SERVER['QUERY_STRING'], $query_string);
$query_string_sec = [];
$query = '';

if (isset($query_string['params'])) {
    foreach ($query_string['params'] as $key => $value) {
        $query_string_sec[htmlspecialchars("params[$key]")] = htmlspecialchars($value);
    }
    $query = htmlspecialchars($_SERVER['HTTP_HOST']) . htmlspecialchars($_SERVER['PHP_SELF']) . '?' . urldecode(http_build_query($query_string_sec));
}

if ($query !== '') {
    $statement = $this->pdo->prepare('SELECT `to` FROM redirects WHERE `from` = :query LIMIT 1');
    $statement->execute([
        'from' => $query,
    ]);
    $res = $statement->fetch(PDO::FETCH_ASSOC);

    if ($res) {
        return http_redirect($res['to']);
    }
}

return false;



