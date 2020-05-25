<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/divisi/fpk') ?>">Formulir Permintaan Karyawan</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/divisi/fpk/edit?fpk_id='.$fpk->fpk_id), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('nama_pemohon') ? 'has-error' : '' ?>">
                    <label for="nama_pemohon" class="control-label">*Nama Pemohon</label>
                    <input name="nama_pemohon" type="text" class="form-control" value="<?= set_value('nama_pemohon') ?>" />
                    <?php if (form_error('nama_pemohon')): ?>
                        <span class="help-block"><?= form_error('nama_pemohon') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan_pemohon') ? 'has-error' : '' ?>">
                    <label for="jabatan_pemohon" class="control-label">*Jabatan Pemohon</label>
                    <input name="jabatan_pemohon" type="text" class="form-control" value="<?= set_value('jabatan_pemohon') ?>" />
                    <?php if (form_error('jabatan_pemohon')): ?>
                        <span class="help-block"><?= form_error('jabatan_pemohon') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('lokasi') ? 'has-error' : '' ?>">
                    <label for="lokasi" class="control-label">*Lokasi</label>
                    <input name="lokasi" type="text" class="form-control" value="<?= set_value('lokasi') ?>" />
                    <?php if (form_error('lokasi')): ?>
                        <span class="help-block"><?= form_error('lokasi') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan') ? 'has-error' : '' ?>">
                    <label for="jabatan" class="control-label">*Jabatan Yg Dibutuhkan</label>
                    <input name="jabatan" type="text" class="form-control" value="<?= set_value('jabatan') ?>" />
                    <?php if (form_error('jabatan')): ?>
                        <span class="help-block"><?= form_error('jabatan') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jumlah_kebutuhan') ? 'has-error' : '' ?>">
                    <label for="jumlah_kebutuhan" class="control-label">*Jumlah Kebutuhan (Orang)</label>
                    <input name="jumlah_kebutuhan" type="number" class="form-control" value="<?= set_value('jumlah_kebutuhan') ?>" />
                    <?php if (form_error('jumlah_kebutuhan')): ?>
                        <span class="help-block"><?= form_error('jumlah_kebutuhan') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('usia_min') ? 'has-error' : '' ?>">
                    <label for="usia_min" class="control-label">*Usia Minimum (Thn.)</label>
                    <input name="usia_min" type="number" class="form-control" value="<?= set_value('usia_min') ?>" />
                    <?php if (form_error('usia_min')): ?>
                        <span class="help-block"><?= form_error('usia_min') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('usia_max') ? 'has-error' : '' ?>">
                    <label for="usia_max" class="control-label">*Usia Maksimum (Thn.)</label>
                    <input name="usia_max" type="number" class="form-control" value="<?= set_value('usia_max') ?>" />
                    <?php if (form_error('usia_max')): ?>
                        <span class="help-block"><?= form_error('usia_max') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('pendidikan_min') ? 'has-error' : '' ?>">
                    <label for="pendidikan_min" class="control-label">*Pendidikan Minimum</label>
                    <?= form_dropdown('pendidikan_min', $arr_tingkat_pendidikan, set_value('pendidikan_min'), 'class="form-control"') ?>
                    <?php if (form_error('pendidikan_min')): ?>
                        <span class="help-block"><?= form_error('pendidikan_min') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('pengalaman_min') ? 'has-error' : '' ?>">
                    <label for="pengalaman_min" class="control-label">*Pengalaman Minimum (Thn.)</label>
                    <input name="pengalaman_min" type="number" class="form-control" value="<?= set_value('pengalaman_min') ?>" />
                    <?php if (form_error('pengalaman_min')): ?>
                        <span class="help-block"><?= form_error('pengalaman_min') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('deskripsi_pekerjaan') ? 'has-error' : '' ?>">
                    <label for="deskripsi_pekerjaan" class="control-label">*Deskripsi Pekerjaan</label>
                    <input name="deskripsi_pekerjaan" type="text" class="form-control" value="<?= set_value('deskripsi_pekerjaan') ?>" />
                    <?php if (form_error('deskripsi_pekerjaan')): ?>
                        <span class="help-block"><?= form_error('deskripsi_pekerjaan') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('alasan') ? 'has-error' : '' ?>">
                    <label for="alasan" class="control-label">*Alasan</label>
                    <input name="alasan" type="text" class="form-control" value="<?= set_value('alasan') ?>" />
                    <?php if (form_error('alasan')): ?>
                        <span class="help-block"><?= form_error('alasan') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/divisi/fpk') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
