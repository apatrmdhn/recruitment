<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/pengalaman_kerja') ?>">Pengalaman Kerja</a></li>
            <li class="active">Add</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/pengalaman_kerja/add'), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('nama_perusahaan') ? 'has-error' : '' ?>">
                    <label for="nama_perusahaan" class="control-label">*Nama Perusahaan</label>
                    <input name="nama_perusahaan" type="text" class="form-control" value="<?= set_value('nama_perusahaan') ?>" />
                    <?php if (form_error('nama_perusahaan')): ?>
                        <span class="help-block"><?= form_error('nama_perusahaan') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tanggal_masuk') ? 'has-error' : '' ?>">
                    <label for="tanggal_masuk" class="control-label">*Tanggal Masuk</label>
                    <input name="tanggal_masuk" type="text" data-field-role="date" class="form-control" value="<?= set_value('tanggal_masuk') ?>" />
                    <?php if (form_error('tanggal_masuk')): ?>
                        <span class="help-block"><?= form_error('tanggal_masuk') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tanggal_keluar') ? 'has-error' : '' ?>">
                    <label for="tanggal_keluar" class="control-label">*Tanggal Keluar</label>
                    <input name="tanggal_keluar" type="text" data-field-role="date" class="form-control" value="<?= set_value('tanggal_keluar') ?>" />
                    <?php if (form_error('tanggal_keluar')): ?>
                        <span class="help-block"><?= form_error('tanggal_keluar') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('jabatan') ? 'has-error' : '' ?>">
                    <label for="jabatan" class="control-label">*Jabatan</label>
                    <input name="jabatan" type="text" class="form-control" value="<?= set_value('jabatan') ?>" />
                    <?php if (form_error('jabatan')): ?>
                        <span class="help-block"><?= form_error('jabatan') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/pengalaman_kerja') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
