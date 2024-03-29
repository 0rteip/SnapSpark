<?php foreach ($templateParams["posts"] as $post) : ?>
    <article class="card mb-3">
        <header class="card-header py-3">
            <div class="row row-cols-3 px-md-3 px-sm-2">

                <div class="col-auto text-start align-self-center pe-0 me-3">
                    <img alt="Go to <?php echo $post['username']; ?> profile" class="post-img" src="<?php echo AVATAR_FOLDER . $post["profile_img"]; ?>" />
                </div>

                <div class="col-auto text-start align-self-center ps-0">
                    <div class="col-12">
                        <a target="_self" href="user.php?username=<?php echo $post["username"]; ?>">
                            <h2 class="post-header m-0 fs-5"><?php echo $post["username"]; ?></h2>
                        </a>
                    </div>

                    <div class="col-12">
                        <p class="my-auto"><?php echo $post["data"] ?>
                        </p>
                    </div>
                </div>

                <div class="d-flex col-auto justify-content-end align-self-center ms-auto">
                    <?php if ($_SESSION["username"] == $post["username"]) : ?>
                        <span tabindex="0" id="trash-can¬<?php echo $post['username'] . '¬' . $post['id']; ?>" class="post-trash fa-solid fa-trash ms-2">
                        </span>
                    <?php endif; ?>
                </div>

            </div>
        </header>

        <img alt="" class="card-img rounded-0" src="<?php echo POST_FOLDER . $post['file']; ?>" />

        <div class="card-body">
            <p class="card-text">
                <?php echo $post["descrizione"]; ?>
            </p>
        </div>

        <footer class="card-footer py-3">
            <div class="row px-md-3 px-sm-2">

                <div class="col-10 text-start">
                    <div class="row">
                        <div class="col-auto">
                            <span tabindex="0" id="post-star¬<?php echo $post['username'] . '¬' . $post['id']; ?>" class="post-star fa-star <?php echo $post['liked'] == "true" ? 'liked-star fa-solid' : 'fa-regular'; ?>"></span>
                        </div>
                        <div id="sparks-num-<?php echo $post['username'] . '-' . $post['id']; ?>" class="col-auto ps-0 d-flex align-items-center">
                            <?php if ($post["spark"] > 0) : ?>
                                <p id="sparks-<?php echo $post['username'] . '-' . $post['id']; ?>" class="card-text mx-auto text-start">
                                    <?php echo $post["spark"]; ?> <?php echo ($post["spark"] == 1) ? "spark" : "sparks"; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-2 text-end">
                    <span tabindex="0" class="post-comment fa-solid fa-comment" data-bs-toggle="modal" data-bs-target="#postModal" data-bs-username="<?php echo $post['username']; ?>" data-bs-id="<?php echo $post['id']; ?>">
                    </span>
                </div>

            </div>

        </footer>
    </article>
<?php endforeach; ?>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <section class="modal-content">

            <header class="modal-header">
                <h2 class="modal-title fs-3" id="postModalLabel">Comments</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </header>

            <div class="modal-body py-2" id="message-modal-body">
            </div>

            <footer class="modal-footer">

                <div class="container text-center m-0">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-1 p-0">
                            <img alt="" class="mx-auto comment-profile-avatar" src="<?php echo AVATAR_FOLDER . $templateParams['userImage']; ?>" />
                        </div>

                        <div class="col-11">
                            <form aria-label="comments form" method="get" action="index.php" class="row align-items-center justify-content-center">
                                <label for="commentArea" class="form-label visually-hidden">Comment</label>

                                <div class="col-10 col-sm-10">
                                    <textarea class="form-control" id="commentArea" placeholder="Add a comment..." required></textarea>
                                </div>
                                <button id="postButton" type="button" value="Submit" class="col-2 col-sm-2 px-2 btn btn-primary" disabled>Post</button>

                            </form>
                        </div>
                    </div>
                </div>

            </footer>
        </section>
    </div>
</div>

<script src="js/comments.js"></script>
<script src="js/post.js"></script>
