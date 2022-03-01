        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                <form action="<?php echo base_url('Filter/input_data_filter') ?>" method="POST">
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Masukkan Kode Toko" name="kode_toko" autocomplete="off" autofocus>
                        <span class="input-group-btn">
                        <button type="submit" name="data" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                <form action="<?php echo base_url('Filter/input_data_ganda/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Masukkan Kode Toko Ganda" name="kode_toko" autocomplete="off" autofocus>
                        <span class="input-group-btn">
                        <button type="submit" name="ganda" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                <form action="<?php echo base_url('Filter/filter_wilayah/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                        <select name="kode_ruang" class="form-control">
                            <?php foreach($lingkup as $l) { ?>
                            <option value="<?php echo $l->kode_ruang; ?>"><?php echo $l->nama_wilayah; ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" name="filter" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                <form action="<?php echo base_url('Filter/input_aco/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Kode ACO" name="no_aco" autocomplete="off">
                        <span class="input-group-btn">
                        <button type="submit" name="btn_aco" class="btn btn-info btn-flat">Create ACO</button>
                        </span>
                    </div>
                </form><br>
                <?php $query = $this->All_model->get_all('tb_filter_data'); ?>
                <?php if($query != NULL) { ?>
                <a href="<?php echo base_url('Filter/cluster/') ?>" class="btn btn-success pull-left"><i class="fa fa-cubes"></i> Kelompokkan Area</a>
                <a href="<?php echo base_url('Filter/delt/') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Bersihkan Data</a>
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
                  
                <tr>
                    <?php $data = $this->db->query("SELECT * FROM tb_filter_data INNER JOIN tb_ruang_lingkup ON tb_filter_data.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_ruang_lingkup.kode_ruang = '$df->ruang_lingkup'")->row(); 
                    $alt = $this->db->query("SELECT alamat FROM tb_customer WHERE tb_customer.kode_toko = '$df->kode_toko'")->row();
                    ?>

                    <td><?php echo $no; ?></td>
                    <td><?php echo $df->kode_toko; ?></td>
                    <td><?php echo $df->no_aco; ?></td>
                    <td><?php echo $df->nama_toko; ?></td>
                    <td><?php echo $alt->alamat; ?></td>
                    <?php if ($data != NULL) { ?>
                    <td><?php echo $data->nama_wilayah; ?></td>
                    <?php } else { ?>
                    <td>Ruang Lingkup Toko Belum Disetting</td>
                    <?php } ?>
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

    