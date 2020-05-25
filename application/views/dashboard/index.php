<!DOCTYPE html>
<html lang="id" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Dashboard | <?= isset($title) ? $title : '' ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap-theme.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker.css') ?>">
        <style type="text/css">
        .logo {
            height: 100%;
        }

        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        </style>
    </head>
    <body>

        <?php $this->load->view('dashboard/menu/menu_main') ?>

        <div class="container">

            <?php if (isset($content) && $content): ?>
                <?php $this->load->view($content) ?>
            <?php endif ?>

        </div>

        <div class="container site-footer">
            <div class="row">
                <div class="col-xs-12 text-center">
                    &copy; 2020 Alfath Ramadhan, All Rights Reserved &reg;
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?= base_url('assets/bootstrap-3.3.7/js/jquery-3.2.1.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/bootstrap-3.3.7/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/bootbox/bootbox.all.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/dashboard.js') ?>"></script>

    </body>
</html>
