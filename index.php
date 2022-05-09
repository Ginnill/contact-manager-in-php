<?php $base_url = "/{$_SERVER['SERVER_NAME']}/../teste-fortunato/"; ?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,600;0,700;0,800;1,300;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="<?= $base_url ?>plugins/bootstrap-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>css/main.min.css">

    <title>Teste Fortunato</title>
</head>

<body>

    <?php include "header.php"; ?>

    <main class="site">
        <?php
        $request = $_SERVER['REQUEST_URI'];
        $uri = str_replace('/teste-fortunato', '', $request);

        switch ($uri):
            case '/':
            case '':
                require __DIR__ . '/views/login.php';
                break;
            case '/register':
                require __DIR__ . '/views/register.php';
                break;
            case '/dashboard':
                require __DIR__ . '/views/dashboard.php';
                break;
            case '/logout':
                require __DIR__ . '/controller/logout.php';
                break;
            default:
                http_response_code(404);
                require __DIR__ . '/views/404.php';
                break;
        endswitch;
        ?>
    </main>

    <?php include "footer.php"; ?>

    <script src="plugins/bootstrap-5/js/bootstrap.bundle.min.js"></script>
</body>

</html>
