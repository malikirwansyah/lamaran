 
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
 <?php if($this->session->flashdata('save_profil')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_profil'); ?>
  </div>
  <?php } ?>

<?php 
 $kdregis=$this->session->userdata('kdregis');
 ?>

<?php if (!$abc=$this->profil_model->cek_kode($kdregis)): ?>
<!-- JIKA DATA KOSONG!-->
<form method="post" action="<?php echo base_url(); ?>user/profil/simpan" class="form-horizontal" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">No KTP</label>
    <div class="col-sm-4">
      <input readonly type="text" class="form-control" value=" <?php echo $this->session->userdata('noktp'); ?>">
    </div>
    <label class="col-sm-2 control-label">Nama Lengkap</label>
    <div class="col-sm-4">
      <input required type="text" class="form-control" name="nama_lengkap" value=" <?php echo $this->session->userdata('nama_lengkap'); ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>
    <div class="col-sm-6">
      <textarea class="form-control" name="tempat_lahir" rows="3"></textarea>
    </div>
  
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_lahir" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kelamin </label>
    <div class="col-sm-4">
      <select required name="jk" class="select2" style="width: 100%;">
                <option value="1">Laki-laki</option>
                <option value="0">Perempuan</option>
      </select>
    </div>
    <label class="col-sm-2 control-label">Agama </label>  
    <div class="col-sm-4">
       <select name="kdagama" required class="select2 " style="width: 100%;">
           <option value="">--pilih--</option>
           
                    <?php
                  foreach($dt_agama->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdagama']; ?>"><?php echo $sp['agama']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Tinggi Badan</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="tinggi_badan" placeholder="cm">
    </div>
    <label class="col-sm-2 control-label">Berat Badan</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="berat_badan" placeholder="kg">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-4">
      <textarea class="form-control" name="alamat" rows="4"></textarea>
    </div>
    <label class="col-sm-2 control-label">HP</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="hp" >
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-label">Status Pernikahan</label>
    <div class="col-sm-4">
       <select name="kdstatus_pernikahan" required class="select2 " style="width: 100%;">
           <option value="">--pilih--</option>
           
                    <?php
                  foreach($dt_pernikahan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdstatus_pernikahan']; ?>"><?php echo $sp['status_pernikahan']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-4">
      <input required readonly class="form-control"  value=" <?php echo $this->session->userdata('email'); ?>">
    </div>
  </div>

   <div class="form-group">
        <label class="col-sm-2 control-label">Foto Profil</label>
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
        <label class="col-sm-2 control-label">Foto KTP</label>
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
      <input type="file" required name="file2" >
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
<form method="post" action="<?php echo base_url(); ?>user/profil/edit" class="form-horizontal" enctype="multipart/form-data">
  
  <div class="form-group">
    <label class="col-sm-2 control-label">No KTP</label>
    <div class="col-sm-4">
      <input readonly type="text" class="form-control" value=" <?php echo $this->session->userdata('noktp'); ?>">
    </div>
    <label class="col-sm-2 control-label">Nama Lengkap</label>
    <div class="col-sm-4">
      <input readonly type="text" class="form-control"  value=" <?php echo $this->session->userdata('nama_lengkap'); ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Tempat Tanggal Lahir </label>
    <div class="col-sm-6">
      <textarea class="form-control" name="tempat_lahir" rows="3"><?php echo $edit->tempat_lahir?></textarea>
    </div>
  
    <div class="col-sm-4">
      <input required type="text" class="form-control tglbe" name="tgl_lahir" value="<?php echo $edit->tgl_lahir?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kelamin </label>
    <div class="col-sm-4">
      <select required name="jk" class="select2" style="width: 100%;">
         <option value="<?php echo $edit->jk?>"><?php echo $st_jk[$edit->jk]?></option>
                <option value="1">Laki-laki</option>
                <option value="0">Perempuan</option>
      </select>
    </div>
    <label class="col-sm-2 control-label">Agama </label>  
    <div class="col-sm-4">
       <select name="kdagama" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdagama?>"><?php echo $edit->agama?></option>
           
                    <?php
                  foreach($dt_agama->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdagama']; ?>"><?php echo $sp['agama']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Tinggi Badan</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="tinggi_badan" placeholder="cm" value="<?php echo $edit->tinggi_badan?>">
    </div>
    <label class="col-sm-2 control-label">Berat Badan</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="berat_badan" placeholder="kg" value="<?php echo $edit->berat_badan?>">
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-4">
      <textarea class="form-control" name="alamat" rows="4"><?php echo $edit->alamat?></textarea>
    </div>
    <label class="col-sm-2 control-label">HP</label>
    <div class="col-sm-4">
      <input required type="number" class="form-control" name="hp" value="<?php echo $edit->hp?>">
    </div>
  </div>

   <div class="form-group">
    <label class="col-sm-2 control-label">Status Pernikahan</label>
    <div class="col-sm-4">
       <select name="kdstatus_pernikahan" required class="select2 " style="width: 100%;">
           <option value="<?php echo $edit->kdstatus_pernikahan?>"><?php echo $edit->status_pernikahan?></option>
           
                    <?php
                  foreach($dt_pernikahan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdstatus_pernikahan']; ?>"><?php echo $sp['status_pernikahan']; ?></option>
                <?php
                  }
                  ?>
            </select>
    </div>
    <label class="col-sm-2 control-label">Email</label>
    <div class="col-sm-4">
      <input required class="form-control" readonly value=" <?php echo $this->session->userdata('email'); ?>">
    </div>
  </div>

  
    
<div class="form-group">
        <label class="col-sm-2 control-label">Foto </label>
          <div class="col-sm-8">
          <div class="alert alert-success">  
                    <a class="close" data-dismiss="alert">x</a>  
                    Info! <br/>
                    Gambar Ukuran Maksimum file 200kb, (disarankan ukuran dibawah 100kb)<br/>
                    File yang diizinkan untuk upload .jpg, .jpeg, .png
                  </div>
            
    <div class="fileinput fileinput-new" data-provides="fileinput" >
    <div class="fileinput-new thumbnail" >
      <img class="img-responsive" src="<?php echo base_url(); ?>foto_user/<?php echo $edit->foto; ?>"
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
        <label class="col-sm-2 control-label">Foto KTP</label>
          <div class="col-sm-8">
          <div class="alert alert-success">  
                    <a class="close" data-dismiss="alert">x</a>  
                    Info! <br/>
                    Gambar Ukuran Maksimum file 200kb, (disarankan ukuran dibawah 100kb)<br/>
                    File yang diizinkan untuk upload .jpg, .jpeg, .png
                  </div>
            
    <div class="fileinput fileinput-new" data-provides="fileinput" >
    <div class="fileinput-new thumbnail" >
      <img class="img-responsive" src="<?php echo base_url(); ?>foto_user/<?php echo $edit->foto_ktp; ?>"
       style="max-height: 100px; ">
    </div>
      <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 100px; "></div>
      <div>
      <span class="btn btn-file btn-success ">
      <input type="file" name="file2" value="<?php echo $edit->foto_ktp?>">
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

 