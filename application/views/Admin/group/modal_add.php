<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data</h4>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('Group/tambah/'); ?>" method="POST">
					<div class="callout callout-default">
						<div class="form-group">
							<label>Pilih Kendaraan</label>
							<select name="no_polisi" class="form-control">
								<option value="B9694CL">B 9694 CL</option>
								<option value="B9740CXS">B 9740 CXS</option>
								<option value="BN8640PR">BN 8640 PR</option>
								<option value="BN8683PR">BN 8683 PR</option>
								<option value="BN8683PR">BN 8361 PR</option>
								<option value="B2840PFE">B 2840 PFE</option>
								<option value="3CYCLE">3 CYCLE</option>
								<option value="ON-CALL">ON CALL</option>
							</select>
						</div>
						<button type="submit" name="tambah" class="btn btn-success pull-right"><i class="fa fa-send"></i> Tambah</button>
				</form>
			</div>
		</div>
	</div>
</div>
