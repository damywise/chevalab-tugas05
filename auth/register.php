<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/tugas05/components/navbar.php');

session_start();
$isLoggedIn = isset($_SESSION['valid']);

?>
<!DOCTYPE html>
<html lang="en">

<?php include_once('../components/head.php') ?>

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <?php

    getNavbar(
        $isLoggedIn,
        $isLoggedIn ? '
            <li class="nav-item">
                <a class="nav-link" href="auth/logout.php">Logout</a>
            </li>
        '
            : ''
    );
    ?>

    <div class="container">

        <h1 class="text-center"> Register </h1>

        <?php

if (isset($_SESSION['valid'])) {
    echo '
        <h3 class="text-center">Anda sudah log in.</h3>
        <h4 class="text-center"><a href="/auth/logout.php">Log out</a></h4>
        <h4 class="text-center"><a href="/">Kembali</a></h4>
';
        } else {


            include("../config.php");

            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $pass = $_POST['password'];

                if ($email == "" || $pass == "") {
                    echo "Mohon mengisi email dan password.";
                    echo "<br>";
                    echo "<a href='register.php'>Kembali</a>";
                } else {
                    $queryCheckEmail = mysqli_query($link, "SELECT * FROM users WHERE email='$email'");
                    if (mysqli_fetch_assoc($queryCheckEmail)) {
                        die("Email sudah terdaftar <br/> <a href='/'>Kembali</a>");
                    }
                    mysqli_query($link, "INSERT INTO users(email, password) VALUES('$email', md5('$pass'))")
                        or die("Query gagal dieksekusi. <br/> <a href='/'>Go back</a>");

                    echo "Registrasi berhasil";
                    echo "<br>";
                    echo "<a href='login.php'>Login</a>";
                }
            } else {
        ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                </form>
        <?php
            }
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>