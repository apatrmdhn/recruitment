<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Akun</a></li>
            <li class="active">Ubah Kata Sandi</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">


        <?= form_open(site_url('dashboard/change_password/change'), ['class' => 'panel panel-primary']) ?>

            <div class="panel-heading">
                Ubah Kata Sandi
            </div>

            <div class="panel-body">

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <?php if (isset($message_success) && $message_success): ?>
                    <div class="alert alert-success"><?= $message_success ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('old_password') ? 'has-error' : '' ?>">
                    <label for="old_password" class="control-label">Kata Sandi Lama</label>
                    <input name="old_password" type="password" class="form-control" value="<?= set_value('old_password') ?>" />
                    <?php if (form_error('old_password')): ?>
                        <span class="help-block"><?= form_error('old_password') ?></span>
                    <?php endif ?>
                </div>

                <hr />

                <div class="form-group <?= form_error('new_password') ? 'has-error' : '' ?>">
                    <label for="new_password" class="control-label">Kata Sandi Baru</label>
                    <input name="new_password" type="password" class="form-control" value="<?= set_value('new_password') ?>" />
                    <?php if (form_error('new_password')): ?>
                        <span class="help-block"><?= form_error('new_password') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('new_password_confirm') ? 'has-error' : '' ?>">
                    <label for="new_password_confirm" class="control-label">Ulangi Kata Sandi Baru</label>
                    <input name="new_password_confirm" type="password" class="form-control" value="<?= set_value('new_password_confirm') ?>" />
                    <?php if (form_error('new_password_confirm')): ?>
                        <span class="help-block"><?= form_error('new_password_confirm') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
            </div>

        <?= form_close() ?>


    </div>
</div>
