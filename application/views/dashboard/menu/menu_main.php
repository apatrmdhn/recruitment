<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-main" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets/img/sis.png') ?>" class="logo">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="nav-main">

            <?php if ($hak_akses === $HAK_AKSES_ADMIN): ?>
                <?php $this->load->view('dashboard/menu/menu_admin') ?>
            <?php elseif ($hak_akses === $HAK_AKSES_DIRUT): ?>
                <?php $this->load->view('dashboard/menu/menu_dirut') ?>
            <?php elseif ($hak_akses === $HAK_AKSES_HRD): ?>
                <?php $this->load->view('dashboard/menu/menu_hrd') ?>
            <?php elseif ($hak_akses === $HAK_AKSES_DIVISI): ?>
                <?php $this->load->view('dashboard/menu/menu_divisi') ?>
            <?php else: ?>
                <?php $this->load->view('dashboard/menu/menu_pelamar') ?>
            <?php endif ?>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url('home') ?>">Situs</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        role="button" aria-haspopup="true" aria-expanded="false">
                        <b><?= $user->username ?> <span class="caret"></span></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('dashboard/change_password') ?>">Ubah Kata Sandi</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
