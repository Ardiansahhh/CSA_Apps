        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table id="data" class="table table-bordered table-striped table-scalable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Sales Order</th>
                                        <th>Tanggal Rilis</th>
                                        <th>Kode Toko</th>
                                        <th>Nama Toko</th>
                                        <th>Alamat</th>
                                        <th>Wilayah</th>
										<th>Kubikasi</th>
                                        <th>Action</th>
										<th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($data_cust as $dc) { 
                                      $data = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$dc->no_sales_order'")->result();
                                      $detail = count($data);
									  $check = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$dc->no_sales_order'")->row();
									  $total = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM detail_item_undelivery WHERE no_sales_order = '$dc->no_sales_order'")->row();
                                      ?>
									  
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $dc->no_sales_order; ?></td>
                                        <td><?php echo $dc->tanggal_rilis; ?></td>
                                        <td><?php echo $dc->kode_toko; ?></td>
                                        <td><?php echo $dc->nama_toko; ?></td>
                                        <td><?php echo $dc->alamat; ?></td>
                                        <td><?php echo $dc->nama_wilayah; ?></td>
										<td><?php echo (int)$total->kubik / 1000000; ?></td>
                                        <td>
											<a href="<?php echo base_url('UnDelivery/itemDetail/'.$dc->no_sales_order); ?>"
                                                class="btn btn-primary pull-right"><i class="fa fa-trash-o"></i> Detail
                                                Order <?php echo $detail; ?></a>
										</td>
										<td>
											<?php if($check == NULL) { ?>
											<form action="<?php echo base_url('Group/simpan_toko') ?>" method="post">
												<input type="hidden" name="no_polisi" value="<?php echo $no_polisi; ?>">
												<input type="hidden" name="no_sales_order" value="<?php echo $dc->no_sales_order; ?>">
												<input type="hidden" name="kode_toko" value="<?php echo $dc->kode_toko; ?>">
												<input type="hidden" name="ruang_lingkup" value="<?php echo $dc->ruang_lingkup; ?>">
												<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-plus"></i></button>
											</form>
											<?php } else { echo 'Sudah Ditambahkan'; } ?>
										</td>
                                    </tr>
                                    <?php $no++; ?>
                                    <?php } ?>
									<?php echo '<div class="alert alert-success">'.'<b>'.'TOTAL KUBIKASI : '.  (int)$kubikasi / 1000000 . '<b>'. '</div>'; ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
