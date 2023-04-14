        <!-- Main content -->
        <section class="content">
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="box">
        				<div class="box-header">
        				</div><!-- /.box-header -->
        				<div class="box-body">
        					<?php echo 'NO POLISI : ' . $no_polisi; ?><br>
        					<?php echo 'KUBIKASI : ' . (int)$kubikasi / 1000000; ?>
        					<table id="data" class="table table-bordered table-striped table-scalable">
        						<thead>
        							<tr>
        								<th>No</th>
        								<th>Brand</th>
        								<th>Kode Barang</th>
        								<th>Nama Barang</th>
        								<th>Karton</th>
        								<th>Pcs</th>
        								<th>Total Keseluruhan</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1; ?>
        							<?php foreach ($detail as $d) { ?>
        								<?php // $barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row(); 
										?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $d->grup; ?></td>
        									<td><?php echo $d->kode_barang; ?></td>
        									<td><?php echo $d->nama_barang; ?></td>
        									<td><?php echo floor((int)$d->qty / (int)$d->isi); ?></td>
        									<td><?php if ((int)$d->qty >= (int)$d->isi) {
													echo (int)$d->qty % (int)$d->isi;
												} else {
													echo $d->qty;
												} ?>
        									</td>
        									<td><?php echo $d->qty; ?> pcs</td>
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