<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ubah-<?php echo $dk->id_kab; ?>">
  <i class="fa fa-edit"></i> Edit
</button>
<div class="modal modal-default fade" id="ubah-<?php echo $dk->id_kab; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Edit Data Kabupaten</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Kabupaten/edit_kab/'.$dk->id_kab); ?>" method="POST">
		  <div class="callout callout-default">
			<div class="form-group">
				<label>ID Kabupaten</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="id_kab" type="text" value="<?php echo $dk->id_kab; ?>" class="form-control" readonly required/>
				</div>
			</div>
            <div class="form-group">
				<label>Nama</label>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-id-card"></i>
					</div>
						<input name="nama" type="text" value="<?php echo $dk->nama; ?>" class="form-control" required/>
				</div>
			</div>
			<button type="submit" name="editdata" class="btn btn-success pull-right"><i class="fa fa-send"></i> Ubah</button>
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
