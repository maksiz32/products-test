<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pageName?></title>
</head>
<body>
    <main>
    <!-- Для вставки с помощью PHP -->
        <?php 
            $products = json_decode($json, true); 
            foreach ($products as $product):
        ?>
        <?=$product['second_name']?> <?=$product['first_name']?>|<?=$product['title']?>|<?=$product['price']?>
        <br />
        <?php endforeach; ?>
        <br /><br />

        <!-- Для вставки с помощью JS -->
        <div id="secondBlock"></div>
    </main>
    
    <script type="text/javascript">
        window.onload = (event) => {
            const json = '<?= $json ?>';
            const products = JSON.parse(json || '');

            if (Object.keys(products).length) {
                const second_block = document.getElementById('secondBlock');
                Object.values(products).forEach(item => {
                    const newBlock = document.createElement('div');
                    newBlock.appendChild(document.createTextNode(`${item.second_name} ${item.first_name}|${item.title}|${item.price}`));
                    second_block.appendChild(newBlock);
                });
            }
        };
    </script>
</body>
</html>