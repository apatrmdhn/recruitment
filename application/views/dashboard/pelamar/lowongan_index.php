<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/pelamar/lowongan') ?>">Lowongan</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <?php foreach ($lowongan as $r): ?>

            <div class="panel panel-primary" style="margin-bottom: 20px;">

                <div class="panel-heading">
                    <?= $r->jabatan ?>
                </div>

                <div class="panel-body">

                    <table class="table table-stripped">
                        <tbody>
                            <tr>
                                <th class="fit">Lokasi</th>
                                <td><?= $r->lokasi ?></td>
                            </tr>
                            <tr>
                                <th class="fit">Jumlah Dibutuhkan</th>
                                <td><?= $r->jumlah_kebutuhan ?> Orang</td>
                            </tr>
                            <tr>
                                <th class="fit">Usia Minimal</th>
                                <td><?= $r->usia_min ?> Tahun</td>
                            </tr>
                            <tr>
                                <th class="fit">Usia Maksimal</th>
                                <td><?= $r->usia_max ?> Tahun</td>
                            </tr>
                            <tr>
                                <th class="fit">Pendidikan Minimal</th>
                                <td><?= $r->pendidikan_min ?></td>
                            </tr>
                            <tr>
                                <th class="fit">Pengalaman Minimal</th>
                                <td><?= $r->pengalaman_min ?> Tahun</td>
                            </tr>
                            <tr>
                                <th class="fit">Deskripsi Jabatan</th>
                                <td><?= $r->deskripsi_pekerjaan ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="panel-footer">

                    <a href="<?= site_url('dashboard/pelamar/lowongan/detail?fpk_id='.$r->fpk_id) ?>"
                        class="btn btn-success">
                        <i class="glyphicon glyphicon-hand-right"></i>
                        Baca Selengkapnya
                    </a>

                </div>

            </div>

        <?php endforeach ?>

    </div>
</div>
