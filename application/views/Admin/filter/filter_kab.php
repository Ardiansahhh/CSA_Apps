        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                <form action="<?php echo base_url('Filter/all_area/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                        <select name="kode_kab" class="form-control">
                            <?php foreach($data_kab as $dk) { ?>
                            <option value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" name="filter_area" class="btn btn-info btn-flat">Pilih</button>
                        </span>
                    </div>
                </form><br>
                <?php $query = $this->All_model->get_all('tb_filter_data'); ?>
                <?php if($query != NULL) { ?>
                <a href="<?php echo base_url('Filter/cluster/') ?>" class="btn btn-success pull-left"><i class="fa fa-cubes"></i> Kelompokkan Area</a>
                <a href="<?php echo base_url('Filter/delta/'.$id_kab) ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Bersihkan Data</a>
                <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">            
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Toko</th>
                            <th>Kode ACO</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                            <th>Ruang Lingkup</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_filter as $df) { ?>
                  <?php $alamat = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$df->ruang_lingkup'")->row();
                        $toko =  $this->db->query("SELECT * FROM tb_customer WHERE kode_toko = '$df->kode_toko'")->row();
                  ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $df->kode_toko; ?></td>
                    <td><?php echo $df->no_aco; ?></td>
                    <td><?php echo $df->nama_toko; ?></td>
                    <td><?php echo $toko->alamat; ?></td>
                    <td><?php echo $alamat->nama_wilayah; ?></td>
                    <td><a href="<?php echo base_url('Filter/delt_toko/'.$df->no_urut); ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Hapus Toko</a></td>
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

    