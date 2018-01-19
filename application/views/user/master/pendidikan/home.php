 
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
            
            </div>

            

            </div>
            <!-- /.box-header -->
            <div class="box-body">
 <?php if($this->session->flashdata('save_pendidikan')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_pendidikan'); ?>
  </div>
  <?php } ?>

<?php 
 $kdregis=$this->session->userdata('kdregis');
 ?>

<?php if (!$abc=$this->pendidikan_model->cek_kode($kdregis)): ?>
<!-- JIKA DATA KOSONG!-->
<form method="post" action="<?php echo base_url(); ?>user/pendidikan/simpan" class="form-horizontal" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Pendidikan Terakhir </label>  
    <div class="col-sm-4">
       <select name="kdpendidikan" required class="select2 " style="width: 100%;">
           <option value="">--pilih--</option>
           
                    <?php
                  foreach($dt_pendidikan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdpendidikan']; ?>"><?php echo $sp['pendidikan']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
    <label class="col-sm-2 control-label">Nama sekolah/perguruan tinngi </label>
    <div class="col-sm-4">
      <input required type="text" name="nama" class="form-control">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Nilai </label>
   <div class="col-sm-4">
      <input required type="number" name="nilai" class="form-control">
    </div>

    <label class="col-sm-2 control-label">Alamat </label>
    <div class="col-sm-4">
      <textarea class="form-control" name="alamat" rows="4"></textarea>
    </div>
   
  </div>


  <div class="form-group">
    <label class="col-sm-2 control-label">Start</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_awal" >
    </div>
    <label class="col-sm-2 control-label">End</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_akhir" >
    </div>
  </div>



  
   <div class="form-group">
        <label class="col-sm-2 control-label">Ijazah</label>
          <div class="col-sm-8">
          <div class="alert alert-success">  
                    <a class="close" data-dismiss="alert">x</a>  
                    Info! <br/>
                    Ukuran Maksimum file 200 Kb, (disarankan ukuran dibawah 100kb)<br/>
                    File yang diizinkan untuk upload .jpg, .jpeg, .png
          </div>
            

    <div class="fileinput fileinput-new" data-provides="fileinput" >
      <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 100px; "></div>
      <div>
      <span class="btn btn-file btn-default ">
      <input type="file" required name="file1" >
        <span class="fileinput-new"><i class="glyphicon glyphicon-camera"></i> Pilih Gambar</span>
        <span class="fileinput-exists"><i class="glyphicon glyphicon-refresh"></i> Ganti</span>

      </span>
      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
      </div>
    </div>
    
          </div>
      </div>


  <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="submit" class="btn btn-danger" name="submit"> <i class="fa fa-plus"></i>  Save
                  </button>
                </div>
              </div>
</form>

<?php else: ?>
<!-- JIKA DATA ADA!-->
<form method="post" action="<?php echo base_url(); ?>user/pendidikan/edit" class="form-horizontal" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">Pendidikan Terakhir </label>  
    <div class="col-sm-4">
       <select name="kdpendidikan" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdpendidikan?>"><?php echo $edit->pendidikan?></option>
           
                    <?php
                  foreach($dt_pendidikan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdpendidikan']; ?>"><?php echo $sp['pendidikan']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
    <label class="col-sm-2 control-label">Nama sekolah/perguruan tinngi</label>
    <div class="col-sm-4">
      <input required type="text" name="nama" class="form-control" value="<?php echo $edit->nama?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Nilai </label>
   <div class="col-sm-4">
      <input required type="number" name="nilai" class="form-control" value="<?php echo $edit->nilai?>">
    </div>

    <label class="col-sm-2 control-label">Alamat </label>
    <div class="col-sm-4">
      <textarea class="form-control" name="alamat" rows="4"><?php echo $edit->alamat?></textarea>
    </div>
   
  </div>


  <div class="form-group">
    <label class="col-sm-2 control-label">Start</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_awal" value="<?php echo $edit->tgl_awal?>">
    </div>
    <label class="col-sm-2 control-label">End</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_akhir" value="<?php echo $edit->tgl_akhir?>">
    </div>
  </div>

<div class="form-group">
        <label class="col-sm-2 control-label">Ijazah</label>
          <div class="col-sm-8">
          <div class="alert alert-success">  
                    <a class="close" data-dismiss="alert">x</a>  
                    Info! <br/>
                    Gambar Ukuran Maksimum file 200kb, (disarankan ukuran dibawah 100kb)<br/>
                    File yang diizinkan untuk upload .jpg, .jpeg, .png
                  </div>
            
    <div class="fileinput fileinput-new" data-provides="fileinput" >
    <div class="fileinput-new thumbnail" >
      <img class="img-responsive" src="<?php echo base_url(); ?>foto_ijazah/<?php echo $edit->foto; ?>"
       style="max-height: 100px; ">
    </div>
      <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 100px; "></div>
      <div>
      <span class="btn btn-file btn-success ">
      <input type="file" name="file1" value="<?php echo $edit->foto?>">
      <span class="fileinput-new"><i class="fa fa-camera"></i> Ganti</span>
        
        <span class="fileinput-exists"><i class="fa fa-refresh"></i> Ganti</span>

      </span>
      <a href="#" class="btn btn-info fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash-o"></i> Hapus</a>
      </div>
    </div>

          </div>
      </div>
 
  <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="submit" class="btn btn-danger" name="submit"> <i class="fa fa-plus"></i>  Save
                  </button>
                </div>
              </div>
</form>

<?php endif; ?>


  
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

 