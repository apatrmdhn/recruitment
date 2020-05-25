<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/pelatihan') ?>">Pelatihan</a></li>
            <li class="active">Add</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/pelatihan/add'), ['class' => 'panel panel-default']) ?>

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

                <div class="form-group <?= form_error('penyelenggara') ? 'has-error' : '' ?>">
                    <label for="penyelenggara" class="control-label">*Penyelenggara</label>
                    <input name="penyelenggara" type="text" class="form-control" value="<?= set_value('penyelenggara') ?>" />
                    <?php if (form_error('penyelenggara')): ?>
                        <span class="help-block"><?= form_error('penyelenggara') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('lokasi') ? 'has-error' : '' ?>">
                    <label for="lokasi" class="control-label">*Lokasi</label>
                    <input name="lokasi" type="text" class="form-control" value="<?= set_value('lokasi') ?>" />
                    <?php if (form_error('lokasi')): ?>
                        <span class="help-block"><?= form_error('lokasi') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tanggal_mulai') ? 'has-error' : '' ?>">
                    <label for="tanggal_mulai" class="control-label">*Tanggal Mulai</label>
                    <input name="tanggal_mulai" type="text" data-field-role="date" class="form-control" value="<?= set_value('tanggal_mulai') ?>" />
                    <?php if (form_error('tanggal_mulai')): ?>
                        <span class="help-block"><?= form_error('tanggal_mulai') ?></span>
                    <?php endif ?>
                </div>

                <div class="form-group <?= form_error('tanggal_selesai') ? 'has-error' : '' ?>">
                    <label for="tanggal_selesai" class="control-label">*Tanggal Selesai</label>
                    <input name="tanggal_selesai" type="text" data-field-role="date" class="form-control" value="<?= set_value('tanggal_selesai') ?>" />
                    <?php if (form_error('tanggal_selesai')): ?>
                        <span class="help-block"><?= form_error('tanggal_selesai') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/pelatihan') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
