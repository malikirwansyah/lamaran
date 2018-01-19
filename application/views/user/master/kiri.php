
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>user/home/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
         </li> 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>Profil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>user/profil"> Profil</a></li>
            <li><a href="<?php echo base_url(); ?>user/pendidikan"> Pendidikan</a></li>
            <li><a href="<?php echo base_url(); ?>user/pengalaman"> Pengalaman Kerja</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Lowongan Kerja</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>user/loker">Daftar Lowongan Kerja</a></li>
            <li><a href="<?php echo base_url(); ?>user/status_loker">Status Lowongan Kerja</a></li>
          </ul>
        </li>


        


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
