
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>user/pengalaman/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">


          <!-- TO DO List -->
          <div class="box box-danger">
           
            <!-- /.box-header -->
            <div class="box-body">

<form method="post" action="<?php echo base_url(); ?>user/pengalaman/edit" class="form-horizontal">
  <input required type="hidden" class="form-control" name="kduser_pengalaman" value="<?php echo $edit->kduser_pengalaman?>">
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama perusahaan</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="nm_perusahaan" value="<?php echo $edit->nm_perusahaan?>">
    </div>
    <label class="col-sm-2 control-label">Jabatan</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="jabatan" value="<?php echo $edit->jabatan?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Start</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_awal" value="<?php echo $edit->tgl_awal?>">
    </div>
    <label class="col-sm-2 control-label">End</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_akhir" value="<?php echo $edit->tgl_akhir?>">
    </div>
  </div>
  <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="submit" class="btn btn-danger" name="submit"> <i class="fa fa-plus"></i>  Save
                  </button>
                </div>
              </div>
</form>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->


        </section>

      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 