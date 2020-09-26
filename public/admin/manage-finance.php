<?php include SITE_ROOT . 'public/default/header.php'; ?>
    Manage Finances
    <a href="<?=SITE_URL?>lib/scripts/testroute.php">Test Route</a>
    <form action="<?=SITE_URL?>lib/scripts/testroute.php" method="post">
        <label for="test">TEST NAME: </label><input type="text" name="test" id="test" />
        <button class="btn btn-primary">Submit</button>
    </form>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>