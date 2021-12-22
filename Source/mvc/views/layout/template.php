<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Template</title>
    <!-- Bootstrap & Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <!-- JS -->
    <script src="./main.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="./style.css" />

    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet" />
    <!-- 
      COLOR:
      https://uigradients.com/#BlueRaspberry 
    -->
</head>

<body>
    <?= include_once('header.php') ?>
    <?= include_once('sidebar.php') ?>
    <div class="home-content">
        <?= $content ?>
    </div>
</body>
<script>

</script>

</html>