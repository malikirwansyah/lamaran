<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_loker extends CI_Controller {


  var $folder =   "user/master/status_loker";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Status Lowongan Kerja";

  
  function __construct(){
    parent::__construct();
      $this->load->model('user/status_loker_model');    
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
      redirect('user/status_loker/data_status_loker');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_status_loker($kdregis=0)
  {
      $kdregis=$this->session->userdata('kdregis');
      $data['dt_loker']=$this->status_loker_model->getdata($kdregis);
      $data['title']  = $this->title;
      $data['st']=$this->status_loker_model->st;                        
      $data['judul']  = $this->title;
      $page     = "home";  
      $this->template($page,$data); 
  }

  public function input($kdstatus_loker=0)
  {

      date_default_timezone_set("Asia/Jakarta"); 
      $created_at=date("Y-m-d h:i:s");

        $kdregis=$this->session->userdata('kdregis');
        $kdevent=$this->status_loker_model->ambil_event($kdstatus_loker,$kdregis);

        if ($data['row']=$kdevent) 
          {

              $abc=$this->status_loker_model->cek_event($kdevent,$kdregis);
              
              if (!$data['row']=$abc) 
                {
                      $dt_lamar=array(
                      'kduser_regis'=>$kdregis,
                      'kdkategoristatus_loker'=>$kdevent,
                      'kdstatus_loker'=>$kdstatus_loker,       
                      'created_at'=>$created_at,
                      'created_by'=>$kdregis
                    );
                    
                    $dt=array_merge($dt_lamar);
                    $this->db->insert('m_user_lamar ',$dt);

                   $this->session->set_flashdata('save_status_loker', "Anda berhasil mendaftar silahkan menunggu konfirmasi selanjutnya");
                    header('location:'.base_url().'user/status_loker/data_status_loker');   
                  
                }
              //jika ada  
              else
                {
                    $this->session->set_flashdata('save_status_loker', "Anda sudah mendaftar untuk event yang ini");
                    header('location:'.base_url().'user/status_loker/data_status_loker'); 
                }
           }
         else
              {
                  $this->session->set_flashdata('save_status_loker', "Anda sudah mendaftar untuk event yang ini");
                  header('location:'.base_url().'user/status_loker/data_status_loker'); 
              }   
           
  }

  
public function view() {
if($this->input->post('kdstatus_loker')){
     $kdstatus_loker = $this->input->post('kdstatus_loker');
   
    $result = $this->status_loker_model->view($kdstatus_loker);
    if (!empty($result))
                {

                    foreach ($result as $row):
                        echo "
                         <table class='table table-bordered'>
    <tr><td >Event</td><td>".$row->kategoristatus_loker."</td></tr>
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