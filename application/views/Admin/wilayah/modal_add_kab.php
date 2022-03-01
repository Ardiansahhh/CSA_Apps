<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data Kabupaten</h4>
					</div>
					<div class="modal-body">
					<form action="<?php echo base_url('Kabupaten/tambah/'); ?>" method="POST">
					<div class="callout callout-default"> 
						<div class="form-group">
							<label>Kode Kabupaten</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="id_kab"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
                        </div>
                        <div class="form-group">
							<label>Nama Kabupaten</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="nama"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
					<button type="submit" name="tambah" class="btn btn-success pull-right"><i class="fa fa-send"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>