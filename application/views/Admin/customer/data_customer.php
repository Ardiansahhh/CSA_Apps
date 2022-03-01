        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                <form action="<?php echo base_url('Main/cari_toko/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Cari Toko berdasarkan kode Toko" name="kode_toko" autocomplete="off" autofocus>
                        <span class="input-group-btn">
                        <button type="submit" name="data" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                <form action="<?php echo base_url('Main/filter_customer/') ?>" method="POST">
                    <div class="input-group input-group-sm">
                        <select name="kode_ruang" class="form-control">
                            <?php foreach($data_filter as $l) { ?>
                            <option value="<?php echo $l->kode_ruang; ?>"><?php echo $l->nama_wilayah; ?></option>
                            <?php } ?>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" name="filter" class="btn btn-info btn-flat">Go!</button>
                        </span>
                    </div>
                </form> <br>
                </div><!-- /.box-header -->
                <div class="box-body">
				<a href="#"><button class="btn btn-success" type="button" data-target="#ModalAdd" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button></a>
                <a href="#"><button class="btn btn-info" type="button" data-target="#Modalcsv" data-toggle="modal"><i class="fa fa-file"></i> Import CSV</button></a>
                <!-- <a href="<?php // echo base_url("Main/delt_cust/") ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus Customer</a> -->
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Toko</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                            <th>Wilayah</th>
                            <th>Setting Disc</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_cust as $dc) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $dc->kode_toko; ?></td>
                           <td><?php echo $dc->nama_toko; ?></td>
                           <td><?php echo $dc->alamat; ?></td>
                           <td><?php echo $dc->nama_wilayah; ?></td>
                           <td><?php echo $dc->setting_disc; ?></td>
                           <td><?php include('modal_edit.php'); ?>
                            <?php if($dc->setting_disc == 'No') { ?>
                             <a href="<?php echo base_url('Main/settingDisc/'.$dc->kode_toko); ?>" class="btn btn-info btn-xs"><i class="fa fa-money"></i> Setting Disc</a>
                           <?php } else { ?>
                            <a href="<?php echo base_url('Main/noDisc/'.$dc->kode_toko); ?>" class="btn btn-danger btn-xs"><i class="fa fa-money"></i> No Disc</a>
                          <?php } ?>
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
    <?php include('modal_csv.php'); ?>
    <?php include('modal_add.php'); ?>