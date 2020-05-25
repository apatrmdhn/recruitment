<!DOCTYPE html>
<html>
<head>
    <title> Rekrutmen Online</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap-3.3.7/css/bootstrap-theme.min.css') ?>">
    <!-- <style>
		.footer {
		   position: fixed;
		   left: 0;
		   bottom: 0;
		   width: 100%;
		   background-color: #dde9ee;
		   color: white;
		   text-align: center;
		}
		</style> -->

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <?php $this->load->view('menu_atas') ?>
    </nav>
      <?php $this->load->view($content);?>

    <div id="footer" class="box text-center">

        <p class="f-left">&copy; 2020 Alfath Ramadhan, All Rights Reserved &reg;</p>

    </div> <!-- /footer -->

<script type="text/javascript" src="<?= base_url('assets/bootstrap-3.3.7/js/jquery-3.2.1.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/bootstrap-3.3.7/js/bootstrap.min.js') ?>"></script>

<script type="text/javascript">
$(function() {
    $('.nav a[href~="' + location.href + '"]').parents('li').addClass('active');
});
</script>
</body>
</html>
