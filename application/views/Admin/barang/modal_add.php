<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>
					<div class="modal-body">
					<form action="<?php echo base_url('Barang/tambah_barang/'); ?>" method="POST">
					<div class="callout callout-default"> 
						<div class="form-group">
							<label>Kode Barang</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="kode_barang"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="nama_barang"  autocomplete="off" type="text"  class="form-control" required/>
							</div>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="harga" autocomplete="off" type="number"  class="form-control" required/>
							</div>
						</div>
                        <div class="form-group">
                        <label>Group</label>
                        <select name="grup" class="form-control">
							<option value="P&G">P&G</option>
                            <option value="SUTRA">SUTRA</option>
                            <option value="FIESTA">FIESTA</option>
                            <option value="HEALTH SUPLEMENT">HEALTH SUPLEMENT</option>
                            <option value="MAKE UP">MAKE UP</option>
                            <option value="JOLLY">JOLLY</option>
                            <option value="PASEO">PASEO</option>
                            <option value="NICE">NICE</option>
                            <option value="TOPLY">TOPLY</option>
                            <option value="HYPER">HYPER</option>
                            <option value="INDOMARET">INDOMARET</option>
                            <option value="DUALIMA INDUSTRIES">DUALIMA INDUSTRIES</option>
                        </select>
                        </div>
                        <div class="form-group">
							<label>ISI</label>
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								<input name="isi" autocomplete="off" type="number" class="form-control" required/>
							</div>
						</div>
					<button type="submit" name="tambah_barang" class="btn btn-success pull-right"><i class="fa fa-send"></i> Simpan</button>
			
				</form>
			</div>
		</div>
	</div>
</div>
