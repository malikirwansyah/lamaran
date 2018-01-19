
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/kecamatan/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>adminb3/kecamatan/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kdkecamatan" value="<?php echo $edit->kdkecamatan?>">
 <div class="form-group">
                <label class="col-sm-2 control-label">Provinsi</label>
                <div class="col-sm-4">
                <select required name="kdprovinsi" class="select2" style="width: 100%;" id="provinsi">
                <option value="<?php echo $edit->kdprovinsi?>"><?php echo $edit->provinsi?></option>
                    <?php
                  foreach($dt_provinsi->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdprovinsi']; ?>"><?php echo $sp['provinsi']; ?> </option>
                <?php
                  }
                  ?>
                </select>
                </div>
  </div>
    <div class="form-group">
                <label class="col-sm-2 control-label">Kabupaten/Kota</label>
                <div class="col-sm-4">
                <select required name="kdkabupaten" class="select2" style="width: 100%;" id="kabupaten">
               <option value="<?php echo $edit->kdkabupaten?>"><?php echo $edit->kabupaten?></option>
                </select>
                </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nama kecamatan</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="kecamatan"  value="<?php echo $edit->kecamatan?>">
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

 