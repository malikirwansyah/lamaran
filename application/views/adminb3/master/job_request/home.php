
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
 <?php if($this->session->flashdata('save_job_request')) { ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">X</button>
    <?php echo $this->session->flashdata('save_job_request'); ?>
  </div>
  <?php } ?>
  
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>No</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Hp</th>
                <th>Pendidikan</th>
                <th>Nilai</th>
                <th>Email</th>
                <th>Event</th>
                <th>Loker</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
  <?php
    $no=0+1;
    foreach($dt_job_request->result() as $dp)
    {
  ?>
    <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo ($dp->noktp); ?></td>
    <td><?php echo ($dp->nama_lengkap); ?></td>
    <td><?php echo ($dp->hp); ?></td>
    <td><?php echo ($dp->pendidikan); ?></td>
    <td><?php echo ($dp->nilai); ?></td>
    <td><?php echo ($dp->email); ?></td>
    <td><?php echo ($dp->kategoriloker); ?></td>
    <td><?php echo ($dp->loker); ?></td>
    <?php $s=($dp->status); ?>

    <td>
      <?php if ($s==0 ): ?>
      <small class="label bg-green"><?php echo $st[($dp->status)]; ?></small>
      <?php elseif($s==1 ): ?>
      <small class="label bg-yellow"><?php echo $st[($dp->status)]; ?></small>
      <?php elseif($s==2 ): ?>
      <small class="label bg-red"><?php echo $st[($dp->status)]; ?></small>
      <?php else: ?>

      <?php endif; ?>
      
      
    </td>
    <td>
    
     <a title="View Data"  href="<?php echo base_url(); ?>adminb3/job_request/view/<?php echo ($dp->kduser_lamar); ?>" class='btn btn-success btn-sm btn-flat'> <i class='fa fa-external-link'></i></a>  

    </td>
    </tr>
   <?php
      $no++;
    }
   ?>
  </tbody>
                
              </table>
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
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Informasi  Detail</h4>
                </div>
                <!-- memulai untuk konten dinamis -->
                <!-- lihat id="data_siswa", ini yang di pangging pada ajax di bawah -->
                <div class="modal-body" id="data_siswa">
                </div>
                <!-- selesai konten dinamis -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
 <script type="text/javascript">
   // ini menyiapkan dokumen agar siap grak :)
    $(document).ready(function(){
        // yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
        $('.view_data').click(function(){
            // membuat variabel id, nilainya dari attribut id pada button
            // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
            var kduser_regis = $(this).attr("id");
            
            // memulai ajax
            $.ajax({
                 url: "<?=site_url('adminb3/job_request/view');?>",   // set url -> ini file yang menyimpan query tampil detail data siswa
                method: 'post',     // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
                data: {kduser_regis:kduser_regis},      // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
                success:function(data){     // kode dibawah ini jalan kalau sukses
                    $('#data_siswa').html(data);    // mengisi konten dari -> <div class="modal-body" id="data_siswa">
                    $('#myModal').modal("show");    // menampilkan dialog modal nya
                }
            });
        });
    });
</script>