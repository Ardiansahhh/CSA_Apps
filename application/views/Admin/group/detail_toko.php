        <!-- Main content -->
        <section class="content">
        	<div class="row">
        		<div class="col-xs-12">
        			<div class="box">
        				<div class="box-header">
        					<?php // if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } 
							?>

        					<a href="<?php echo base_url('Group/print_toko/' . $no_polisi) ?>" class="btn btn-success"><i class="fa fa-print"></i> Print Toko</a><br>
        				</div><!-- /.box-header -->
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
        								<th>Kubikasi</th>
        								<th>Action</th>
        							</tr>
        						</thead>
        						<tbody>
        							<?php $no = 1; ?>
        							<?php foreach ($data as $d) { ?>
        								<?php
										$sales = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
										$data = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$d->no_sales_order'")->result();
										$detail = count($data);
										$detail = count($data);
										$ruang = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$d->ruang_lingkup'")->row();
										$alt = $this->db->query("SELECT * FROM tb_customer WHERE tb_customer.kode_toko = '$d->kode_toko'")->row();
										$total = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM detail_item_undelivery WHERE no_sales_order = '$d->no_sales_order'")->row();
										?>
        								<tr>
        									<td><?php echo $no; ?></td>
        									<td><?php echo $d->no_sales_order; ?></td>
        									<td><?php echo $sales->tanggal_rilis; ?></td>
        									<td><?php echo $d->kode_toko; ?></td>
        									<td><?php echo $alt->nama_toko; ?></td>
        									<td><?php echo $alt->alamat; ?></td>
        									<td><?php echo (int)$total->kubik / 1000000; ?></td>
        									<td>
        										<a href="<?php echo base_url('Group/itemDetail/' . $d->no_sales_order); ?>" class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Detail
        											Order <?php echo $detail; ?></a>
        										<form action="<?php echo base_url('Group/delete') ?>" method="post">
        											<input type="hidden" name="no_sales_order" value="<?php echo $d->no_sales_order; ?>">
        											<button type="submit" name="delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>
        										</form>
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
