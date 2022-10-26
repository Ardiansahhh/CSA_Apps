        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <?php // if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>

                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <a href="<?php echo base_url('Group/cluster/'.$no_polisi) ?>"
                                class="btn btn-success"><i class="fa fa-cubes"></i> Kelompokkan Area</a> &nbsp;
                            <br></br>
                            <table id="data" class="table table-bordered table-striped table-scalable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No.Sales Order</th>
                                        <th>Tanggal Rilis</th>
                                        <th>Kode Toko</th>
                                        <th>Nama Toko</th>
										<th>Bruto</th>
                                        <th>Ruang Lingkup</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($data as $d) { ?>
                                    <?php $toko = $this->db->query("SELECT * FROM undelivery INNER JOIN tb_ruang_lingkup ON undelivery.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_ruang_lingkup.kode_ruang = '$d->ruang_lingkup'")->row(); 
                                     $alt = $this->db->query("SELECT * FROM tb_customer WHERE tb_customer.kode_toko = '$d->kode_toko'")->row();
									 $active = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$d->no_sales_order'")->row();
									 $harga = $this->db->query("SELECT SUM(harga) AS price FROM detail_item_undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
                                     ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $d->no_sales_order; ?></td>
                                        <td><?php echo $d->tanggal_rilis; ?></td>
                                        <td><?php echo $d->kode_toko; ?></td>
                                        <td><?php echo $d->nama_toko; ?></td>
										<td>Rp <?php echo number_format($harga->price,'0',',','.'); ?></td>
                                        <td><?php echo $toko->nama_wilayah ?></td>
										<td>
											<?php if($active == NULL) { ?>
											<form action="<?php echo base_url('Group/simpan') ?>" method="post">
												<input type="hidden" name="no_polisi" value="<?php echo $no_polisi; ?>">
												<input type="hidden" name="no_sales_order" value="<?php echo $d->no_sales_order; ?>">
												<input type="hidden" name="kode_toko" value="<?php echo $d->kode_toko; ?>">
												<input type="hidden" name="ruang_lingkup" value="<?php echo $d->ruang_lingkup; ?>">
												<button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
											</form>
											<?php } else { echo "Sudah Ditambahkan"; } ?>
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
