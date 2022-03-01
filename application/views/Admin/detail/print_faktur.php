<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INVOICE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini" onload="window.print()">
<div class="wrapper">
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
             PT.CATUR SENTOSA ANUGERAH
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Dari
          <address>
            <strong>PT.CATUR SENTOSA ANUGERAH</strong><br>
            Jl. Daan Mogot KM 14 RT 006 RW 001<br>
            JAKARTA<br>
            Phone: 021-619-7255<br>
            Fax: 021-619-0009
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Kepada 
          <address>
            <?php $data_toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko = $data_urgent->toko")->row(); 
                  $data_ruang = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$data_toko->ruang_lingkup'")->row();
            ?>
            <strong><?php echo $data_toko->nama_toko; ?></strong><br>
            <?php echo $data_toko->alamat; ?><br>
            <?php echo $data_ruang->nama_wilayah; ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>No. Pesanan :  <?php echo $data_urgent->no_pesanan; ?></b><br>
          <br>
          <b>Kode Toko : <?php echo $data_urgent->toko; ?></b><br>
          <b>Tanggal Buat : <?php echo date('d F Y', strtotime($data_urgent->tanggal)); ?></b><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Produk</th>
              <th>Ctn</th>
              <th>Pcs</th>
              <th>Extra</th>
              <th>Harga</th>
              <th>Disc</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1; $harga_subtotal = 0; $ptg = 0; ?>

            <?php foreach($detail as $d) { 
            $brg   = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row();
            ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $d->kode_barang; ?></td>
              <td><?php echo $brg->nama_barang; ?></td>
              <td><?php echo $d->ctn; ?></td>
              <td><?php echo $d->pcs; ?></td>
              <td><?php echo $d->ext; ?></td>
              <td>Rp <?php echo number_format(($d->harga), '0',',','.'); ?></td>
              <td><?php if($d->disc == NULL) { echo '0%'; } else { echo $d->disc.'%'; } ?></td>
              <td>Rp <?php echo number_format(($d->subtotal), '0',',','.'); ?></td>
              <?php $harga_subtotal += $d->subtotal; $ptg += ($d->subtotal - $d->after_disc); ?>
            </tr>
            <?php 
            $no++; ?>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            NOTE :
          </p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            Penerima &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hormat Kami,
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal :</th>
                <td>Rp <?php echo number_format(($harga_subtotal), '0',',','.'); ?> </td>
              </tr>
              <tr>
                <th>Potongan Diskon :</th>
                <td>Rp <?php echo number_format(($ptg), '0',',','.'); ?></td>
              </tr>
              <tr>
                <th>DPP :</th>
                <?php $dpp = $harga_subtotal - $ptg; ?>
                <td>Rp <?php echo number_format(($dpp), '0',',','.'); ?></td>
              </tr>
              <tr>
                <th>PPN 10%</th>
                <?php $ppn = (10/100) * $dpp; ?>
                <td>Rp <?php echo number_format(($ppn), '0',',','.'); ?></td>
              </tr>
              <tr>
                <th>TOTAL BAYAR</th>
                <?php $tb = $dpp + $ppn; ?>
                <td><b>Rp <?php echo number_format(($tb), '0',',','.'); ?></b></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </div>
</div>

<script src="<?php echo base_url('assets'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets'); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets'); ?>/dist/js/demo.js"></script>
</body>
</html>
