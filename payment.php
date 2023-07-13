<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="./css/success.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="payment">
        <h1>This is payment page</h1>
        <button id="btn" name="pay">Pay</button>
    </div>

    <div class="message">
        <i class="fas fa-check"></i>
        <h2>Payment successfull</h2>
    </div>

    <script>
        let btn = document.getElementById('btn');
        btn.addEventListener('click', () => {
            let message = document.querySelector('.message');
            message.classList.add('animation');
            setTimeout(() => {
                message.classList.remove('animation');
            }, 2000);
            setTimeout(() => {
                window.location = 'index.php';
            }, 3000);
        });
    </script>
</body>

</html>