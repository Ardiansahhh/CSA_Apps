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
        								<th>Harga</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1;
											$total = 0;
											$kubikasi = 0; ?>
        							<?php foreach ($detail as $d) { ?>
        								<?php $barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row();
												$kubikasi = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM detail_item_undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
												$harga = $this->db->query("SELECT SUM(harga) AS price FROM detail_item_undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
												?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $d->kode_barang; ?></td>
        									<td><?php echo $d->nama_barang; ?></td>
        									<td><?php echo floor((int)$d->kuantiti / (int)$barang->isi); ?></td>
        									<td><?php if ((int)$d->kuantiti >= (int)$barang->isi) {
																echo (int)$d->kuantiti % (int)$barang->isi;
															} else {
																echo $d->kuantiti;
															}; ?></td>
        									<td>Rp <?php echo number_format($d->harga, '0', ',', '.'); ?></td>
        								</tr>
        								<?php $no++; ?>
        							<?php } ?>
        							<?php echo '<b>' . 'Nilai Orderan: ' .  number_format($harga->price, '0', ',', '.') . '</b>' . '<br>';
											echo '<b>' . 'Kubikasi : ' . (int)$kubikasi->kubik / 1000000 . '</b>';
											?>
        						</tbody>
        					</table>
        				</div><!-- /.box-body -->
        			</div><!-- /.box -->
        		</div><!-- /.col -->
        	</div><!-- /.row -->
        </section>
