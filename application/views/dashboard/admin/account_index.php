<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/admin/accounts') ?>">Akun</a></li>
            <li class="active">Index</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/admin/accounts/add') ?>"
            class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i>
            Tambah Akun
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="fit">Username</th>
                    <th class="fit">Email</th>
                    <th>Hak Akses</th>
                    <th class="fit">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $arr_hak_akses = [
                    1 => 'Admin',
                    2 => 'Direktur Utama',
                    3 => 'HRD',
                    4 => 'Divisi Terkait',
                    5 => 'Pelamar'
                ];
                ?>
                <?php if (count($users)): ?>
                    <?php foreach ($users as $r): ?>
                        <tr>
                            <td class="fit"><?= $r->username ?></td>
                            <td class="fit"><?= $r->email ?></td>
                            <td><?= $arr_hak_akses[$r->hak_akses] ?></td>
                            <td class="fit">
                                <a href="<?= site_url('dashboard/admin/accounts/edit') ?>?user_id=<?= $r->user_id ?>"
                                    class="btn btn-default btn-sm" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="javascript:confirmRedirect('Anda yakin ingin menghapus user: <?= $r->username ?> ?', '<?= site_url('dashboard/admin/accounts/delete') ?>?user_id=<?= $r->user_id ?>')"
                                    class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>

    </div>
</div>
