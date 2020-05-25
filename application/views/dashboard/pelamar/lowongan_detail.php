<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/pelamar/lowongan') ?>">Lowongan</a></li>
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
                            <th class="fit">Lokasi</th>
                            <td><?= $lowongan->lokasi ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Jabatan</th>
                            <td><?= $lowongan->jabatan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Jumlah Kebutuhan (Orang)</th>
                            <td><?= $lowongan->jumlah_kebutuhan ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Usia Minimum (Thn.)</th>
                            <td><?= $lowongan->usia_min ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Usia Maksimum (Thn.)</th>
                            <td><?= $lowongan->usia_max ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Pendidikan Minimum</th>
                            <td><?= $arr_tingkat_pendidikan[$lowongan->pendidikan_min] ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Pengalaman Minimum (Thn)</th>
                            <td><?= $lowongan->pengalaman_min ?></td>
                        </tr>

                        <tr>
                            <th class="fit">Deskripsi Pekerjaan</th>
                            <td><?= $lowongan->deskripsi_pekerjaan ?></td>
                        </tr>

                    </tbody>
                </table>

            </div>

            <div class="panel-footer">
                <a href="<?= site_url('dashboard/pelamar/lowongan/submit?fpk_id='.$lowongan->fpk_id) ?>"
                    class="btn btn-success">
                    <i class="glyphicon glyphicon-check"></i>
                    Lamar Lowongan Ini
                </a>
                <a href="<?= site_url('dashboard/pelamar/lowongan') ?>"
                    class="btn btn-default">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</div>
