<?php if(isset($templateparams["titolo_pagina"])) : ?>
    <h2>
        <?php echo $templateparams["titolo_pagina"]; ?>
    </h2>
<?php else : ?>
    <h2>Articoli</h2>
<?php endif; ?>


<?php foreach ($templateparams["posts"] as $post) : ?>
    <article>
        <header>
            <h2>Titolo</h2>
            <p><?php echo $post["username"]; ?> - <?php echo $post["data"] ?></p>
            <img src="<?php echo POST_FOLDER . $post["file"]; ?>" alt="">
        </header>
        <section>
            <p><?php echo $post["descrizione"]; ?></p>
        </section>
        <footer>
            <p><?php echo $post["spark"] , " spark"; ?></p>
        </footer>
    </article>
<?php endforeach; ?>
