<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/hrd/fpk') ?>">Formulir Permintaan Karyawan</a></li>
            <li class="active">Detail</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">

            <div class="panel-body">

                <table class="table table-bordere table-striped table-hover">
                    <tbody>

                        <tr>
                            <th class="fit">Nama Pemohon</th>
                            <td><?= $fpk->nama_pemohon ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Jabatan Pemohon</th>
                            <td><?= $fpk->jabatan_pemohon ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Lokasi</th>
                            <td><?= $fpk->lokasi ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Jabatan</th>
                            <td><?= $fpk->jabatan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Jumlah Kebutuhan (Orang)</th>
                            <td><?= $fpk->jumlah_kebutuhan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Usia Minimum (Thn.)</th>
                            <td><?= $fpk->usia_min ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Usia Maksimum (Thn.)</th>
                            <td><?= $fpk->usia_max ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Pendidikan Minimum</th>
                            <td><?= $arr_tingkat_pendidikan[$fpk->pendidikan_min] ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Pengalaman Minimum (Thn)</th>
                            <td><?= $fpk->pengalaman_min ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Deskripsi Pekerjaan</th>
                            <td><?= $fpk->deskripsi_pekerjaan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Alasan</th>
                            <td><?= $fpk->alasan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Status</th>
                            <td><?= $fpk->status ?></td>
                        </tr>

                    </tbody>
                </table>

            </div>

            <div class="panel-footer">
                <?php if ($fpk->status === 'divisi_submit'): ?>
                    <a href="<?= site_url('dashboard/hrd/fpk/approve?fpk_id='.$fpk->fpk_id) ?>"
                        class="btn btn-success">
                        <i class="glyphicon glyphicon-check"></i>
                        Setuju
                    </a>
                    <a href="<?= site_url('dashboard/hrd/fpk/reject?fpk_id='.$fpk->fpk_id) ?>"
                        class="btn btn-warning">
                        <i class="glyphicon glyphicon-remove"></i>
                        Tolak
                    </a>
                <?php endif ?>
                <a href="<?= site_url('dashboard/hrd/fpk') ?>"
                    class="btn btn-default">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</div>
