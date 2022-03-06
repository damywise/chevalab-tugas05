<?php
require_once('components/navbar.php');

if (!isset($_SESSION)) {
    session_start();
}
$isLoggedIn = isset($_SESSION['valid']);

?>
<!DOCTYPE html>
<html lang="en">

<?php include_once('components/head.php') ?>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <?php

    getNavbar(
        $isLoggedIn,
        $isLoggedIn ? '
            <li class="nav-item">
                <a class="nav-link" href="auth/logout.php">Sign Out</a>
            </li>
        '
            : ''
    );
    ?>

    <?php
    include_once($isLoggedIn ? 'pages/todos.php' : 'pages/todos-nologin.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>