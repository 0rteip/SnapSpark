<ul>
    <?php foreach ($templateParams[$templateParams['info']] as $info): ?>
        <li>
            <p>
                <?php echo $info['info'] ?>
            </p>
        </li>
    <?php endforeach; ?>
</ul>