
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/user_regis/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>adminb3/user_regis/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kduser_regis" value="<?php echo $edit->kduser_regis?>">
  <div class="form-group">
    <label class="col-sm-2 control-label">No KTP </label>
    <div class="col-sm-4">
      <input required type="text" name="noktp" class="form-control" value="<?php echo $edit->noktp?>">
    </div>
    <label class="col-sm-2 control-label">Password </label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="password" value="<?php echo $edit->password?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama </label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="nama_lengkap" value="<?php echo $edit->nama_lengkap?>">
    </div>
    <label class="col-sm-2 control-label">Email </label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="email" value="<?php echo $edit->email?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Active </label>
    <div class="col-sm-4">
      <select name="active" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->active?>"><?php echo $st_active[($edit->active)];?></option>
                <option value="1">Active</option>
                <option value="0">Banned</option>
                </select>
    </div>
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-4">
      <select name="status_kode" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->status_kode?>"><?php echo $st[($edit->status_kode)];?></option>
                <option value="1">Active</option>
                <option value="0">Not Verify</option>
      </select>
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

 