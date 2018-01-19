
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

<form method="post" action="<?php echo base_url(); ?>adminb3/user/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kdlogin" value="<?php echo $edit->kdlogin?>">
 
<div class="form-group">
    <label class="col-sm-2 control-label">Username</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" readonly required name="username" value="<?php echo $edit->username?>">
    </div>
    
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Group User</label>
      <div class="col-sm-4">
         <select name="kdgroup_user" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdgroup_user?>"><?php echo ($edit->group_user);?></option>
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
      <input type="text" class="form-control" required name="nama_lengkap" value="<?php echo $edit->nama_lengkap?>">
    </div>
   <!--  <label class="col-sm-2 control-label">Level User</label>
                <div class="col-sm-4">
                <select required name="level_user" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->level_user?>"><?php echo $st_level[($edit->level_user)];?></option>
                <option value="1">Kepala Staff</option>
                <option value="2">Staff</option>
                </select>
                </div>!--> 
  </div>
     <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                <select name="active" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->active?>"><?php echo $st_active[($edit->active)];?></option>
                <option value="1">Active</option>
                <option value="0">Banned</option>
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

 