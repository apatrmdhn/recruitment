<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Curiculum Vitae</a></li>
            <li><a href="<?= site_url('dashboard/pelamar/pelatihan') ?>">Pelatihan</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/pelamar/pelatihan/add') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i>
            Tambah Pelatihan
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama</th>
                    <th class="fit">Penyelenggara</th>
                    <th class="fit">Lokasi</th>
                    <th>Tanggal</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($pelatihan)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($pelatihan as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama ?></td>
                            <td class="fit"><?= $r->penyelenggara ?></td>
                            <td class="fit"><?= $r->lokasi ?></td>
                            <td><?= $r->tanggal_mulai ?> - <?= $r->tanggal_selesai ?></td>
                            <td class="fit">
                                <a href="<?= site_url('dashboard/pelamar/pelatihan/edit') ?>?pelatihan_id=<?= $r->pelatihan_id ?>"
                                    class="btn btn-default btn-sm" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="javascript:confirmRedirect('Anda yakin ingin menghapus data: <?= $r->nama ?> ?', '<?= site_url('dashboard/pelamar/pelatihan/delete') ?>?pelatihan_id=<?= $r->pelatihan_id ?>')"
                                    class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
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
