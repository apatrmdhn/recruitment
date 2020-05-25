<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="<?= site_url('dashboard/divisi/fpk') ?>">Formulir Permintaan Karyawan</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/divisi/fpk/add') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i>
            Tambah Formulir Permintaan Karyawan
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama Pemohon</th>
                    <th class="fit">Jabatan Pemohon</th>
                    <th class="fit">Jabatan yang dibutuhkan</th>
                    <th class="fit">Jumlah yang dibutuhkan</th>
                    <th>Status</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($fpk)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($fpk as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama_pemohon ?></td>
                            <td class="fit"><?= $r->jabatan_pemohon ?></td>
                            <td class="fit"><?= $r->jabatan ?></td>
                            <td class="fit"><?= $r->jumlah_kebutuhan ?></td>
                            <td><?= $arr_status[$r->status] ?></td>
                            <td class="fit">
                                <?php if ($r->status === 'divisi_submit'): ?>
                                    <a href="<?= site_url('dashboard/divisi/fpk/detail') ?>?fpk_id=<?= $r->fpk_id ?>"
                                        class="btn btn-default btn-sm" title="Detail">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                    <a href="<?= site_url('dashboard/divisi/fpk/edit') ?>?fpk_id=<?= $r->fpk_id ?>"
                                        class="btn btn-default btn-sm" title="Edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                    <a href="javascript:confirmRedirect('Anda yakin ingin menghapus data: <?= $r->nama_pemohon.' :: '.$r->jabatan ?> ?', '<?= site_url('dashboard/divisi/fpk/delete') ?>?fpk_id=<?= $r->fpk_id ?>')"
                                        class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= site_url('dashboard/divisi/fpk/detail') ?>?fpk_id=<?= $r->fpk_id ?>"
                                        class="btn btn-default btn-sm" title="Detail">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                <?php endif ?>
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
