<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> beta
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">SISTEM E-REKRUTMENT RS BAITURRAHIM</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script type="text/javascript">
     $('.tglbe').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
</script>
 <script type="text/javascript">

$(function(){

$.ajaxSetup({
type:"POST",
url: "<?php echo base_url('adminb3/home/home/ambil_daerah') ?>",
cache: false,
});


$("#provinsi").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kabupaten',kdprovinsi:value},
success: function(respond){
$("#kabupaten").html(respond);
}
})
}

});


$("#kabupaten").change(function(){

var value=$(this).val();
if(value>0){
$.ajax({
data:{modul:'kecamatan',kdkabupaten:value},
success: function(respond){
$("#kecamatan").html(respond);
}
})
}

});


});

</script>

<script type="text/javascript">
  $(document).ready(function() {
  var table =  $('#example1').DataTable( {
        responsive: true,
        dom: 'Bfrtip',
        select: true,
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
        'pageLength',

            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns:':visible'
                }
            },
           // 'colvis'
        ]
       // columnDefs: [
         //   { responsivePriority: 1, targets: 0 },
           // { responsivePriority: 2, targets: -2 }
        //]
    } );
    
} );
</script>
<script>
  $(function () {
     $(".select2").select2();
  });
</script>
<script type="text/javascript">
  
</script>
<!-- jQuery 2.2.3 -->
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/lib/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/validation/dist/jquery.validate.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-file-input.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/maskMoney/jquery.maskMoney.min.js"></script>

<script src="//cdn.datatables.net/plug-ins/1.10.16/filtering/row-based/range_dates.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datetime/bootstrap-datetimepicker.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/buttons.print.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/datatable/buttons.html5.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script type="text/javascript">
      $('.tglbe').datepicker({
      autoclose: true,
      format: "yyyy-mm-dd"
    });
</script>
<script>
  $(function() {
    $('#currencybe').maskMoney();
  })
</script>
<script type="text/javascript">
   $("#forminputbe").submit(function(){
    var value = $('#currencybe').maskMoney('unmasked')[0];
    $('#currencybe').val(value);
  });
</script>
</body>
</html>
