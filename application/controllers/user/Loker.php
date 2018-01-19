<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loker extends CI_Controller {


  var $folder =   "user/master/loker";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Lowongan Kerja";

  
  function __construct(){
    parent::__construct();
      $this->load->model('user/loker_model');    
  }

  protected function template($page,$data)
  {
    if($this->session->userdata('masuk_in')!=""){
      $this->load->view('user/header',$data);     
       $this->load->view($this->fkiri."/".$this->kiri);
      $this->load->view($this->folder."/".$page);   
      $this->load->view('user/footer');
    }else{

      header('location:'.base_url().'');
    }
    
  }

  public function index()
  {
    if($this->session->userdata('masuk_in')!=""){
      redirect('user/loker/data_loker');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_loker($kdregis=0)
  {
      $kdregis=$this->session->userdata('kdregis');
      date_default_timezone_set("Asia/Jakarta");
      $datenow=date("Y-m-d");

      $cm= $this->loker_model->cek($datenow);
      foreach ($cm as $row):
        ".$row->kdkategoriloker.";  
        ".$row->tgl_akhir.";
      endforeach;

      $ck=$row->kdkategoriloker;
      $ct=$row->tgl_akhir;

        $data['dt_loker']=$this->db->query("
          SELECT lok.*,kat.kdkategoriloker,kat.kategoriloker,kat.tgl_awal,kat.tgl_akhir,kat.kdkategoriloker
           FROM m_loker as lok
          inner join m_kategoriloker as kat on kat.kdkategoriloker=lok.kdkategoriloker
          where kat.tgl_akhir >='$datenow' and kat.status='1' and lok.status='1'
          order by kat.tgl_awal asc
        ");

      $data['title']  = $this->title;                      
      $data['judul']  = $this->title;
      $page     = "home";  
      $this->template($page,$data); 
  }

  public function input($kdloker=0)
  {
    $kdregis=$this->session->userdata('kdregis');
    date_default_timezone_set("Asia/Jakarta"); 
    $created_at=date("Y-m-d h:i:s");
    if ($this->loker_model->cek_profil($kdregis)==0) 
    {
      $this->session->set_flashdata('save_loker', "mohon lengkapi profil anda terlebih dahulu");
      header('location:'.base_url().'user/loker/data_loker');   
    } 
    elseif ($this->loker_model->cek_pendidikan($kdregis)==0) 
    {
     $this->session->set_flashdata('save_loker', "mohon lengkapi pendidikan anda terlebih dahulu");
      header('location:'.base_url().'user/loker/data_loker');
    }
    else
    {
      $kdevent=$this->loker_model->ambil_event($kdloker,$kdregis);

        if ($data['row']=$kdevent) 
          {

              $abc=$this->loker_model->cek_event($kdevent,$kdregis);
              
              if (!$data['row']=$abc) 
                {
                      $dt_lamar=array(
                      'kduser_regis'=>$kdregis,
                      'kdkategoriloker'=>$kdevent,
                      'kdloker'=>$kdloker,       
                      'created_at'=>$created_at,
                      'created_by'=>$kdregis
                    );
                    
                    $dt=array_merge($dt_lamar);
                    $this->db->insert('m_user_lamar ',$dt);

                   $this->session->set_flashdata('save_loker', "Anda berhasil mendaftar silahkan menunggu konfirmasi selanjutnya");
                    header('location:'.base_url().'user/loker/data_loker');   
                  
                }
              //jika ada  
              else
                {
                    $this->session->set_flashdata('save_loker', "Anda sudah mendaftar untuk event yang ini");
                    header('location:'.base_url().'user/loker/data_loker'); 
                }
           }
         else
              {
                  $this->session->set_flashdata('save_loker', "Anda sudah mendaftar untuk event yang ini");
                  header('location:'.base_url().'user/loker/data_loker'); 
              }
    }
        
  }

  
public function view() {
if($this->input->post('kdloker')){
     $kdloker = $this->input->post('kdloker');
   
    $result = $this->loker_model->view($kdloker);
    if (!empty($result))
                {

                    foreach ($result as $row):
                        echo "
                         <table class='table table-bordered'>
    <tr><td >Event</td><td>".$row->kategoriloker."</td></tr>
    <tr><td >Ket</td><td>".$row->ket."</td></tr>
    <tr><td >Start</td><td>".$row->tgl_awal."</td></tr>
    <tr><td >End</td><td>".$row->tgl_akhir."</td></tr>
        
  </table>";

                      
                        
                        
                    endforeach;
                    }
                else
                {
                    echo "<li> <em> Not found ... </em> </li>";
                }
              

    }
}

  
}