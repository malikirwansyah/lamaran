<?php $kdgroupbe=$this->session->userdata('kdgroup_user'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="<?php echo base_url(); ?>adminb3/home/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
         
        </li>
        <li class="
              <?php
              $isi='';
             // $isi=$this->db->query("SELECT * FROM ms_menu  WHERE  id_menu= '$id_menu' ")->row(); 
              $l = $this->db->query("SELECT COUNT(id_menu) as ju FROM ms_menu WHERE id_menu_header = '1'")->row();                                                                                   
              $i = $l->ju;
              $sql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk BETWEEN 1 AND '$i' AND id_menu_header = '1'");                                                                     
              foreach ($sql->result() as $m) {
                $ql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk = '$m->id_menu_induk' AND menu_link = '$m->menu_link' AND status = '1'")->row();                                                                           
                if($isi==$ql->menu_link){
                  echo "active";
                } 
              }            
              ?>
              ">


           <a href="#">
                <i class="fa fa-database"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
              </a> 
              <ul class="treeview-menu">

          <?php 
              $menu_bagian = $this->db->query("
                SELECT DISTINCT(ms_menu_induk.menu_induk),ms_menu_induk.id_menu_induk 
                FROM ms_menu 
                INNER JOIN ms_menu_induk ON ms_menu.id_menu_induk=ms_menu_induk.id_menu_induk
                RIGHT JOIN m_user_access on m_user_access.id_menu=ms_menu.id_menu
                WHERE ms_menu.status = '1' AND id_menu_header = '1'  AND m_user_access.kdgroup_user=$kdgroupbe
                AND m_user_access.status='1' 
                ORDER BY ms_menu.id_menu ASC
                          ");                                                                       
              foreach ($menu_bagian->result() as $menu) {                
              ?>
         

             
              <li class="                
                  <?php
                  $sql = $this->db->query("
                  SELECT * FROM ms_menu
                  RIGHT JOIN m_user_access on m_user_access.id_menu=ms_menu.id_menu 
                  WHERE ms_menu.id_menu_induk = '$menu->id_menu_induk' AND ms_menu.id_menu_header = '1' AND ms_menu.status = '1'
                  AND m_user_access.status='1' AND m_user_access.kdgroup_user=$kdgroupbe 
                  ");                                                         
                  foreach ($sql->result() as $m) {
                    $ql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk = '$m->id_menu_induk' AND id_menu_header = '1' AND menu_link = '$m->menu_link' AND status = '1'")->row();                                                                           
                    if($isi==$ql->menu_link){
                      echo "active";
                    } 
                  }               
                  ?>
                  treeview">
                  <a href="#">
                     <span><?php echo $menu->menu_induk ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    
                  <ul class="treeview-menu">
                    <?php 
                    foreach ($sql->result() as $me) {
                      $ql = $this->db->query("
                        SELECT ms.*
                        FROM ms_menu as ms 
                        RIGHT JOIN m_user_access as mu on mu.id_menu=ms.id_menu
                        WHERE ms.id_menu_induk = '$m->id_menu_induk' AND menu_link = '$me->menu_link'
                        AND mu.kdgroup_user=$kdgroupbe AND mu.status='1'
                        ")->row();                                                           
                    ?>                    
                      <li class="
                 
                      "><a href="<?php echo base_url(); ?>adminb3/<?php echo $me->menu_link ?>"><?php echo $me->menu_name ?></a></li>                                      
                    <?php 
                    }
                    ?>
                  </ul>                 
                </li>
               

              <?php 
              }
              ?>
              </ul>     
        </li>
            

            <li class="
              <?php
              $isi=''; 
              $l = $this->db->query("SELECT COUNT(id_menu) as ju FROM ms_menu WHERE id_menu_header = '2'")->row();                                                                                   
              $i = $l->ju;
              $sql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk BETWEEN 1 AND '$i' AND id_menu_header = '2'");                                                                     
              foreach ($sql->result() as $m) {
                $ql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk = '$m->id_menu_induk' AND menu_link = '$m->menu_link' AND status = '1'")->row();                                                                           
                if($isi==$ql->menu_link){
                  echo "active";
                } 
              }            
              ?>
              ">

                 
           <a href="#">
                <i class="fa fa-reorder "></i> <span>Main Menu</span> <i class="fa fa-angle-left pull-right"></i>
              </a> 
              <ul class="treeview-menu">

             
          <?php 
              $menu_bagian = $this->db->query("
                SELECT DISTINCT(ms_menu_induk.menu_induk),ms_menu_induk.id_menu_induk 
                FROM ms_menu 
                INNER JOIN ms_menu_induk ON ms_menu.id_menu_induk=ms_menu_induk.id_menu_induk
                RIGHT JOIN m_user_access on m_user_access.id_menu=ms_menu.id_menu
                WHERE ms_menu.status = '1' AND id_menu_header = '2'  AND m_user_access.kdgroup_user=$kdgroupbe
                AND m_user_access.status='1' 
                ORDER BY ms_menu.id_menu ASC
                          ");                                                                       
              foreach ($menu_bagian->result() as $menu) {                
              ?>
       
              <li class="                
                  <?php
                  $sql = $this->db->query("
                  SELECT * FROM ms_menu
                  RIGHT JOIN m_user_access on m_user_access.id_menu=ms_menu.id_menu 
                  WHERE ms_menu.id_menu_induk = '$menu->id_menu_induk' AND ms_menu.id_menu_header = '2' AND ms_menu.status = '1'
                  AND m_user_access.status='1' AND m_user_access.kdgroup_user=$kdgroupbe 
                  ");                                                         
                  foreach ($sql->result() as $m) {
                    $ql = $this->db->query("SELECT * FROM ms_menu WHERE id_menu_induk = '$m->id_menu_induk' AND id_menu_header = '2' AND menu_link = '$m->menu_link' AND status = '1'")->row();                                                                           
                    if($isi==$ql->menu_link){
                      echo "active";
                    } 
                  }               
                  ?>
                  treeview">
                  <a href="#">
                     <span><?php echo $menu->menu_induk ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                    
                  <ul class="treeview-menu">
                    <?php 
                    foreach ($sql->result() as $me) {
                      $ql = $this->db->query("
                        SELECT ms.*
                        FROM ms_menu as ms 
                        RIGHT JOIN m_user_access as mu on mu.id_menu=ms.id_menu
                        WHERE ms.id_menu_induk = '$m->id_menu_induk' AND menu_link = '$me->menu_link'
                        AND mu.kdgroup_user=$kdgroupbe AND mu.status='1'
                        ")->row();                                                           
                    ?>                    
                      <li class="
                 
                      "><a href="<?php echo base_url(); ?>adminb3/<?php echo $me->menu_link ?>"><?php echo $me->menu_name ?></a></li>                                      
                    <?php 
                    }
                    ?>
                  </ul>                 
                </li>
               

              <?php 
              }
              ?>
              </ul>     
        </li>


              
        
</ul>
    </section>
    <!-- /.sidebar -->
  </aside>
