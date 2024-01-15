<?php foreach ($templateParams["posts"] as $post) : ?>
    <article class="card mb-3">

        <header class="card-header">
            <a target="_self" href="user.php?username=<?php echo $post["username"]; ?>">
                <img alt="" class="me-2" id="avatar" src="<?php echo AVATAR_FOLDER . 'avatar.png'; ?>">
                <?php echo $post["username"]; ?> - <?php echo $post["data"] ?>
            </a>
        </header>

        <img alt="" class="card-img rounded-0" src="<?php echo POST_FOLDER . $post['file']; ?>">

        <div class="card-body">
            <p class="card-text">
                <?php echo $post["descrizione"]; ?>
            </p>
        </div>

        <footer class="card-footer">

            <!-- <div class="container text-center p-0 m-0"> -->
            <div class="row">

                <div class="col-10 text-start">
                    <div class="row">
                        <div class="col-auto">
                            <button type="button" class="btn p-0" onclick="likePost(<?php echo  addQuotes($post['username']); ?>, <?php echo $post['id']; ?>)">
                                <span aria-hidden="true" user="<?php echo $post['username']; ?>" post_id="<?php echo $post['id']; ?>" id="post-star-<?php echo $post['username'] . '-' . $post['id']; ?>" class="fa-regular fa-star"></span>

                                <span class="visually-hidden">Azione</span> <!-- Testo nascosto visivamente, ma accessibile agli screen reader -->
                            </button>
                            <!-- <span user="<?php echo $post['username']; ?>" post_id="<?php echo $post['id']; ?>" id="post-star-<?php echo $post['username'] . '-' . $post['id']; ?>" class="fa-regular fa-star" onclick="likePost(<?php echo  addQuotes($post['username']); ?>, <?php echo $post['id']; ?>)"></span> -->

                        </div>
                        <div id="sparks-num-<?php echo $post['username'] . '-' . $post['id']; ?>" class="col-auto ps-0">
                            <?php if ($post["spark"] > 0) : ?>
                                <p id="sparks-<?php echo $post['username'] . '-' . $post['id']; ?>" class="card-text mx-auto text-start">
                                    <?php echo $post["spark"]; ?> <?php echo ($post["spark"] == 1) ? "spark" : "sparks"; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-2 text-end">
                    <button id="tr" type="button" class="btn p-0" onclick="getComments(<?php echo  addQuotes($post['username']); ?>, <?php echo $post['id']; ?>)">
                        <span aria-hidden="true" class="fa-regular fa-comment" data-bs-toggle="modal" data-bs-target="#postModal" data-bs-username="<?php echo  addQuotes($post['username']); ?>" data-bs-id="<?php echo $post['id']; ?>">
                        </span>

                        <span class=" visually-hidden">Azione</span> <!-- Testo nascosto visivamente, ma accessibile agli screen reader -->
                    </button>
                </div>
            </div>
            <!-- </div> -->




        </footer>
    </article>
<?php endforeach; ?>

<!-- Modal -->
<div class=" modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <section class="modal-content">

            <header class="modal-header">
                <h1 class="modal-title fs-5" id="postModalLabel">Comments</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </header>

            <div class="modal-body">
            </div>

            <footer class="modal-footer">

                <div class="container text-center m-0">
                    <div class="row align-items-center justify-content-center">

                        <div class="col-1 p-0">
                            <img alt="" id="avatar" class="mx-auto" src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>">
                        </div>

                        <div class="col-11">
                            <form aria-label="comments form" method="get" action="index.php" role="form" class="row align-items-center justify-content-center">
                                <label for="commentArea" class="form-label visually-hidden">Comment</label>

                                <div class="col-10 col-sm-10">
                                    <textarea class="form-control" id="commentArea" placeholder="Add a comment..." onkeyup="enablePost()"></textarea>
                                </div>
                                <button id="postButton" type="button" value="Submit" class="col-2 col-sm-2 px-2 btn btn-primary" onclick="postComment()" disabled>Post</button>

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
