        <!-- Main content -->
        <section class="content">
        	<div class="row">
        		<div class="col-xs-12">
        			<a href="<?php echo base_url('Undelivery/cluster'); ?>" class="btn btn-warning"><i class="fa fa-back"></i> Kembali</button></a><br>
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
        								<th>Bruto</th>
        								<th>Action</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1; ?>
        							<?php foreach ($data_cust as $dc) {
										$data = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$dc->no_sales_order'")->result();
										$detail = count($data);
										$kubikasi = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM detail_item_undelivery WHERE no_sales_order = '$dc->no_sales_order'")->row();
										$harga = $this->db->query("SELECT SUM(harga) AS price FROM detail_item_undelivery WHERE no_sales_order = '$dc->no_sales_order'")->row();
									?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $dc->no_sales_order; ?></td>
        									<td><?php echo $dc->tanggal_rilis; ?></td>
        									<td><?php echo $dc->kode_toko; ?></td>
        									<td><?php echo $dc->nama_toko; ?></td>
        									<td><?php echo $dc->alamat; ?></td>
        									<td><?php echo $dc->nama_wilayah; ?></td>
        									<td><?php echo (int)$kubikasi->kubik / 1000000; ?></td>
        									<td>Rp <?php echo number_format($harga->price, '0', ',', '.'); ?></td>
        									<td>
        										<a href="<?php echo base_url('UnDelivery/itemDetail/' . $dc->no_sales_order); ?>" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Detail
        											Order <?php echo $detail; ?></a>
        										<form action="<?php echo base_url('Undelivery/hapus/' . $dc->no_sales_order . '/' . $kode_ruang); ?>" method="POST">
        											<button type="submit" name="hapus" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i> Hapus</button>
        										</form>
        									</td>
        								</tr>
        								<?php $no++; ?>
        							<?php } ?>
        							<?php echo '<div class="alert alert-success">' . '<b>' . 'TOTAL KUBIKASI : ' .  (int)$total_kubikasi / 1000000 . '<b>' . '</div>'; ?>

        						</tbody>
        					</table>
        				</div><!-- /.box-body -->
        			</div><!-- /.box -->
        		</div><!-- /.col -->
        	</div><!-- /.row -->
        </section>
