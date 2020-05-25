<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Dashboard Login</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap-theme.min.css') ?>">
        <style type="text/css">
            body {
                background: url(<?= base_url('assets/img/background/bg-login.jpg') ?>) no-repeat no-repeat;
                background-size: cover;
            }

            .form-login {
                max-width: 360px;
                width: 100%;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    </head>
    <body>

        <?= form_open(site_url('dashboard/login/do_login'), ['class' => 'panel panel-primary form-login']) ?>

            <div class="panel-heading">
                Masuk Dashboard
            </div>

            <div class="panel-body">

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <?php if (isset($message_success)): ?>
                    <div class="alert alert-success"><?= $message_success ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('username') ? 'has-error' : '' ?>">
                    <label for="username" class="control-label">Username / Email</label>
                    <input name="username" class="form-control" value="<?= set_value('username') ?>" />
                    <?php if (form_error('username')): ?>
                        <span class="help-block"><?= form_error('username') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
                    <label for="password" class="control-label">Sandi</label>
                    <input name="password" type="password" class="form-control" value="" />
                    <?php if (form_error('password')): ?>
                        <span class="help-block"><?= form_error('password') ?></span>
                    <?php endif ?>
                </div>

            </div>
            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary btn-block">Masuk</button>
                <a href="<?= site_url('home') ?>" class="btn btn-default btn-block">Kembali Ke Situs</a>
                <a href="<?= site_url('karir/register') ?>" class="btn btn-default btn-block">Belum Memiliki Akun? Klik Disini Untuk Mendaftar</a>
            </div>

        <?= form_close() ?>

    </body>
</html>
