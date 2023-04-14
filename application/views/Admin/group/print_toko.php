        <!-- Main content -->
        <section class="content">
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="box">
        				<div class="box-body">
        					<?php echo 'NO POLISI : ' . $no_polisi; ?><br>
        					<?php echo 'KUBIKASI : ' . (int)$kubikasi->kubikasi / 1000000; ?><br>
        					<!-- <h5><b>Catatan : Antar punya Aphin kode customer 000019, supaya barang lain bisa masuk</b></h5> -->
        					<table id="data" class="table table-bordered table-striped table-scalable">
        						<thead>
        							<tr>
        								<th>No</th>
        								<th>No.Sales Order</th>
        								<th>Tanggal Rilis</th>
        								<th>Kode Toko</th>
        								<th>Nama Toko</th>
        								<th>Kubikasi</th>
        								<th>Alamat</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1; ?>
        							<?php foreach ($data as $d) { ?>
        								<?php
										$sales = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
										$ruang = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$d->ruang_lingkup'")->row();
										$alt = $this->db->query("SELECT * FROM tb_customer WHERE tb_customer.kode_toko = '$d->kode_toko'")->row();
										?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $d->no_sales_order; ?></td>
        									<td><?php echo $sales->tanggal_rilis; ?></td>
        									<td><?php echo $d->kode_toko; ?></td>
        									<td><?php echo $alt->nama_toko; ?></td>
        									<td><?php echo (int)$d->KUBIKASI / 1000000; ?></td>
        									<td><?php echo $ruang->nama_wilayah; ?></td>
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