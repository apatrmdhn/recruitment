<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/pelamar/pengumuman_lowongan') ?>">Informasi Pengumuman</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-primary" style="margin-bottom: 20px;">

            <div class="panel-body">

                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th class="fit">Pelamar</th>
                            <th class="fit">Email</th>
                            <th>Jabatan Yang Dilamar</th>
                            <th class="fit">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($lamaran)): ?>
                            <?php foreach ($lamaran as $r): ?>
                                <tr>
                                    <td class="fit"><?= $r->nama_pelamar ?></td>
                                    <td class="fit"><?= $r->email_pelamar ?></td>
                                    <td><?= $r->jabatan ?></td>
                                    <td class="fit">
                                        <span class="label label-<?= $r->status_lamaran === 'rejected' ? 'danger' : 'success' ?>">
                                            <?= $arr_status_lamaran[$r->status_lamaran] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada data
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>
