
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
             <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>adminb3/loker/input"><i class="fa fa-plus"></i> Add <?php echo $judul; ?></a>
            </div>

            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
 <?php if($this->session->flashdata('save_loker')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_loker'); ?>
  </div>
  <?php } ?>
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No</th>
                <th>Kategori</th>
                  <th>loker</th>
                  <th>ket</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
  <?php
    $no=0+1;
    foreach($dt_loker->result() as $dp)
    {
  ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo ($dp->kategoriloker); ?></td>
    <td><?php echo ($dp->loker); ?></td>
    <td><?php echo ($dp->ket); ?></td>
    <td><?php echo ($dp->tgl_awal); ?></td>
    <td><?php echo ($dp->tgl_akhir); ?></td>
    <td><?php echo $st[($dp->status)]; ?></td>
    <td>
      <a title="Edit Data"  href="<?php echo base_url(); ?>adminb3/loker/edit/<?php echo ($dp->kdloker); ?>" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-edit'></i></a> 
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

 