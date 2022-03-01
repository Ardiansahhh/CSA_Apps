
  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        Faktur ini hanya digunakan sebagai dokumen sementara selama koneksi atau pengajuan toko selesai
      </div>
    </div>

    <section class="invoice">
      <!-- title row -->
      <div class="row page-header">
        <div class="col-xs-6">
          <h4>
             PT.CATUR SENTOSA ANUGERAH
          </h4>
        </div>
        <div class="col-xs-6">
          <h4>
             PT.CATUR SENTOSA ANUGERAH
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row ">
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

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="<?php echo base_url('Form_urgent/print/'.$no_pesanan); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
 