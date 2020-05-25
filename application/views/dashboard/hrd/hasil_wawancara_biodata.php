<div class="row">
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?= site_url('dashboard/hrd/hasil_wawancara') ?>">Hasil Wawancara</a></li>
            <li class="active">Biodata</li>
        </ol>
    </div>
</div>

<?php $this->load->view('dashboard/message') ?>

<div class="row" style="padding-bottom: 10px;">
    <div class="col-xs-12">
        <a href="<?= site_url('dashboard/hrd/hasil_wawancara') ?>"
            class="btn btn-default">
            <i class="glyphicon glyphicon-chevron-left"></i>
            Kembali
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
                    <td><?= ['P' => 'Pria', 'W' => 'Wanita'][$biodata->jenis_kelamin] ?></td>
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
                    <td><?= number_format($biodata->ekspetasi_gaji, 0, ',', '.') ?></td>
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

        <h3>RIWAYAT PENDIDIKAN</h3>

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Lembaga/Institusi</th>
                    <th class="fit">Tingkat Pendidikan</th>
                    <th class="fit">Program Studi</th>
                    <th class="fit">Tahun</th>
                    <th class="fit">Nilai/IPK</th>
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
                            <td class="fit"><?= $r->nilai ?></td>
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

        <h3>PENGALAMAN KERJA</h3>

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama Perusahaan</th>
                    <th class="fit">Tahun</th>
                    <th class="fit">Jabatan</th>
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
                            <td class="fit"><?= $r->jabatan ?></td>
                        <?php $i++ ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada data
                        </td>
                    </tr>
                <?php endif ?>

            </tbody>

        </table>

        <h3>PELATIHAN</h3>

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama</th>
                    <th class="fit">Penyelenggara</th>
                    <th class="fit">Lokasi</th>
                    <th class="fit">Tanggal</th>
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
                            <td class="fit"><?= $r->tanggal_mulai ?> - <?= $r->tanggal_selesai ?></td>
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

        <h3>BAHASA</h3>

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama</th>
                    <th class="fit">Baca</th>
                    <th class="fit">Tulis</th>
                    <th class="fit">Dengar</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($bahasa)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($bahasa as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama ?></td>
                            <td class="fit"><?= $r->baca ?></td>
                            <td class="fit"><?= $r->tulis ?></td>
                            <td class="fit"><?= $r->dengar ?></td>
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

        <h3>KEAHLIAN</h3>

        <table class="table table-bordered table-striped table-hover">

            <thead>
                <tr>
                    <th class="fit">No</th>
                    <th class="fit">Nama</th>
                    <th class="fit">Deksripsi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($keahlian)): ?>
                    <?php $i = 1 ?>
                    <?php foreach ($keahlian as $r): ?>
                        <tr>
                            <td class="fit"><?= $i ?></td>
                            <td class="fit"><?= $r->nama ?></td>
                            <td class="fit"><?= $r->deskripsi ?></td>
                        </tr>
                        <?php $i++ ?>
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
