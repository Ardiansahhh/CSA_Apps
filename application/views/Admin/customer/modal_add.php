<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Guru</h4>
					</div>
					<div class="modal-body">
					<form action="<?php echo base_url('Main/tambah_toko/'); ?>" method="POST">
					<div class="callout callout-default"> 
						<div class="form-group">
							<label>Kode Toko</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="kode_toko"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<label>Nama Toko</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="nama_toko"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="alamat"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
						   <label>Ruang Lingkup</label>
							<select name="ruang_lingkup" class="form-control">
								<?php foreach($lingkup as $l) { ?>
								<option value="<?php echo $l->kode_ruang; ?>"><?php echo $l->nama_wilayah; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
						   <label>Kabupaten</label>
							<select name="id_kab" class="form-control">
								<?php foreach($data_kab as $dk) { ?>
								<option value="<?php echo $dk->id_kab; ?>"><?php echo $dk->nama; ?></option>
								<?php } ?>
							</select>
						</div>
					<button type="submit" name="tambah_toko" class="btn btn-success pull-right"><i class="fa fa-send"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>