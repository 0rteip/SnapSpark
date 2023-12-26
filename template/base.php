<!DOCTYPE html>
<html lang="it">

<head>
    <title>
        <?= $templateparams["titolo"];  ?>
    </title>
    <meta charset="UTF-8" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
</body>

</html>