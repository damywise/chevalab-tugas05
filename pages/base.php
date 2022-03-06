<?php 
$isLoggedIn = isset($_SESSION['valid']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon_.ico" />
    <title>Tugas 05</title>
    <script src="https://kit.fontawesome.com/c38ab7053b.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script> -->
</head>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <nav id="navbar" class="navbar sticky-top navbar-light bg-light px-3">
        <a class="navbar-brand" href="#"><img src="logo5.svg" alt="Logo Tugas05" height="36px"></a>
        <ul class="nav ">
            <?php
                echo ($isLoggedIn ? '
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php">Sign Out</a>
                    </li>
                ' : '');
            ?>
        </ul>
    </nav>
    <?php
        include_once($isLoggedIn ? 'pages/todos.php' : 'pages/todos-nologin.php');
    ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>