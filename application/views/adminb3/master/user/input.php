
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/user/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>adminb3/user/simpan" class="form-horizontal">

<div class="form-group">
    <label class="col-sm-2 control-label">Username</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" required name="username">
    </div>
    <label class="col-sm-2 control-label">Password</label>
    <div class="col-sm-4">
      <input type="password" minlength="5" class="form-control" required name="password">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Group User</label>
      <div class="col-sm-4">
         <select name="kdgroup_user" required class="select2 " style="width: 100%;">
           <option value="">--pilih--</option>
                    <?php
                  foreach($dt_group->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdgroup_user']; ?>"><?php echo $sp['group_user']; ?></option>
                <?php
                  }
                  ?>
            </select>
      </div>

       <label class="col-sm-2 control-label">Nama Lengkap</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" required name="nama_lengkap">
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

 