
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <a title="view Data"  href="<?php echo base_url(); ?>adminb3/job_request/" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-eye'></i> View Data</a> 
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

<div class="tabbable tabs-left">
  <?php
    if(
        $this->session->userdata("tab_profile")=="" 
        && $this->session->userdata("tab_pendidikan")==""
        && $this->session->userdata("tab_pengalaman")==""
        && $this->session->userdata("tab_kesimpulan")==""
      )
    {
      $set['tab_profile'] = "active";
      $this->session->set_userdata($set);
    }
    $profile = $this->session->userdata("tab_profile");
    $pendidikan = $this->session->userdata("tab_pendidikan");
    $pengalaman = $this->session->userdata("tab_pengalaman");
    $kesimpulan = $this->session->userdata("tab_kesimpulan");
  ?>
    <ul class="nav nav-tabs">
      <li class="<?php echo $profile; ?>"><a href="#lprofile" data-toggle="tab">Profile</a></li>
      <li class="<?php echo $pendidikan; ?>"><a href="#lpendidikan" data-toggle="tab">Pendidikan</a></li>
      <li class="<?php echo $pengalaman; ?>"><a href="#lpengalaman" data-toggle="tab">Pengalaman</a></li>
      <li class="<?php echo $kesimpulan; ?>"><a href="#lkesimpulan" data-toggle="tab">Kesimpulan</a></li>
     
    </ul>
    <div class="tab-content">
    <div class="tab-pane <?php echo $profile; ?>" id="lprofile"><br>
      <table class='table table-bordered'>
        <tr><td>No ktp</td><td><?php echo $view_profile->noktp?></td></tr>
        <tr><td>Nama</td><td><?php echo $view_profile->nama_lengkap?></td></tr>
        <tr><td>Email</td><td><?php echo $view_profile->email?></td></tr>
        <tr><td>Tempat Lahir</td><td><?php echo $view_profile->tempat_lahir?></td></tr>
        <tr><td>Tanggal Lahir</td><td><?php echo $view_profile->tempat_lahir?></td></tr>
        <tr><td>Jenis Kelamin</td><td><?php echo $st_jk[$view_profile->jk]?></td></tr>
        <tr><td>Agama</td><td><?php echo $view_profile->agama?></td></tr>
        <tr><td>Tinggi Badan</td><td><?php echo $view_profile->tinggi_badan?></td></tr>
        <tr><td>Berat Badan</td><td><?php echo $view_profile->berat_badan?></td></tr>
        <tr><td>Alamat</td><td><?php echo $view_profile->alamat?></td></tr>
        <tr><td>hp</td><td><?php echo $view_profile->hp?></td></tr>
        <tr><td>Status Pernikahan</td><td><?php echo $view_profile->status_pernikahan?></td></tr>
        <td>
            <img class="img-responsive" style="float: right; max-height: 100px;" src="<?php echo base_url(); ?>foto_user/<?php echo $view_profile->foto_ktp; ?>">  
          </td>
      </table>
    </div><!-- /lprofile -->

    <div class="tab-pane <?php echo $pendidikan; ?>" id="lpendidikan"><br>

      <table class='table table-bordered'>
        <tr><td>Nama</td><td><?php echo $view_pendidikan->nama?></td></tr>
        <tr><td>Pendidikan</td><td><?php echo $view_pendidikan->pendidikan?></td></tr>
        <tr><td>Nilai</td><td><?php echo $view_pendidikan->nilai?></td></tr>
        <tr><td>Alamat</td><td><?php echo $view_pendidikan->alamat?></td></tr>
        <tr><td>Start</td><td><?php echo $view_pendidikan->tgl_awal?></td></tr>
        <tr><td>End</td><td><?php echo $view_pendidikan->tgl_akhir?></td></tr>
        <tr><td>Ijazah</td>
          <td>
            <img class="img-responsive" style="float: right; max-height: 100px;" src="<?php echo base_url(); ?>foto_ijazah/<?php echo $view_pendidikan->foto; ?>">  
          </td>
        </tr>
      </table>

    </div><!-- /lpendidikan -->

    <div class="tab-pane <?php echo $pengalaman; ?>" id="lpengalaman"><br>
      <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No</th>
                  <th>Nama Perusahaan</th>
                  <th>Jabatan</th>
                  <th>Start</th>
                  <th>End</th>
                 
                </tr>
                </thead>
                <tbody>
  <?php
    $no=0+1;
    foreach($view_pengalaman->result() as $dp)
    {
  ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo ($dp->nm_perusahaan); ?></td>
    <td><?php echo ($dp->jabatan); ?></td>
    <td><?php echo ($dp->tgl_awal); ?></td>
    <td><?php echo ($dp->tgl_akhir); ?></td>
    
    </tr>
   <?php
      $no++;
    }
   ?>
  </tbody>
                
              </table>
    </div><!-- /pengalaman -->

    <div class="tab-pane <?php echo $kesimpulan; ?>" id="lkesimpulan"><br>

    <form method="post" action="<?php echo base_url(); ?>adminb3/job_request/view" class="form-horizontal">

  <div class="form-group">
    <input  type="hidden" class="form-control" name="kduser_lamar" value="<?php echo $view_lamar->kduser_lamar?>">
    
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-2">
      <select name="status" class="select2" style="width: 100%;">
                <option value="1">Approve </option>
                <option value="2"> Un Successful</option>
      </select>
    </div>
    <label class="col-sm-2 control-label">Alasan </label>
    <div class="col-sm-6">
      <input  type="text" class="form-control" name="alasan">
    </div>
  </div>
  <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="submit" class="btn btn-danger" name="submit" onClick="return confirm('are you sure this data..???');"> <i class="fa fa-plus"></i>  Save
                  </button>
                </div>
              </div>
</form>

    </div><!-- /lpendidikan -->


    </div><!-- /tabcontent -->
  </div> <!-- /tabbable -->

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

 