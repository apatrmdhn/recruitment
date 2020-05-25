<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/admin/accounts') ?>">Akun</a></li>
            <li class="active">Tambah Akun</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <?= form_open(site_url('dashboard/admin/accounts/edit?user_id='.$user_data->user_id), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <div class="form-group <?= form_error('username') ? 'has-error' : '' ?>">
                    <label for="username" class="control-label">Username</label>
                    <input name="username" type="text" class="form-control" value="<?= $user_data->username ?>" />
                    <?php if (form_error('username')): ?>
                        <span class="help-block"><?= form_error('username') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('email') ? 'has-error' : '' ?>">
                    <label for="email" class="control-label">Email</label>
                    <input name="email" type="text" class="form-control" value="<?= $user_data->email ?>" />
                    <?php if (form_error('email')): ?>
                        <span class="help-block"><?= form_error('email') ?></span>
                    <?php endif ?>
                </div>

                <?php
                $arr_hak_akses = [
                    1 => 'Admin',
                    2 => 'Direktur Utama',
                    3 => 'HRD',
                    4 => 'Divisi Terkait',
                    5 => 'Pelamar'
                ];
                ?>

                <div class="form-group <?= form_error('hak_akses') ? 'has-error' : '' ?>">
                    <label for="hak_akses" class="control-label">Hak Akses</label>
                    <?= form_dropdown('hak_akses', $arr_hak_akses, $user_data->hak_akses, 'class="form-control"') ?>
                    <?php if (form_error('hak_akses')): ?>
                        <span class="help-block"><?= form_error('hak_akses') ?></span>
                    <?php endif ?>
                </div>

                <hr />

                <p>Kosongkan Kata Sandi, jika tidak ingin diubah</p>
                <p>&nbsp;</p>

                <div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
                    <label for="password" class="control-label">Kata Sandi</label>
                    <input name="password" type="password" class="form-control" value="" />
                    <?php if (form_error('password')): ?>
                        <span class="help-block"><?= form_error('password') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('password_confirm') ? 'has-error' : '' ?>">
                    <label for="password_confirm" class="control-label">Ulangi Kata Sandi</label>
                    <input name="password_confirm" type="password" class="form-control" value="" />
                    <?php if (form_error('password_confirm')): ?>
                        <span class="help-block"><?= form_error('password_confirm') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/admin/accounts') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
