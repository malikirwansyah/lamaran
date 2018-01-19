
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/user_access/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>adminb3/user_access/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kduser_access" value="<?php echo $edit->kduser_access?>">


  <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                <select name="status" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->status?>"><?php echo $st_status[($edit->status)];?></option>
                <option value="1">Active</option>
                <option value="0">Not Active</option>
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

 