<?php include SITE_ROOT . 'public/default/header.php'; ?>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Verify
                    Manufacturers</a></li>
            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Verify Dealers</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                            <th>Request</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($manResults)) : ?>
                            <?php $i = 0;
                            foreach ($manResults as $manufacturer) : ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= $manufacturer->name ?></td>
                                    <td><?= $manufacturer->email ?></td>
                                    <td><?= $manufacturer->phoneNo ?></td>
                                    <td><?= $manufacturer->address ?></td>
                                    <td>
                                        <a href="<?= SITE_URL . 'public/admin/approve-manufacturer-' . $manufacturer->userID ?>"
                                           class="btn btn-primary">Approve</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Name</th>
                            <th>Owning Manufacturer</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                            <th>Request</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($dealResults)) : ?>
                            <?php $i = 0;
                            foreach ($dealResults as $dealer) : ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= $dealer->name ?></td>
                                    <td><?= $dealer->manufacturer ?></td>
                                    <td><?= $dealer->email ?></td>
                                    <td><?= $dealer->phoneNo ?></td>
                                    <td><?= $dealer->address ?></td>
                                    <td><a href="<?= SITE_URL . 'public/admin/approve-dealer-' . $dealer->userID ?>"
                                           class="btn btn-primary">Approve</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include SITE_ROOT . 'public/default/footer.php'; ?>