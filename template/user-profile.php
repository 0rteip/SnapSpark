<div class="container text-center">
    <div class="row">
        <div class="col">
            <ul>
                <li>
                    <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                </li>
                <li>
                    <label> <?php echo $templateParams['username'] ?></label>
                </li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li>
                    <label><?php echo count($templateParams["posts"]) ?></label>
                </li>
                <li>
                    <label> Post</label>
                </li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li>
                    <label><?php echo count($templateParams['follower']) ?></label>
                </li>
                <li>
                    <label> Follower</label>
                </li>
            </ul>
        </div>
        <div class="col">
            <a href="index.php">
                <ul>
                    <li>
                        <label><?php echo count($templateParams['followed']) ?></label>
                    </li>
                    <li>
                        <label>Seguiti</label>
                    </li>
                </ul>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="d-flex justify-content-center">
        <?php foreach ($templateParams["posts"] as $post) : ?>
            <div class="card" style="width: 10rem;" id="profile">
                <img src="<?php echo POST_FOLDER . $post["file"]; ?>" alt="">
                <div class="card-body">
                    <p class="card-text">
                        <?php echo $post["descrizione"]; ?>
                    </p>
                </div>
                <footer class="card-footer">
                    <p class="card-text mx-auto">
                        <?php echo $post["spark"]; ?>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-comment"></i>
                    </p>
                </footer>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
        </div>
    </div>
</div>