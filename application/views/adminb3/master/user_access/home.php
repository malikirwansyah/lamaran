
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?php echo $judul; ?>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">


          <!-- TO DO List -->
          <div class="box box-danger">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title"> <?php echo $judul; ?> </h3>
             <div class="box-tools pull-right">
             <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>adminb3/user_access/input"><i class="fa fa-plus"></i> Add <?php echo $judul; ?></a>
            </div>

            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
 <?php if($this->session->flashdata('save_user_access')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_user_access'); ?>
  </div>
  <?php } ?>
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No</th>
                <th>Group user</th>
                <th>access menu</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
  <?php
    $no=0+1;
    foreach($dt_user_access->result() as $dp)
    {
  ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo ($dp->group_user); ?></td>
    <td><?php echo ($dp->menu_name); ?></td>
    <td>
      <?php if (($dp->status)==1): ?>
        <small class="label bg-green"><?php echo $st_status[($dp->status)]; ?></small>
     <?php elseif (($dp->status)==0): ?>
      <small class="label bg-red"><?php echo $st_status[($dp->status)]; ?></small>
      <?php endif; ?>
      
    </td>
    <td>
      <a title="Edit Data"  href="<?php echo base_url(); ?>adminb3/user_access/edit/<?php echo ($dp->kduser_access); ?>" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-edit'></i></a> 
    </td>
    </tr>
   <?php
      $no++;
    }
   ?>
  </tbody>
                
              </table>
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

 