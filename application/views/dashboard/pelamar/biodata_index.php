<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/pelamar/biodata') ?>">Biodata</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/pelamar/biodata/edit') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-pencil"></i>
            Update Biodata
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <tbody>
                <tr>
                    <th class="fit">*Nama</th>
                    <td><?= $biodata->nama ?></td>
                </tr>
                <tr>
                    <th class="fit">*Tempat Lahir</th>
                    <td><?= $biodata->tempat_lahir ?></td>
                </tr>
                <tr>
                    <th class="fit">*Tanggal Lahir</th>
                    <td><?= $biodata->tanggal_lahir ?></td>
                </tr>
                <tr>
                    <th class="fit">*Agama</th>
                    <td><?= $biodata->agama ?></td>
                </tr>
                <tr>
                    <th class="fit">*Jenis Kelamin</th>
                    <td>
                        <?php if ($biodata->jenis_kelamin): ?>
                            <?= ['P' => 'Pria', 'W' => 'Wanita'][$biodata->jenis_kelamin] ?>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <th class="fit">*Alamat</th>
                    <td><?= $biodata->alamat ?></td>
                </tr>
                <tr>
                    <th class="fit">*No HandPhone</th>
                    <td><?= $biodata->no_hp ?></td>
                </tr>
                <tr>
                    <th class="fit">*Email</th>
                    <td><?= $biodata->email ?></td>
                </tr>
                <tr>
                    <th class="fit">Jabatan Yang Diinginkan 1</th>
                    <td><?= $biodata->jabatan1 ?></td>
                </tr>
                <tr>
                    <th class="fit">Jabatan Yang Diinginkan 2</th>
                    <td><?= $biodata->jabatan2 ?></td>
                </tr>
                <tr>
                    <th class="fit">Jabatan Yang Diinginkan 3</th>
                    <td><?= $biodata->jabatan3 ?></td>
                </tr>
                <tr>
                    <th class="fit">*Ekspetasi Gaji (Rp)</th>
                    <td>
                        <?php if ($biodata->ekspetasi_gaji): ?>
                            <?= number_format($biodata->ekspetasi_gaji, 0, ',', '.') ?>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <th class="fit">Foto</th>
                    <td>
                        <?php if ($biodata->foto): ?>
                            <img src="<?= base_url('storage/fotos/'. $biodata->foto) ?>"
                                style="max-height:200px;" />
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <th class="fit">CV</th>
                    <td>
                        <?php if ($biodata->cv): ?>
                            <a href="<?= base_url('storage/cv/'. $biodata->cv) ?>"
                                class="btn btn-default" target="_blank">
                                <i class="glyphicon glyphicon-eye-open"></i>
                                Lihat CV PDF
                            </a>
                        <?php endif ?>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
</div>
