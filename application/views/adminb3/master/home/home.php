
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
<br><br>
            <div class=" pull-left">
             <a class="btn btn-danger pull-left" href="<?php echo base_url(); ?>super/user/input"><i class="fa fa-trash"></i>  Bulk Delete</a>
            </div>

             <div class="box-tools pull-right">
             <a class="btn btn-default pull-right" href="<?php echo base_url(); ?>super/user/input"><i class="fa fa-plus"></i> Add <?php echo $judul; ?></a>
            </div>

            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
 <?php if($this->session->flashdata('save_user')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_user'); ?>
  </div>
  <?php } ?>
             
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

 