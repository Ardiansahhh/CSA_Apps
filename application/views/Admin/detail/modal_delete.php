<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-<?php echo $sl->kode; ?>">
  <i class="fa fa-trash-o"></i> Hapus
</button>
<div class="modal modal-danger fade" id="delete-<?php echo $sl->kode; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">HAPUS DATA SALESMAN / MD</h4>
      </div>
      <div class="modal-body">
        <div class="callout callout-danger">
          <h4>Peringatan!!</h4>
            Yakin ingin menghapus data guru <?php echo $sl->nama; ?> ? <br>
            DATA YANG SUDAH DIHAPUS TIDAK DAPAT DIKEMBALIKAN !!
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i>Batal</button>
        <a href="<?php echo base_url('Salesman/delete/'.$sl->kode); ?>" class="btn btn-outline"><i class="fa fa-trash-o"></i>&nbspYa, Hapus data ini</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
