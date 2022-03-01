<div id="Modalcsv" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Import CSV</h4>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url('Barang/csv') ?>" name="modal_popup" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Pilih file CSV</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-id-card"></i>
										</div>
										<input name="csv" type="file" accept=".csv" class="form-control" required/>
									</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-success" name="import" type="submit">
									Tambah
								</button>
								<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
									Batal
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>