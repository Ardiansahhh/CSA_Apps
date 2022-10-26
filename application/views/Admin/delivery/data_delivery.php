        <!-- Main content -->
        <section class="content">
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="box">
        				<div class="box-header">
        					<?php // if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } 
							?>

        				</div><!-- /.box-header -->
        				<div class="box-body">
        					<?php // if ($data == NULL) { 
							?>
        					<a href="#"><button class="btn btn-info" type="button" data-target="#Modalcsv" data-toggle="modal"><i class="fa fa-file"></i> Import Master Input</button></a>
        					<?php // } 
							?>
        					<?php if ($data != NULL) { ?>
        						<a href="<?php echo base_url("UnDelivery/delt/") ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus Data</a>
        						<a href="<?php echo base_url('UnDelivery/cluster/') ?>" class="btn btn-success"><i class="fa fa-cubes"></i> Kelompokkan Area</a> &nbsp;
        					<?php } ?>
        					<br></br>
        					<table id="data" class="table table-bordered table-striped table-scalable">
        						<thead>
        							<tr>
        								<th>No</th>
        								<th>No.Sales Order</th>
        								<th>Tanggal Rilis</th>
        								<th>Kode Toko</th>
        								<th>Nama Toko</th>
        								<th>Ruang Lingkup</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1; ?>
        							<?php foreach ($data as $d) { ?>
        								<?php $toko = $this->db->query("SELECT * FROM undelivery INNER JOIN tb_ruang_lingkup ON undelivery.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_ruang_lingkup.kode_ruang = '$d->ruang_lingkup'")->row();
										$alt = $this->db->query("SELECT * FROM tb_customer WHERE tb_customer.kode_toko = '$d->kode_toko'")->row();
										?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $d->no_sales_order; ?></td>
        									<td><?php echo $d->tanggal_rilis; ?></td>
        									<td><?php echo $d->kode_toko; ?></td>
        									<td><?php echo $d->nama_toko; ?></td>
        									<td><?php echo $toko->nama_wilayah ?></td>
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
