        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                <a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button></a>
                <!-- <a href="<?php // echo base_url('Main/reset/'); ?>" class="btn btn-danger">Reset Data</a> -->
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Wilayah</th>
                            <th>Pengelompokkan Wilayah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_wilayah as $dw) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $dw->kode_ruang; ?></td>
                           <td><?php echo $dw->nama_wilayah; ?></td>
                           <td>
                           <?php include('modal_edit.php'); ?>
                           <a href="<?php echo base_url('Area/input_toko/'.$dw->kode_ruang) ?>" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Tentukan toko</a>
                           <a href="<?php echo base_url('Area/detail_toko/'.$dw->kode_ruang); ?>" <?php $is_null = $this->db->query("SELECT * FROM tb_customer WHERE ruang_lingkup = '$dw->kode_ruang' LIMIT 1")->row(); ?> <?php if($is_null->id_kab == NULL) { ?> class="btn btn-danger btn-xs" <?php } else { ?> class="btn btn-info btn-xs" <?php } ?>> <i class="fa fa-search"></i> Detail Toko (<?php echo count($this->db->query("SELECT * FROM tb_customer WHERE ruang_lingkup = '$dw->kode_ruang'")->result()); ?>)</a>
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

      <?php include('modal_add.php'); ?>