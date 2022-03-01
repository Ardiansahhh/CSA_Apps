        <!-- Main content -->
        <section class="content">
        <a href="<?php echo base_url('Area/') ?>" class="btn btn-success pull-left"><i class="fa fa-reply"></i> Kembali</a>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="<?php echo base_url('Kabupaten/all_area/'.$kode_ruang) ?>" method="POST">
                    <div class="input-group input-group-sm">
                        <select name="kode_kab" class="form-control">
                            <?php foreach($data_kab as $dk) { ?>
                            <?php $get_area = $this->db->query("SELECT * FROM tb_customer WHERE ruang_lingkup = '$kode_ruang' LIMIT 1")->row(); ?>
                            <option <?php if($get_area->id_kab == $dk->id_kab) { echo 'selected'; ?> value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
                            <?php } } ?>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" name="filter" class="btn btn-info btn-flat">Pilih</button>
                        </span>
                    </div>
                </form><br>
				        <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Toko</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                            <th>Wilayah</th>
                            <th>Kabupaten</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_cust as $dc) { 
                    $data = $this->db->query("SELECT * FROM kabupaten WHERE id_kab = '$dc->id_kab'")->row();
                    ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $dc->kode_toko; ?></td>
                           <td><?php echo $dc->nama_toko; ?></td>
                           <td><?php echo $dc->alamat; ?></td>
                           <td><?php echo $dc->nama_wilayah; ?></td>
                           <td><?php if($dc->id_kab == NULL) { echo 'belum disetting'; } else { echo $data->nama; } ?></td>
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