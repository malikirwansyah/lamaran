
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
  
          <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
        <th>No ktp</th>
        <th>Nama</th>
        <th>Event</th>
        <th>Loker</th>
        <th>Status</th>
        <th width="100px">Action</th>
                </tr>
            </thead>
      
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
                <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "json", "type": "POST"},
                    columns: [
                        {
                            "data": "kduser_lamar",
                            "orderable": false
                        },{"data": "noktp"},{"data": "nama_lengkap"},{"data": "kategoriloker"},{"data": "loker"},{"data":"status"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                     "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {           
                            if(aData.status == 0){
                                $("td:eq(5)", nRow).text("In Proses");
                            }
                            else if(aData.status == 1){
                                $("td:eq(5)", nRow).text("Approve");
                            }
                            else{
                                $("td:eq(5)", nRow).text("Un Successful");
                            }
                            return nRow;
                        },
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>