<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/bahasa') ?>">Bahasa</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/bahasa/edit?bahasa_id='.$bahasa->bahasa_id), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <?php if (isset($error) && $error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif ?>

                <div class="form-group <?= form_error('nama') ? 'has-error' : '' ?>">
                    <label for="nama" class="control-label">*Nama</label>
                    <input name="nama" type="text" class="form-control" value="<?= $bahasa->nama ?>" />
                </div>

                <div class="form-group <?= form_error('baca') ? 'has-error' : '' ?>">
                    <label for="baca" class="control-label">*Baca</label>
                    <?= form_dropdown('baca', $arr_kemampuan, $bahasa->baca, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('tulis') ? 'has-error' : '' ?>">
                    <label for="tulis" class="control-label">*Tulis</label>
                    <?= form_dropdown('tulis', $arr_kemampuan, $bahasa->tulis, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('dengar') ? 'has-error' : '' ?>">
                    <label for="dengar" class="control-label">*Dengar</label>
                    <?= form_dropdown('dengar', $arr_kemampuan, $bahasa->dengar, 'class="form-control"') ?>
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/bahasa') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
