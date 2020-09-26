<div class="jumbotron jumbotron-fluid px-3">
    <h1 class="display-4">Hello <?= isset($userDetail) ? $userDetail->name : '' ?></h1>
    <p class="lead">Welcome to the VRMS Family</p>
    <hr class="my-4">
    <p>You are a Customer of VRMS System</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?= SITE_URL."public/customer/customer-route.php" ?>" role="button">Go to Customer's Dashboard</a>
    </p>
</div>