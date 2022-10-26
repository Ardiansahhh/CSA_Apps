        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
               
               
                </div><!-- /.box-header -->
                <div class="box-body">
				        <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button></a>
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No.Pesanan</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>CTN</th>
                            <th>Pcs</th>
                            <th>Extra</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <!-- <th>Edit</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($detail as $d) { ?>
                    <?php $barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row(); ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $d->no_pesanan ?></td>
                           <td><?php echo $d->kode_barang; ?></td>
                           <td> <?php echo $barang->nama_barang; ?></td>
                           <td><?php if($d->ctn == NULL) { echo '-'; } else { echo $d->ctn.' Carton'; } ?></td>
                           <td><?php if($d->pcs == NULL) { echo '-'; } else { echo $d->pcs.' pcs'; } ?></td>
                           <td><?php if($d->ext == NULL) { echo '-'; } else { echo $d->ext.' pcs'; } ?></td>
                           <td>Rp <?php echo number_format($d->harga, '0',',','.'); ?></td>
                           <td><?php if($d->disc == NULL) { echo '0%'; } else { echo $d->disc.'%'; } ?></td>
                           <!-- <td><?php // include('modal_edit.php'); ?></td> -->
                        </tr>
                  <?php $no++; ?>
                  <?php } ?>
                    </tbody>                  
                </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </section>
    <?php include('modal_add.php'); ?>
