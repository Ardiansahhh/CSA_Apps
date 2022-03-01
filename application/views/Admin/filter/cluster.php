        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                <?php $query = $this->All_model->get_all('tb_filter_data'); ?>
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
                <?php if($query != NULL) { ?>
                <a href="<?php echo base_url('Filter/') ?>" class="btn btn-success pull-left"><i class="fa fa-reply"></i> Kembali</a>
                <a href="<?php echo base_url('Filter/delt/') ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Bersihkan Data</a>
                <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">            
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruang Lingkup</th>
                            <th>Kabupaten</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_filter as $df) { ?>
                  <?php 
                    $data = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$df->ruang_lingkup'")->row(); 
                    $konsumen = $this->db->query("SELECT * FROM tb_customer INNER JOIN kabupaten ON tb_customer.id_kab = kabupaten.id_kab WHERE ruang_lingkup = '$df->ruang_lingkup'")->row();
                    $jumlah = count($this->db->query("SELECT * FROM tb_filter_data WHERE ruang_lingkup = '$df->ruang_lingkup'")->result());
                  ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->nama_wilayah; ?></td>
                    <td><?php echo $konsumen->nama; ?></td>
                    <td><a href="<?php echo base_url('Filter/detail/'.$df->ruang_lingkup); ?>" class="btn btn-info"><i class="fa fa-search"></i> Detail Toko (<?php echo $jumlah; ?>)</a>
                    <a href="<?php echo base_url('Filter/del_cluster/'.$df->ruang_lingkup); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus Detail(<?php echo $jumlah; ?>)</a></td>
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

    