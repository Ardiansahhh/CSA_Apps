<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Data Barang</h4>
					</div>
					<div class="modal-body">
					<form action="<?php echo base_url('Form_urgent/tambah_detail/'); ?>" method="POST">
					<div class="callout callout-default">
					<div class="form-group">
							<label>No. Pesanan</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="no_pesanan"  autocomplete="off" value="<?php echo $no_pesanan; ?>"  class="form-control" required readonly="off" />
							</div>
						</div> 
						<div class="form-group">
			               <label>Nama Barang</label>
			                <select class="form-control select2" name="kode" style="width: 100%;">
			                	<?php $barang = $this->db->query("SELECT * FROM barang")->result(); ?>
			                  <?php foreach ($barang as $b) { ?>
			                  <option value="<?php echo $b->kode_barang; ?>"> ( <?php echo $b->kode_barang; ?> ) <?php echo $b->nama_barang; ?></option>
			                  <?php } ?>
			                </select>
			              </div>
						<div class="form-group">
							<label>Jumlah Karton</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="ctn"  autocomplete="off" type="number"  class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label>Pcs</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="pcs"  autocomplete="off" type="number"  class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label>Extra</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="ext"  autocomplete="off" type="number"  class="form-control"/>
							</div>
						</div>
						<div class="form-group">
							<label>Diskon dalam satuan %</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="disc"  autocomplete="off" type="number"  class="form-control"/>
							</div>
						</div>
					<button type="submit" name="tambah" class="btn btn-success pull-right"><i class="fa fa-send"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>