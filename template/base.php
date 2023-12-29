<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= $templateParams["titolo"];  ?>
    </title>
    <meta charset="UTF-8" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bd-navbar sticky-top bg-info" aria-label="User-navbar">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">SnapSpark</a>
            <form class="d-flex" role="search">
                <input class="form-control bg-info-subtle" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </nav>

    <div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">

        <main>
            <?php require($templateParams["nome"]); ?>
        </main>

    </div>

    <nav role="navigation" class="navbar navbar-expand bd-navabr sticky-bottom bg-info" aria-label="Main-navbar">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fa fa-home"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-plus-square"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-heart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fa fa-user"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <footer class="bd-footer py-4 py-md-5 bg-body-tertiary">
        <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
            <p>SnapSpark</p>
            <p>Carabini Luca, Ventrucci Pietro</p>
        </div>
        <a href="login.php"><button>Log Out</button></a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afc94b6b63.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>