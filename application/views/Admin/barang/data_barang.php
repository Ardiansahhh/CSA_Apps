        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                <form action="<?php echo base_url('Barang/filter_barang/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                        <select name="grup" class="form-control">
														<?php if($grup != NULL) { ?>
                            <?php foreach($grup as $g) { ?>
                            <option value="<?php echo $g->grup; ?>"><?php echo $g->grup; ?></option>
                            <?php } } else { ?>
															 <option>Data Belum Ada</option>
														<?php } ?>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" name="filter" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                </div><!-- /.box-header -->
                <div class="box-body">
        				<a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button></a>
								<?php if($barang == NULL) { ?>
                <a href="#"><button class="btn btn-info" type="button" data-target="#Modalcsv" data-toggle="modal"><i class="fa fa-file"></i> Import CSV</button></a>
								<?php } ?>
                <a href="<?php echo base_url("Barang/delt/") ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus Data</a>
						
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Isi</th>
														<th>Panjang</th>
														<th>Lebar</th>
														<th>Tinggi</th>
														<th>Kubikasi</th>
                            <th>Group</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($barang as $brg) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $brg->kode_barang; ?></td>
                           <td><?php echo $brg->nama_barang; ?></td>
                           <td><?php echo number_format($brg->harga,'0',',','.'); ?></td>
                           <td><?php echo $brg->isi; ?></td>
													 <td><?php echo $brg->panjang; ?> cm</td>
													 <td><?php echo $brg->lebar; ?> cm</td>
													 <td><?php echo $brg->tinggi; ?> cm</td>
													 <td><?php echo (int)$brg->kubikasi / 1000000 ?></td>
                           <td><?php echo $brg->grup; ?></td>
                           <td><?php include('modal_edit.php'); ?></td>
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
    <?php include('modal_csv.php'); ?>
    <?php include('modal_add.php'); ?>
