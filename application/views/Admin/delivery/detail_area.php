        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">            
                </div><!-- /.box-header -->
                <div class="box-body">
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
							<th>Karton</th>
                            <th>Pcs</th>
							<th>Total Keseluruhan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;?>
                  <?php foreach($detail as $d) { ?>
                    <?php $barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row(); ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $d->kode_barang; ?></td>
                           <td><?php echo $barang->nama_barang; ?></td>
						   <td><?php echo floor((int)$d->pcs / (int)$barang->isi);; ?></td>
                           <td><?php if((int)$d->pcs >= (int)$barang->isi) {
									echo (int)$d->pcs % (int)$barang->isi;
									} else {
									echo $d->pcs;
									} ?>
							</td>
							<td><?php echo $d->pcs; ?> pcs</td>
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
