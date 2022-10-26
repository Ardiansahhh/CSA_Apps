        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-sitemap"></i> Tambah Group</button></a>
							<a href="<?php echo base_url('Group/delt'); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Reset Data</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="data" class="table table-bordered table-striped table-scalable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Kendaraan</th>
                                        <th>Kubikasi</th>
										<th>Bruto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($data as $d) { ?>
									<?php 
									$toko = count($this->db->query("SELECT * FROM detail_group_area WHERE no_polisi = '$d->no_polisi'")->result()); 
									$kubikasi = $this->db->query("SELECT SUM(kubikasi) AS total FROM detail_order_area WHERE no_polisi = '$d->no_polisi'")->row();
									$bruto = $this->db->query("SELECT SUM(harga) AS price FROM detail_order_area WHERE no_polisi = '$d->no_polisi'")->row();
									?>
                                    <tr>
                                       <td><?php echo $no; ?></td>
									   <td><?php echo $d->no_polisi; ?></td>
									   <td><?php echo (int)$kubikasi->total / 1000000; ?></td>
									   <td>
								
										<?php 
										if($bruto->price != NULL) { 
											echo 'Rp ' . number_format($bruto->price,'0',',','.'); 
											} else { echo 'Rp 0'; }; ?>
							
									   </td>
									   <td>
										<a href="<?php echo base_url('Group/pilih/'.$d->no_polisi); ?>" class="btn btn-primary"><i class="fa fa-map"></i> Pilih Toko</a>
										<a href="<?php echo base_url('Group/detail/'.$d->no_polisi); ?>" class="btn btn-success"><i class="fa fa-map"></i> Detail Toko (<?php echo $toko; ?>)</a>
										<a href="<?php echo base_url('Group/detailOrder/'.$d->no_polisi); ?>" class="btn btn-warning"><i class="fa fa-cubes"></i> Detail Barang</a>
									    </td>
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
