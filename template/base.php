<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= $templateParams["titolo"]; ?>
    </title>
    <meta charset="UTF-8" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar bd-navbar sticky-top bg-main-color" aria-label="user-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">SnapSpark</a>

            <?php if ($_SESSION["username"] != null) : ?>
                <em class="navbar-text" data-bs-toggle="tooltip" data-bs-title="<?php echo $templateParams["hashtag"]["descrizione"] ?>">
                    <?php echo  "#" . $templateParams["hashtag"]["nome"] ?>
                </em>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container-xl bd-gutter mt-3 mb-3 my-md-4 bd-layout">
        <main>
            <?php if (isset($templateParams["nome"])) : ?>
                <?php require($templateParams["nome"]); ?>
            <?php endif; ?>
        </main>
    </div>

    <?php if ($templateParams["showNavBar"]) {
        require("nav-bar.php");
    }
    ?>

    <footer class="bd-footer mt-auto py-4 py-md-5 bg-body-tertiary">
        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <p>SnapSpark</p>
            <p>Carabini Luca, Ventrucci Pietro</p>
        </div>

        <?php if ($_SESSION["username"] != null) : ?>
            <div class="container py-4 py-md-5 px-4 px-md-3 d-flex justify-content-center">
                <a class="btn btn-primary" href="login.php" role="button">Logout</a>
            </div>
        <?php endif; ?>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afc94b6b63.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
