<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/hrd/hasil_wawancara') ?>">Hasil Wawancara</a></li>
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
                            <th class="fit">Jabatan Yang Dilamar</th>
                            <th>Status</th>
                            <th class="fit">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($lamaran)): ?>
                            <?php foreach ($lamaran as $r): ?>
                                <tr>
                                    <td class="fit">
                                        <a href="<?= site_url('dashboard/hrd/hasil_wawancara/biodata_detail?biodata_id='.$r->biodata_id) ?>">
                                            <?= $r->nama_pelamar ?>
                                        </a>
                                    </td>
                                    <td class="fit"><?= $r->email_pelamar ?></td>
                                    <td class="fit"><?= $r->jabatan ?></td>
                                    <td>
                                        <?php
                                        $label_stat = 'success';
                                        if ($r->status_lamaran === 'rejected')
                                            $label_stat = 'danger';
                                        elseif ($r->status_lamaran === 'interview')
                                            $label_stat = 'info';
                                        ?>
                                        <span class="label label-<?= $label_stat ?>">
                                            <?= $arr_status_lamaran[$r->status_lamaran] ?>
                                        </span>
                                    </td>
                                    <td class="fit">
                                        <?php if ($r->status_lamaran === 'pelamar_submit'): ?>
                                            <a href="<?= site_url('dashboard/hrd/hasil_wawancara/interview?status_lamaran_id='.$r->status_lamaran_id) ?>"
                                                class="btn btn-info btn-sm">
                                                <i class="glyphicon glyphicon-check"></i>
                                                Interview
                                            </a>
                                            <a href="<?= site_url('dashboard/hrd/hasil_wawancara/reject?status_lamaran_id='.$r->status_lamaran_id) ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="glyphicon glyphicon-remove"></i>
                                                Tolak
                                            </a>
                                        <?php endif ?>
                                        <?php if ($r->status_lamaran === 'interview'): ?>
                                            <a href="<?= site_url('dashboard/hrd/hasil_wawancara/approve?status_lamaran_id='.$r->status_lamaran_id) ?>"
                                                class="btn btn-success btn-sm">
                                                <i class="glyphicon glyphicon-check"></i>
                                                Setuju
                                            </a>
                                            <a href="<?= site_url('dashboard/hrd/hasil_wawancara/reject?status_lamaran_id='.$r->status_lamaran_id) ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="glyphicon glyphicon-remove"></i>
                                                Tolak
                                            </a>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
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
