<?php include SITE_ROOT . 'public/default/header.php'; ?>
<?php

$formName = 'add_dealer';

if (isset($_SESSION['authData'])) $authData = $_SESSION['authData'];
unset($_SESSION['authData']);
?>

    <style>
        .form-control {
            margin: 5px;
        }

        .form-signup {
            padding: 15px;
        }
    </style>
    <div class="container">
        <div class="form-signup">
            <form method="post" class="text-center" action="<?= SITE_URL ?>lib/scripts/create-dealer.php">
                <h1 class="h3 mb-3 font-weight-normal text-center">Add Dealer</h1>
                <div class="d-flex flex-row">
                    <label for="inputFullName" class="sr-only">Full Name</label>
                    <input type="text" id="inputFullName" class="form-control" placeholder="Full Name" name="name"
                           required
                           autofocus="" value="<?php if (!empty($authData)) echo $authData['name'] ?>">
                    <label for="inputEmail" class="sr-only">Email</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email"
                           name="email"
                           required value="<?php if (!empty($authData)) echo $authData['email'] ?>">
                </div>
                <div class="d-flex flex-row">
                    <label for="inputPhone" class="sr-only">Phone Number</label>
                    <input type="number" id="inputPhone" class="form-control" placeholder="Phone Number" name="phoneNo"
                           required
                           autofocus="" value="<?php if (!empty($authData)) echo $authData['phoneNo'] ?>">
                </div>
                <div class="d-flex flex-row">
                    <label for="inputAddress" class="sr-only">Address</label>
                    <input type="text" id="inputAddress" class="form-control" placeholder="Address"
                           name="address"
                           required value="<?php if (!empty($authData)) echo $authData['address'] ?>">
                </div>
                <div class="d-flex flex-row">
                    <label for="inputUname" class="sr-only">Username</label>
                    <input type="text" id="inputUname" class="form-control" placeholder="Username"
                           name="username"
                           required value="<?php if (!empty($authData)) echo $authData['username'] ?>">
                    <label for="inputPass" class="sr-only">Password</label>
                    <input type="password" id="inputPass" class="form-control" placeholder="Password"
                           name="password"
                           required value="<?php if (!empty($authData)) echo $authData['password'] ?>">
                    <label for="inputCPassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="inputCPassword" class="form-control" placeholder="Confirm Password"
                           name="cPassword"
                           required>
                    <button id="showPass" class="btn btn-outlined-primary show-icon"><i id="eyeicon"
                                                                                        class="fa fa-eye"></i>
                    </button>
                </div>
                <button class="btn btn-lg btn-primary" type="submit" name="add_dealer">Add</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>SL No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($dealResults)) : ?>
                    <?php $i = 0;
                    foreach ($dealResults as $dealer) : ?>
                        <tr>
                            <td><?= ++$i ?></td>
                            <td><?= $dealer->name ?></td>
                            <td><?= $dealer->email ?></td>
                            <td><?= $dealer->phoneNo ?></td>
                            <td><?= $dealer->address ?></td>
                    <?php endforeach ?>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include SITE_ROOT . 'public/default/footer.php' ?>