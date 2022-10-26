    <!-- Main content -->
    <section class="content  pull-center">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <?php // if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
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
              <form action="<?php echo base_url('Form_urgent/cart/'); ?>" method="POST">
              <div class="form-group">
                <label>Invoice</label>
               <input type="text" class="form-control" name="invoice" value="<?php echo $invoice; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Barang</label>
                <select class="form-control select2" name="kode_toko" style="width: 100%;">
                  <?php foreach ($toko as $tk) { ?>
                  <option value="<?php echo $tk->kode_toko; ?>">( <?php echo $tk->kode_toko; ?> ) <?php echo $tk->nama_toko; ?></option>
                  <?php } ?>
                </select>
              </div>
              <span class="input-group-btn">
                 <button type="submit" name="keranjang" style="border-radius: 12%" class="btn btn-success btn-flat"><i class="fa fa-floppy-o"></i> Save</button>
              </span>
            </div>
          </form>
          <div class="col-md-9">
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Toko Urgent</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No Pesanan</th>
                  <th>Kode Toko</th>
                  <th>Nama Toko</th>
                  <th>Tanggal Buat</th>
                  <th>Action</th>
                </tr>
                <?php foreach ($toko_urgent as $ur) { 
                    $nm_toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko = $ur->toko")->row();
                  ?>
                <tr>
                  <td><?php echo $ur->no_pesanan; ?></td>
                  <td><?php echo $ur->toko; ?></td>
                  <td><?php echo $nm_toko->nama_toko; ?></td>
                  <td><?php echo date('d F Y', strtotime($ur->tanggal)); ?></td>
                  <td>
                    <a href="<?php echo base_url('Form_urgent/detail_order/'.$ur->no_pesanan); ?>" class="btn btn-success"><i class="fa fa-trash-o"></i> Detail Order</a> | 
                    <a href="<?php echo base_url('Form_urgent/delt_urgent/'.$ur->no_pesanan); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a> |
                    <a href="<?php echo base_url('Form_urgent/invoice/'.$ur->no_pesanan) ?>" class="btn btn-info"><i class="fa fa-print"></i> Cetak</a></td>
                </tr>
                <?php } ?>
              </table>
            </div>
          </div>
          <?php $data = $this->db->query("SELECT * FROM urgent")->result(); 
            if($data != NULL) { ?>
          <span class="input-group-btn">
                <a href="<?php echo base_url('Form_urgent/delt/'.$ur->no_pesanan) ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Hapus Data</a>
          </span>
        <?php } else { echo ''; } ?>
        </div>
          <!-- /.row -->
      </div>
        <!-- /.box-body -->
    </div>
  </section>
