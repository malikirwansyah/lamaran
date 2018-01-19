
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>master/pegawai/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<form method="post" action="<?php echo base_url(); ?>master/pegawai/edit" class="form-horizontal">
   <input type="hidden" class="form-control" name="kdpegawai" value="<?php echo $edit->kdpegawai?>">
<div class="form-group">
    <label class="col-sm-2 control-label">Nama pegawai</label>
    <div class="col-sm-4">
      <input type="text" required class="form-control" name="pegawai" value="<?php echo $edit->pegawai?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">npp pegawai</label>
    <div class="col-sm-4">
      <input type="text" required class="form-control" name="npp" value="<?php echo $edit->npp?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
    <div class="col-sm-2">
      <input type="text" required class="form-control tglbe" name="tanggal_lahir" value="<?php echo $edit->tanggal_lahir?>">
    </div>
    <div class="col-sm-8">
      <input type="text" required class="form-control" name="tempat_lahir" value="<?php echo $edit->tempat_lahir?>">
    </div>
  </div>
    <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-4">
                <select required name="jk" class="select2" style="width: 100%;" >
                <option value="<?php echo $edit->jk?>"><?php echo $edit->jk?></option>
                <option value="L">Laki-Laki</option>
                 <option value="P">Perempuan</option>
                </select>
                </div>
            
  </div>
    <div class="form-group">
    <label class="col-sm-2 control-label">No Telp</label>
    <div class="col-sm-4">
      <input type="text" required class="form-control" name="telp" value="<?php echo $edit->telp?>">
    </div>
  </div>
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
    <label class="col-sm-2 control-label">Kabupaten/Kota</label>
                <div class="col-sm-4">
                <select required name="kdkabupaten" class="select2" style="width: 100%;" id="kabupaten">
               <option value="<?php echo $edit->kdkabupaten?>"><?php echo $edit->kabupaten?></option>
                </select>
                </div>            
  </div>
    
   <div class="form-group">
                <label class="col-sm-2 control-label">Kecamatan</label>
                <div class="col-sm-4">
                <select required name="kdkecamatan" class="select2" style="width: 100%;" id="kecamatan">
               <option value="<?php echo $edit->kdkecamatan?>"><?php echo $edit->kecamatan?></option>
                </select>
                </div>
  <label class="col-sm-2 control-label"> kelurahan</label>
    <div class="col-sm-4">
      <select required name="kdkelurahan" class="select2" style="width: 100%;" id="kelurahan">
        <option value="<?php echo $edit->kdkelurahan?>"><?php echo $edit->kelurahan?></option>
      </select>
    </div>
  </div>
 
   <div class="form-group">
    <label class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-4">
     <textarea name="alamat" required class="form-control" rows="3"><?php echo $edit->alamat?> </textarea>
    </div>
  </div>

    <div class="form-group">
                <label class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-4">
                <select required name="kdunit" class="select2" style="width: 100%;" >
                <option value="<?php echo $edit->kdunit?>"><?php echo $edit->unit?></option>
                    <?php
                  foreach($dt_unit->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdunit']; ?>"><?php echo $sp['unit']; ?> </option>
                <?php
                  }
                  ?>
                </select>
                </div>
    <label class="col-sm-2 control-label">Jabatan</label>
                <div class="col-sm-4">
                <select required name="kdjabatan" class="select2" style="width: 100%;" >
                <option value="<?php echo $edit->kdjabatan?>"><?php echo $edit->jabatan?></option>
                  <?php
                  foreach($dt_jabatan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdjabatan']; ?>"><?php echo $sp['jabatan']; ?> </option>
                <?php
                  }
                  ?>
                </select>
                </div>            
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tgl Orientasi</label>
    <div class="col-sm-2">
      <input type="text" required class="form-control tglbe" name="tanggal_orientasi" value="<?php echo $edit->tanggal_orientasi?>">
    </div>
    <label class="col-sm-2 control-label">Tgl Kontrak</label>
    <div class="col-sm-2">
      <input type="text" required class="form-control tglbe" name="tanggal_kontrak" value="<?php echo $edit->tanggal_kontrak?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tgl Sementara</label>
    <div class="col-sm-2">
      <input type="text" required class="form-control tglbe" name="tanggal_sementara" value="<?php echo $edit->tanggal_sementara?>">
    </div>
    <label class="col-sm-2 control-label">Tgl tetap</label>
    <div class="col-sm-2">
      <input type="text" required class="form-control tglbe" name="tanggal_tetap" value="<?php echo $edit->tanggal_tetap?>">
    </div>
  </div>
   <div class="form-group">
                <label class="col-sm-2 control-label">Golongan</label>
                <div class="col-sm-4">
                <select required name="kdgolongan" class="select2" style="width: 100%;" >
                <option value="<?php echo $edit->kdgolongan?>"><?php echo $edit->golongan?></option>
                    <?php
                  foreach($dt_golongan->result_array() as $sp)
                  {
                  ?>
                  <option value="<?php echo $sp['kdgolongan']; ?>"><?php echo $sp['golongan']; ?> </option>
                <?php
                  }
                  ?>
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

 