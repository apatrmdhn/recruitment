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

                <div class="form-group">
                    <label for="nama" class="control-label">*Nama</label>
                    <input name="nama" type="text" class="form-control" value="<?= $biodata->nama ?>" />
                </div>

                <div class="form-group">
                    <label for="tempat_lahir" class="control-label">*Tempat Lahir</label>
                    <input name="tempat_lahir" type="text" class="form-control" value="<?= $biodata->tempat_lahir ?>" />
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir" class="control-label">*Tanggal Lahir</label>
                    <input name="tanggal_lahir" type="text" data-field-role="date" class="form-control" value="<?= $biodata->tanggal_lahir ?>" />
                </div>

                <div class="form-group">
                    <label for="agama" class="control-label">*Agama</label>
                    <?= form_dropdown('agama', $arr_agama, $biodata->agama, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('jenis_kelamin') ? 'has-error' : '' ?>">
                    <label for="jenis_kelamin" class="control-label">*Jenis Kelamin</label>
                    <?= form_dropdown('jenis_kelamin', $arr_jenis_kelamin, $biodata->jenis_kelamin, 'class="form-control"') ?>
                </div>

                <div class="form-group">
                    <label for="alamat" class="control-label">*Alamat</label>
                    <input name="alamat" type="text" class="form-control" value="<?= $biodata->alamat ?>" />
                </div>

                <div class="form-group">
                    <label for="no_hp" class="control-label">*No HP</label>
                    <input name="no_hp" type="text" class="form-control" value="<?= $biodata->no_hp ?>" />
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">*Email</label>
                    <input name="email" type="text" class="form-control" value="<?= $biodata->email ?>" />
                </div>

                <div class="form-group">
                    <label for="jabatan1" class="control-label">Jabatan Yang Diinginkan #1</label>
                    <input name="jabatan1" type="text" class="form-control" value="<?= $biodata->jabatan1 ?>" />
                </div>

                <div class="form-group">
                    <label for="jabatan2" class="control-label">Jabatan Yang Diinginkan #2</label>
                    <input name="jabatan2" type="text" class="form-control" value="<?= $biodata->jabatan2 ?>" />
                </div>

                <div class="form-group <?= form_error('jabatan3') ? 'has-error' : '' ?>">
                    <label for="jabatan3" class="control-label">Jabatan Yang Diinginkan #3</label>
                    <input name="jabatan3" type="text" class="form-control" value="<?= $biodata->jabatan3 ?>" />
                </div>

                <div class="form-group <?= form_error('ekspetasi_gaji') ? 'has-error' : '' ?>">
                    <label for="ekspetasi_gaji" class="control-label">*Ekspetasi Gaji (Rp)</label>
                    <input name="ekspetasi_gaji" type="text" class="form-control" value="<?= $biodata->ekspetasi_gaji ?>" />
                </div>

                <div class="form-group <?= form_error('foto') ? 'has-error' : '' ?>">
                    <label for="foto" class="control-label">Foto</label>
                    <input name="foto" type="file" class="form-control" value="<?= $biodata->foto ?>" />
                    <span class="help-block">Max Dimensi : 1024px x 768px, Max Ukuran File: 1MB, Tipe: jpg|jpeg|png</span>
                </div>

                <div class="form-group <?= form_error('cv') ? 'has-error' : '' ?>">
                    <label for="cv" class="control-label">CV</label>
                    <input name="cv" type="file" class="form-control" value="<?= $biodata->cv ?>" />
                    <span class="help-block">Max Ukuran File: 4MB, Tipe: pdf</span>
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
