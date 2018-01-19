<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


  var $folder =   "user/home";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Data ";

  
  function __construct(){
    parent::__construct();
   
      $this->load->model('user/home_model');

   
    
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
      redirect('user/home/home/data_home');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_home()
  {
    if($this->session->userdata('masuk_in')!=""){
      
      $data['title']  = $this->title; 
     // $data['dt_agama']=$this->db->get('m_agama');                            
      $data['judul']  = "Data agama";
      $page     = "home";             
      $this->template($page,$data); 

    }
    else{

      header('location:'.base_url().'');
    }
  }


  function ambil_daerah(){
$modul=$this->input->post('modul');
$kdprovinsi=$this->input->post('kdprovinsi');
$kdkabupaten=$this->input->post('kdkabupaten');
$kdkecamatan=$this->input->post('kdkecamatan');
if($modul=="kabupaten"){
echo $this->home_model->getkabupaten($kdprovinsi);
}
if($modul=="kecamatan"){
echo $this->home_model->getkecamatan($kdkabupaten);
}
if($modul=="kelurahan"){
echo $this->home_model->getkelurahan($kdkecamatan);
}
}



  
}