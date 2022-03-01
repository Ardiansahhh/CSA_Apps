    <!-- Main content -->
    <section class="content  pull-center">
      <span class="input-group-btn">
        <a href="<?php echo base_url('Sales/invoice/') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Cetak</a>
      </span>
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
          <h3 class="box-title">Form Pinjam Barang</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-3">
              <form action="<?php echo base_url('Sales/cart/'); ?>" method="POST">
              <div class="form-group">
                <label>Invoice</label>
               <input type="text" class="form-control" name="invoice" value="<?php echo $invoice; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Barang</label>
                <select class="form-control select2" name="kode_barang" style="width: 100%;">
                  <?php foreach ($barang as $brg) { ?>
                  <option value="<?php echo $brg->kode_barang; ?>">( <?php echo $brg->kode_barang; ?> ) <?php echo $brg->nama_barang; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
               <input type="number" class="form-control" placeholder="Jumlah Pinjam" name="jumlah" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Extra</label>
               <input type="number" class="form-control" placeholder="Masukkan extra ( Optional )" name="extra" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Tujuan Pinjam</label>
               <input type="text" class="form-control" placeholder="Alasan Peminjaman Barang" name="alasan" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Salesman / MD</label>
                <select class="form-control select2" name="salesman" style="width: 100%;">
                  <?php foreach ($salesman as $sl) { ?>
                  <option value="<?php echo $sl->kode; ?>"><?php echo $sl->nama; ?></option>
                  <?php } ?>
                </select>
              </div>
              <span class="input-group-btn">
                 <button type="submit" name="keranjang" class="btn btn-success btn-flat">Tambahkan Ke Keranjang <i class="fa fa-cart-plus"></i></button>
              </span>
            </div>
          </form>
          <div class="col-md-9">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Peminjaman Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>CTN</th>
                  <th>PCS</th>
                  <th>Extra</th>
                  <th>Harga</th>
                  <th>Peminjam</th>
                  <th>Alasan</th>
                  <th>Status</th>
                </tr>
                <?php foreach ($pinjam as $cart) { ?>
                <tr>
                  <td><?php echo $cart->kode; ?></td>
                  <td><?php echo $cart->nama; ?></td>
                  <td><?php if($cart->ctn == 0) { echo ''; } else { echo $cart->ctn; } ?></td>
                  <td><?php if($cart->pcs == 0) { echo ''; } else { echo $cart->pcs; } ?></td>
                  <td><?php if($cart->extra == 0) { echo ''; } else { echo $cart->extra; } ?></td>
                  <td><?php echo $cart->harga; ?></td>
                  <td><?php echo $cart->peminjam; ?></td>
                  <td><?php echo $cart->alasan; ?></td>
                  <td><span class="label label-warning">Pending</span></td>
                </tr>
                <?php } ?>
              </table>
            </div>
          </div>
          <?php $data = $this->db->query("SELECT * FROM pinjam")->result(); 
            if($data != NULL) { ?>
          <span class="input-group-btn">
                <a href="<?php echo base_url('Sales/delt/') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Hapus Data</a>
          </span>
        <?php } else { echo ''; } ?>
        </div>
          <!-- /.row -->
      </div>
        <!-- /.box-body -->
    </div>
  </section>
