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
                            <th>Kode Kabupaten</th>
                            <th>Nama Kabupaten</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_kab as $dk) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $dk->id_kab; ?></td>
                           <td><?php echo $dk->nama; ?></td>
                           <td>
                           <?php include('modal_edit_kab.php'); ?>
                           <a href="<?php echo base_url('Kabupaten/detail_toko/'.$dk->id_kab); ?>" class="btn btn-danger btn-xs"> <i class="fa fa-search"></i> Detail Toko (<?php echo count($this->db->query("SELECT * FROM tb_customer WHERE id_kab = '$dk->id_kab'")->result()); ?>)</a>
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
      <?php include('modal_add_kab.php'); ?>