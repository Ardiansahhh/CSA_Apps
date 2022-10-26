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
                            <th>Ruang Lingkup</th>
							              <th>Kubikasi</th>
														<th>Bruto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                  <?php $no = 1; $kubikasi = 0; ?>
                  <?php foreach($data_filter as $df) { 
				          $kubik = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM kubikasi_ctn WHERE ruang_lingkup = '$df->ruang_lingkup'")->row(); 
									$bruto = $this->db->query("SELECT SUM(harga) AS price FROM detail_item_undelivery WHERE ruang_lingkup = '$df->ruang_lingkup'")->row();
									?>			
									
                  <?php 
                    $data = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$df->ruang_lingkup'")->row(); 
                    $konsumen = $this->db->query("SELECT * FROM tb_customer INNER JOIN kabupaten ON tb_customer.id_kab = kabupaten.id_kab WHERE ruang_lingkup = '$df->ruang_lingkup'")->row();
                    $jumlah = count($this->db->query("SELECT * FROM undelivery WHERE ruang_lingkup = '$df->ruang_lingkup'")->result());
									$check_area = count($this->db->query("SELECT * FROM undelivery WHERE ruang_lingkup = '$df->ruang_lingkup'")->result());
									$check_group_area = count($this->db->query("SELECT * FROM detail_group_area WHERE ruang_lingkup = '$df->ruang_lingkup'")->result());
                  ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->nama_wilayah; ?></td>
					          <td><?php echo (int)$kubik->kubik / 1000000; ?></td>
										<td><?php echo 'Rp ' . number_format($bruto->price,'0',',','.'); ?></td>
                    <td><a href="<?php echo base_url('Group/detail_toko/'.$df->ruang_lingkup . '/' . $no_polisi); ?>" class="btn btn-info d-inline"><i class="fa fa-search"></i> Detail Toko (<?php echo $jumlah; ?>)</a>
					<?php if($check_group_area < $check_area) { ?>
						<a href="<?php echo base_url('Group/tambah_toko/'.$df->ruang_lingkup . '/' . $no_polisi); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
						<?php } else { echo '';} ?>
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

    