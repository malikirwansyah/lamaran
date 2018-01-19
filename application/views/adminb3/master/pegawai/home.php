
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
             <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>master/pegawai/input"><i class="fa fa-plus"></i> Add <?php echo $judul; ?></a>
            </div>

            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
 <?php if($this->session->flashdata('save_pegawai')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_pegawai'); ?>
  </div>
  <?php } ?>
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No</th>
                  <th>Nama</th>
                  <th>npp</th>
                  <th>jk</th>
                  <th>unit</th>
                  <th>golongan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
  <?php
    $no=0+1;
    foreach($dt_pegawai->result() as $dp)
    {
  ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo ($dp->pegawai); ?></td>
    <td><?php echo ($dp->npp); ?></td>
    <td><?php echo ($dp->jk); ?></td>
    <td><?php echo ($dp->unit); ?></td>
    <td><?php echo ($dp->golongan); ?></td>
    <td>
      <a title="Edit Data"  href="<?php echo base_url(); ?>master/pegawai/edit/<?php echo ($dp->kdpegawai); ?>" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-edit'></i></a>
      <a title="view Data"  href="<?php echo base_url(); ?>master/pegawai/view/<?php echo ($dp->kdpegawai); ?>" class='btn btn-warning btn-sm btn-flat'> <i class='fa fa-eye'></i></a>  
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

 