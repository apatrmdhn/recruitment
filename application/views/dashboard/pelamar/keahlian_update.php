<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/keahlian') ?>">Keahlian</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/keahlian/edit?keahlian_id='.$keahlian->keahlian_id), ['class' => 'panel panel-default']) ?>

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

                <div class="form-group <?= form_error('deskripsi') ? 'has-error' : '' ?>">
                    <label for="deskripsi" class="control-label">*Deskripsi</label>
                    <input name="deskripsi" type="text" class="form-control" value="<?= set_value('deskripsi') ?>" />
                    <?php if (form_error('deskripsi')): ?>
                        <span class="help-block"><?= form_error('deskripsi') ?></span>
                    <?php endif ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/keahlian') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
