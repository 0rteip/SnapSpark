<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SnapSpark - Social Network</title>
    <!-- Aggiungi qui eventuali fogli di stile CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

</head>

<body>

    <header>
        <h1>Welcome to SnapSpark!</h1>
        <p>Share your positive moments and inspire others.</p>
    </header>

    <section>
        <h2>Recent Posts</h2>
        <!-- Qui verranno visualizzati i post più recenti -->
        <?php
        // In un'applicazione reale, qui dovresti recuperare i post dal tuo database
        // e stamparli in modo dinamico utilizzando un ciclo PHP.
        ?>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
        <div class="post">
            <p>Username: JohnDoe</p>
            <p>Positive moment: Enjoying a sunny day in the park! ☀️</p>
            <p>Posted on: January 1, 2023</p>
        </div>
    </section>

    <section>
        <h2>Share Your Moment</h2>
        <!-- Form per consentire agli utenti di condividere i propri momenti -->
        <form action="post_handler.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="moment">Your positive moment:</label>
            <textarea name="moment" rows="4" required></textarea>
            <button type="submit">Share</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 SnapSpark - All rights reserved.</p>
    </footer>

</body>

</html>