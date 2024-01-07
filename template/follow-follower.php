<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradio" id="follower" onclick="location.href='info-follower.php?&info=follow'" autocomplete="off" checked> 
    <label class="btn btn-outline-primary" for="follower">Follower</label>

    <input type="radio" class="btn-check" name="btnradio" id="follow" autocomplete="off" >
    <label class="btn btn-outline-primary" for="follow">Follow</label>
</div>
<section id="info">
        <p><?php echo $username ?> </p>
</section>
