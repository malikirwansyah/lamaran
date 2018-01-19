
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>master/kelompokbarang/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>master/kelompokbarang/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="idkelompokbarang" value="<?php echo $edit->idkelompokbarang?>">

   <div class="form-group">
    <label class="col-sm-2 control-label">Kode kelompokbarang</label>
    <div class="col-sm-2">
      <input type="number" readonly class="form-control" required  name="kdkelompokbarang" value="<?php echo $edit->kdkelompokbarang?>">
    </div>
  </div>
 <div class="form-group">
    <label class="col-sm-2 control-label">Kategori Umum</label>
    <div class="col-sm-8">
      <select name="idk_umum" required class="select2 " style="width: 100%;" id='umum'>
           <option value="<?php echo $edit->idk_umum?>"><?php echo $edit->k_umum?></option>
           
                    <?php
                  foreach($dtk_umum->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['idk_umum']; ?>"><?php echo $sp['k_umum']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Barang</label>
    <div class="col-sm-8" >
       <select name="idk_barang" required class="select2 " style="width: 100%;" id='kategori'>
           <option value="<?php echo $edit->idk_barang?>"><?php echo $edit->k_barang?></option>
           
            </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">kelompok barang</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="kelompokbarang" value="<?php echo $edit->kelompokbarang?>">
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

 