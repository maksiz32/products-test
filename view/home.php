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
        <form class="form">
            <div class="form-line">
                <span class="form-title">Title</span>
                <label for="title">Введите Title:</label>
                <input type="text" name="title" class="form-textfield" required>
                
                <label for="price">Введите Price:</label>
                <input type="text" name="price" class="form-textfield" required>
            </div>
            <hr />

            <div class="form-line">
                <span class="form-title">Title</span>
                <label for="title">Введите Title:</label>
                <input type="text" name="title" class="form-textfield" required>
                
                <label for="price">Введите Price:</label>
                <input type="text" name="price" class="form-textfield" required>
            </div>

            <button type="submit" id="send">Submit</button>
        </form>
        <div class="informer"></div>
    </main>
    <script>
        const send = document.getElementById('send');
        send.addEventListener('click', function(ev) {
            ev.preventDefault();
            const request_data_line = document.querySelectorAll('.form-line');
            const request = [];

            Object.values(request_data_line).forEach(element => {
                const title = element.querySelector('input[name="title"]').value || '';
                const price = element.querySelector('input[name="price"]').value || '';
                request.push({ 'title': title, 'price': price });
            });
            if (Object.keys(request).length) {
                (
                    async function() {
                        let resp = await fetch('http://prods/', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(request)
                        })
                        const answer = await resp.json();
                        if (answer.res !== 0) {
                            const inputs = document.querySelectorAll('input');
                            Object.values(inputs).forEach(item => item.value = '');

                            let informer = document.querySelector('.informer');
                            if (informer) {
                                informer.parentNode.removeChild(informer);
                            }
                            const outBlock = `<span class="informer info">${answer.message}</span>`;
                            document.querySelector('.form').insertAdjacentHTML('beforeEnd', outBlock);
                        } else {
                            let informer = document.querySelector('.informer');
                            if (informer) {
                                informer.parentNode.removeChild(informer);
                            }
                            const outBlock = `<span class="informer alert">${answer.error}</span>`;
                            document.querySelector('.form').insertAdjacentHTML('beforeEnd', outBlock);
                        }
                    }
                )();
            }
        });
    </script>
</body>
</html>