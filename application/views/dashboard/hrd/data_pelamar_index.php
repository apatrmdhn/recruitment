<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/hrd/data_pelamar') ?>">Data Pelamar</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama</th>
                    <th class="fit">Email</th>
                    <th class="fit">TTL</th>
                    <th class="fit">Jabatan Yang Diinginkan</th>
                    <th>Ekspetasi Gaji</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($biodata)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($biodata as $r): ?>
                        <?php
                        $jabatan = [];
                        if ($r->jabatan1)
                            $jabatan[] = $r->jabatan1;
                        if ($r->jabatan2)
                            $jabatan[] = $r->jabatan2;
                        if ($r->jabatan3)
                            $jabatan[] = $r->jabatan3;
                        ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama ?></td>
                            <td class="fit"><?= $r->email ?></td>
                            <td class="fit"><?= $r->tempat_lahir ?>, <?= $r->tanggal_lahir ?></td>
                            <td class="fit"><?= implode(',', $jabatan) ?></td>
                            <td><?= number_format($r->ekspetasi_gaji, 0, ',', '.') ?></td>
                            <td class="fit">
                                <a href="<?= site_url('dashboard/hrd/data_pelamar/detail') ?>?biodata_id=<?= $r->biodata_id ?>"
                                    class="btn btn-default btn-sm" title="Detail">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif ?>

            </tbody>

        </table>

    </div>
</div>
