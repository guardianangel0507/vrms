<div class="jumbotron jumbotron-fluid px-3">
    <h1 class="display-4">Hello <?= isset($userDetail) ? $userDetail->name : '' ?></h1>
    <p class="lead">Welcome to the VRMS Family</p>
    <hr class="my-4">
    <p>You are the Admin of VRMS System</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?= SITE_URL."public/admin" ?>" role="button">Go to Admin Panel</a>
    </p>
</div>
