<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= $templateparams["titolo"];  ?>
    </title>
    <meta charset="UTF-8" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
</head>

<body>
    <header>
        <h1>SnapSpark</h1>
    </header>

    <main>
        <?php include_once $templateparams["nome"]; ?>
    </main>

    <footer>
        <p>SnapSpark</p>
        <p>Carabini Luca, Ventrucci Pietro</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afc94b6b63.js" crossorigin="anonymous"></script>
</body>

</html>
