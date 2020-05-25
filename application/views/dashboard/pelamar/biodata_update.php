<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/pelamar/biodata') ?>">Biodata</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/biodata/edit'), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('nama') ? 'has-error' : '' ?>">
                    <label for="nama" class="control-label">*Nama</label>
                    <input name="nama" type="text" class="form-control" value="<?= set_value('nama') ?>" />
                    <?php if (form_error('nama')): ?>
                        <span class="help-block"><?= form_error('nama') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tempat_lahir') ? 'has-error' : '' ?>">
                    <label for="tempat_lahir" class="control-label">*Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control" value="<?= set_value('tempat_lahir') ?>" />
                    <?php if (form_error('tempat_lahir')): ?>
                        <span class="help-block"><?= form_error('tempat_lahir') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tanggal_lahir') ? 'has-error' : '' ?>">
                    <label for="tanggal_lahir" class="control-label">*Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="text" data-field-role="date" class="form-control" value="<?= set_value('tanggal_lahir') ?>" />
                    <?php if (form_error('tanggal_lahir')): ?>
                        <span class="help-block"><?= form_error('tanggal_lahir') ?></span>
                    <?php endif ?>
                </div>

                <?php

                $arr_agama = [
                    'Islam' => 'Islam',
                    'Kristen' => 'Kristen',
                    'Hindu' => 'Hindu',
                    'Budha' => 'Budha',
                    'Katholik' => 'Katholik',
                    'Kepercayaan' => 'Kepercayaan'
                ];

                ?>

                <div class="form-group <?= form_error('agama') ? 'has-error' : '' ?>">
                    <label for="agama" class="control-label">*Agama</label>
                    <?= form_dropdown('agama', $arr_agama, set_value('agama'), 'class="form-control"') ?>
                    <?php if (form_error('agama')): ?>
                        <span class="help-block"><?= form_error('agama') ?></span>
                    <?php endif ?>
                </div>

                <?php

                $arr_jenis_kelamin = [
                    'P' => 'Pria',
                    'W' => 'Wanita'
                ];

                ?>

                <div class="form-group <?= form_error('jenis_kelamin') ? 'has-error' : '' ?>">
                    <label for="jenis_kelamin" class="control-label">*Jenis Kelamin</label>
                    <?= form_dropdown('jenis_kelamin', $arr_jenis_kelamin, set_value('jenis_kelamin'), 'class="form-control"') ?>
                    <?php if (form_error('jenis_kelamin')): ?>
                        <span class="help-block"><?= form_error('jenis_kelamin') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('alamat') ? 'has-error' : '' ?>">
                    <label for="alamat" class="control-label">*Alamat</label>
                    <input name="alamat" type="text" class="form-control" value="<?= set_value('alamat') ?>" />
                    <?php if (form_error('alamat')): ?>
                        <span class="help-block"><?= form_error('alamat') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('no_hp') ? 'has-error' : '' ?>">
                    <label for="no_hp" class="control-label">*No HP</label>
                    <input name="no_hp" type="text" class="form-control" value="<?= set_value('no_hp') ?>" />
                    <?php if (form_error('no_hp')): ?>
                        <span class="help-block"><?= form_error('no_hp') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('email') ? 'has-error' : '' ?>">
                    <label for="email" class="control-label">*Email</label>
                    <input name="email" type="text" class="form-control" value="<?= set_value('email') ?>" />
                    <?php if (form_error('email')): ?>
                        <span class="help-block"><?= form_error('email') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan1') ? 'has-error' : '' ?>">
                    <label for="jabatan1" class="control-label">Jabatan Yang Diinginkan #1</label>
                    <input name="jabatan1" type="text" class="form-control" value="<?= set_value('jabatan1') ?>" />
                    <?php if (form_error('jabatan1')): ?>
                        <span class="help-block"><?= form_error('jabatan1') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan2') ? 'has-error' : '' ?>">
                    <label for="jabatan2" class="control-label">Jabatan Yang Diinginkan #2</label>
                    <input name="jabatan2" type="text" class="form-control" value="<?= set_value('jabatan2') ?>" />
                    <?php if (form_error('jabatan2')): ?>
                        <span class="help-block"><?= form_error('jabatan2') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan3') ? 'has-error' : '' ?>">
                    <label for="jabatan3" class="control-label">Jabatan Yang Diinginkan #3</label>
                    <input name="jabatan3" type="text" class="form-control" value="<?= set_value('jabatan3') ?>" />
                    <?php if (form_error('jabatan3')): ?>
                        <span class="help-block"><?= form_error('jabatan3') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('ekspetasi_gaji') ? 'has-error' : '' ?>">
                    <label for="ekspetasi_gaji" class="control-label">*Ekspetasi Gaji (Rp)</label>
                    <input name="ekspetasi_gaji" type="text" class="form-control" value="<?= set_value('ekspetasi_gaji') ?>" />
                    <?php if (form_error('ekspetasi_gaji')): ?>
                        <span class="help-block"><?= form_error('ekspetasi_gaji') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('foto') ? 'has-error' : '' ?>">
                    <label for="foto" class="control-label">Foto</label>
                    <input name="foto" type="file" class="form-control" value="<?= set_value('foto') ?>" />
                    <span class="help-block">Max Dimensi : 1024px x 768px, Max Ukuran File: 1MB, Tipe: jpg|jpeg|png</span>
                    <?php if (form_error('foto')): ?>
                        <span class="help-block"><?= form_error('foto') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('cv') ? 'has-error' : '' ?>">
                    <label for="cv" class="control-label">CV</label>
                    <input name="cv" type="file" class="form-control" value="<?= set_value('cv') ?>" />
                    <span class="help-block">Max Ukuran File: 4MB, Tipe: pdf</span>
                    <?php if (form_error('cv')): ?>
                        <span class="help-block"><?= form_error('cv') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/biodata') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
