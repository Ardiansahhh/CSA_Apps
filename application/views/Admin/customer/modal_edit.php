<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ubah-<?php echo $dc->kode_toko; ?>">
  <i class="fa fa-edit"></i> Edit
</button>
<div class="modal modal-default fade" id="ubah-<?php echo $dc->kode_toko; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Edit Data Pelanggan</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Main/edit_customer/'.$dc->kode_toko); ?>" method="POST">
		  <div class="callout callout-default">
			<div class="form-group">
				<label>Kode Toko</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="kode_toko" type="text" value="<?php echo $dc->kode_toko; ?>" class="form-control" required readonly/>
				</div>
			</div>
      <div class="form-group">
				<label>Nama Toko</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="nama_toko" type="text" value="<?php echo $dc->nama_toko; ?>" class="form-control" required/>
				</div>
			</div>
            <div class="form-group">
				<label>Alamat</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
          <input name="alamat" type="text" value="<?php echo $dc->alamat; ?>" class="form-control" required/>
				</div>
			</div>
            <div class="form-group">
                <label>Ruang Lingkup</label>
                <select name="ruang_lingkup" class="form-control">
                    <?php foreach($lingkup as $l) { ?>
                    <option <?php if($dc->ruang_lingkup == $l->kode_ruang) { echo 'selected'; ?> value="<?php echo $l->kode_ruang; ?>"><?php echo $l->nama_wilayah; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $l->kode_ruang; ?>"><?php echo $l->nama_wilayah; ?></option>
                    <?php } } ?>
                </select>
            </div>
						<div class="form-group">
							<label>Geotag</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-id-card"></i>
								</div>
									<input name="geotag" type="text" value="<?php echo $dc->geotag; ?>" class="form-control"/>
							</div>
						</div>
            <div class="form-group">
                <label>
                  kabupaten
                </label>
                <select name="id_kab" class="form-control">
                    <?php foreach($data_kab as $dk) { ?>
                    <option <?php if($dc->id_kab == $dk->id_kab) { echo 'selected'; ?> value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
                    <?php } } ?>
                </select>
            </div>
			<button type="submit" name="edittoko" class="btn btn-success pull-right"><i class="fa fa-send"></i> Ubah</button>
	      </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
