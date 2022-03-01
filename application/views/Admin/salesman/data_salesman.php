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
                  <br></br>
				  <table id="data" class="table table-bordered table-striped table-scalable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Salesman</th>
                            <th>No.Telp</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                  <?php foreach($salesman as $sl) { ?>
                        <tr>
                           <td><?php echo $no; ?></td>
                           <td><?php echo $sl->nama; ?></td>
                           <td><?php echo $sl->no_telp; ?></td>
                           <td><?php include('modal_edit.php'); ?></td>
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