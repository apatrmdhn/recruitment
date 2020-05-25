<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/riwayat_pendidikan') ?>">Riwayat Pendidikan</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/pelamar/riwayat_pendidikan/add') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i>
            Tambah Riwayat Pendidikan
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Lembaga/Institusi</th>
                    <th class="fit">Tingkat Pendidikan</th>
                    <th class="fit">Program Studi</th>
                    <th class="fit">Tahun</th>
                    <th>Nilai/IPK</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($riwayat)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($riwayat as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->sekolah ?></td>
                            <td class="fit"><?= $r->tingkat_pendidikan ?></td>
                            <td class="fit"><?= $r->program_studi ?></td>
                            <td class="fit"><?= $r->tahun_masuk ?> s/d <?= $r->tahun_keluar ?></td>
                            <td><?= $r->nilai ?></td>
                            <td class="fit">
                                <a href="<?= site_url('dashboard/pelamar/riwayat_pendidikan/edit') ?>?riwayat_pendidikan_id=<?= $r->riwayat_pendidikan_id ?>"
                                    class="btn btn-default btn-sm" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="javascript:confirmRedirect('Anda yakin ingin menghapus data: <?= $r->sekolah ?> ?', '<?= site_url('dashboard/pelamar/riwayat_pendidikan/delete') ?>?riwayat_pendidikan_id=<?= $r->riwayat_pendidikan_id ?>')"
                                    class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="glyphicon glyphicon-remove"></i>
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
