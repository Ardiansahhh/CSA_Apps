<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete-<?php echo $guru->id_urut_guru; ?>">
  <i class="fa fa-trash-o"></i> Hapus
</button>
<div class="modal modal-danger fade" id="delete-<?php echo $guru->id_urut_guru; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">HAPUS DATA GURU</h4>
      </div>
      <div class="modal-body">
        <div class="callout callout-danger">
          <h4>Peringatan!!</h4>
            Yakin ingin menghapus data guru <?php echo $guru->nama_guru; ?> ? <br>
            DATA YANG SUDAH DIHAPUS TIDAK DAPAT DIKEMBALIKAN !!
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i>Batal</button>
        <a href="<?php echo base_url('Admin/Guru/delete/'.$guru->id_urut_guru); ?>" class="btn btn-outline"><i class="fa fa-trash-o"></i>&nbspYa, Hapus data ini</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
