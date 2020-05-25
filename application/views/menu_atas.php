<div class="container-fluid" style="background-color: #fff">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('home');?>" style="color: #0752f5">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('tentang');?>" style="color: #0752f5">Tentang</a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #0752f5">Produk <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?=site_url('produk/hrms');?>">HRMS</a>
            </li>
            <li>
              <a href="<?=site_url('produk/vireo');?>">Vireo</a>
            </li>
            <li>
              <a href="<?=site_url('produk/cms');?>">Courier Management System</a>
            </li>
            <li>
              <a href="<?=site_url('produk/wms');?>">Warehouse Management System</a>
            </li>
            <li>
              <a href="<?=site_url('produk/parking');?>">Parking System</a>
            </li>
            <li>
              <a href="<?=site_url('produk/vms');?>">Visitor Management System</a>
            </li>
            <li>
              <a href="<?=site_url('produk/sfa');?>">Sales Force Automation</a>
            </li>
            <li>
              <a href="<?=site_url('produk/dms');?>">Distribution Management System</a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #0752f5">Karir <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="<?=site_url('karir/lowongan');?>">Lowongan Kerja</a>
            </li>
            <li>
              <a href="<?=site_url('karir/panduan');?>">Cara Melamar Kerja</a>
            </li>
            <!-- <li>
              <a href="<?=site_url('karir/informasi');?>">Informasi</a>
            </li> -->
            <li>
              <a href="<?=site_url('dashboard/pelamar/pengumuman_lowongan');?>">Informasi</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('kontak');?>" style="color: #0752f5">Hubungi kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('dashboard/login');?>" style="color: #0752f5">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=site_url('karir/register');?>" style="color: #0752f5">Register</a>
        </li>
      </ul>

      <?php if (isset($is_login) && $is_login): ?>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="<?= site_url('dashboard/front') ?>">Dashboard</a></li>
          </ul>
      <?php endif ?>
    </div>
  </div>
</div>
