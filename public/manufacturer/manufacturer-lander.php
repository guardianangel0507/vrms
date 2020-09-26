<div class="jumbotron jumbotron-fluid px-3">
    <h1 class="display-4">Hello <?= isset($userDetail) ? $userDetail->name : '' ?></h1>
    <p class="lead">Welcome to the VRMS Family</p>
    <hr class="my-4">
    <p>You are a Manufacturer in VRMS System</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="<?= SITE_URL."public/manufacturer" ?>" role="button">Go to Manufacturer's Dashboard</a>
    </p>
</div>