<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/pengalaman_kerja') ?>">Pengalaman Kerja</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/pelamar/pengalaman_kerja/add') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i>
            Tambah Pengalaman Kerja
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama Perusahaan</th>
                    <th class="fit">Tahun</th>
                    <th>Jabatan</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($pengalaman)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($pengalaman as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama_perusahaan ?></td>
                            <td class="fit"><?= $r->tanggal_masuk ?> s/d <?= $r->tanggal_keluar ?></td>
                            <td><?= $r->jabatan ?></td>
                            <td class="fit">
                                <a href="<?= site_url('dashboard/pelamar/pengalaman_kerja/edit') ?>?pengalaman_id=<?= $r->pengalaman_id ?>"
                                    class="btn btn-default btn-sm" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="javascript:confirmRedirect('Anda yakin ingin menghapus data: <?= $r->nama_perusahaan ?> ?', '<?= site_url('dashboard/pelamar/pengalaman_kerja/delete') ?>?pengalaman_id=<?= $r->pengalaman_id ?>')"
                                    class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
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
