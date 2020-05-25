<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/riwayat_pendidikan') ?>">Riwayat Pendidikan</a></li>
            <li class="active">Edit</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?= form_open_multipart(site_url('dashboard/pelamar/riwayat_pendidikan/edit?riwayat_pendidikan_id='.$rp->riwayat_pendidikan_id), ['class' => 'panel panel-default']) ?>

            <div class="panel-body">

                <div class="form-group <?= form_error('sekolah') ? 'has-error' : '' ?>">
                    <label for="sekolah" class="control-label">*Lembaga Pendidikan</label>
                    <input name="sekolah" type="text" class="form-control" value="<?= $rp->sekolah ?>" />
                </div>

                <div class="form-group <?= form_error('kota') ? 'has-error' : '' ?>">
                    <label for="kota" class="control-label">*Kota</label>
                    <input name="kota" type="text" class="form-control" value="<?= $rp->kota ?>" />
                </div>

                <div class="form-group <?= form_error('tingkat_pendidikan') ? 'has-error' : '' ?>">
                    <label for="tingkat_pendidikan" class="control-label">*Tingkat Pendidikan</label>
                    <?= form_dropdown('tingkat_pendidikan', $arr_tingkat_pendidikan, $rp->tingkat_pendidikan, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('program_studi') ? 'has-error' : '' ?>">
                    <label for="program_studi" class="control-label">*Program Studi</label>
                    <input name="program_studi" type="text" class="form-control" value="<?= $rp->program_studi ?>" />
                </div>

                <?php
                $arr_tahun = [];
                $tahun_now = (int) date("Y");
                for ($i=1900;$i<=$tahun_now-1;$i++) {
                    $arr_tahun[$i] = $i;
                }
                ?>

                <div class="form-group <?= form_error('tahun_masuk') ? 'has-error' : '' ?>">
                    <label for="tahun_masuk" class="control-label">*Tahun Masuk</label>
                    <?= form_dropdown('tahun_masuk', $arr_tahun, $rp->tahun_masuk, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('tahun_keluar') ? 'has-error' : '' ?>">
                    <label for="tahun_keluar" class="control-label">*Tahun Selesai</label>
                    <?= form_dropdown('tahun_keluar', $arr_tahun, $rp->tahun_keluar, 'class="form-control"') ?>
                </div>

                <div class="form-group <?= form_error('nilai') ? 'has-error' : '' ?>">
                    <label for="nilai" class="control-label">*Nilai/IPK</label>
                    <input name="nilai" type="text" class="form-control" value="<?= $rp->nilai ?>" />
                </div>

            </div>

            <div class="panel-footer">
                <button name="submit" type="submit" class="btn btn-primary">
                    <i class="glyphicon glyphicon-floppy-disk"></i>
                    Simpan
                </button>
                <a href="<?= site_url('dashboard/pelamar/riwayat_pendidikan') ?>"
                    class="btn btn-default">
                    Batal
                </a>
            </div>

        <?= form_close() ?>

    </div>
</div>
