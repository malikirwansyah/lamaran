
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/loker/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>adminb3/loker/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kdloker" value="<?php echo $edit->kdloker?>">
  <div class="form-group">
    <label class="col-sm-2 control-label">Kategori Loker </label>  
    <div class="col-sm-4">
       <select name="kdkategoriloker" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdkategoriloker?>"><?php echo $edit->kategoriloker?></option>
           
                    <?php
                  foreach($dt_kategoriloker->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdkategoriloker']; ?>"><?php echo $sp['kategoriloker']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
    <label class="col-sm-2 control-label">Nama loker</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="loker" value="<?php echo $edit->loker?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Ket</label>
    <div class="col-sm-10">
      <textarea required class="form-control ckeditor" name="ket" class="form-control" rows="10">
        <?php echo $edit->ket?>
          
        </textarea>
    </div>
  </div>

  
       <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                <select name="status" class="select2" style="width: 100%;">
                <option value="<?php echo $edit->status?>"><?php echo $st[($edit->status)];?></option>
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

 