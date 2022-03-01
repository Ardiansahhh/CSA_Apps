        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
				<div class="btn btn-success"><?php echo $wilayah; ?></div>
                
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pilih</th>
                            <th>Kode Toko</th>
                            <th>Nama Toko</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_cust as $dc) { ?>
                <form action="<?php echo base_url('Area/pilih/'.$kode_ruang) ?>" method="POST">
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><input type="checkbox" value="<?php echo $dc->kode_toko ?>" name="kode_toko[]"></td>
                    <td><?php echo $dc->kode_toko; ?></td>
                    <td><?php echo $dc->nama_toko; ?></td>
                    <td><?php echo $dc->alamat; ?></td>
                </tr>
                  <?php $no++; ?>
                  <?php } ?>
                    </tbody>                  
                </table><br>
                <button type="submit" name="data" class="btn btn-success"><i class="fa fa-plus"></i> Tambahkan Data</button>
                </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </section>

    