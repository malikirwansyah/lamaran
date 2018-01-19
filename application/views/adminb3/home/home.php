
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

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
            

             
             
            

            </div>
            <!-- /.box-header -->
            <div class="box-body">

<div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3> <b> <span id="load_total"><?=$total ?></span> Total Data</b></h3>

              <p> <b>Need Proses</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="<?php echo base_url(); ?>adminb3/job_request/" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3> <b> <span id="load_sekarang"><?=$sekarang ?></span> Data</b></h3>

              <p><b>Need Proses</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="<?php echo base_url(); ?>adminb3/job_request/" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
            
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

 
<script>
setInterval(function(){
$("#load_total").load('<?=base_url()?>adminb3/home/home/load_total')
}, 100000);

setInterval(function(){
$("#load_sekarang").load('<?=base_url()?>adminb3/home/home/load_sekarang')
}, 100000);


</script>