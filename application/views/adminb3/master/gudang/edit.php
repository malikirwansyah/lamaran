
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>master/gudang/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>master/gudang/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kdgudang" value="<?php echo $edit->kdgudang?>">
     <div class="form-group">
    <label class="col-sm-2 control-label">Lantai</label>
    <div class="col-sm-8">
      <select name="kdlantai" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdlantai?>"><?php echo $edit->lantai?></option>
           
                    <?php
                  foreach($dt_lantai->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdlantai']; ?>"><?php echo $sp['lantai']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">gudang</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" required name="gudang" value="<?php echo $edit->gudang?>">
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

 