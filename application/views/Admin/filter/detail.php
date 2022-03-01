        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php if($this->session->flashdata('flash')) { echo $this->session->flashdata('flash'); } ?>
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
                            <th>Wilayah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($data_cust as $dc) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $dc->kode_toko; ?></td>
                           <td><?php echo $dc->no_aco; ?></td>
                           <td><?php echo $dc->nama_toko; ?></td>
                           <td><?php echo $dc->alamat; ?></td>
                           <td><?php echo $dc->nama_wilayah; ?></td>
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