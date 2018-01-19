<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


  var $folder =   "adminb3/home";
  var $kiri = "kiri";
  var $fkiri  = "adminb3/master";
  var $title  =   "Data ";

  
  function __construct(){
    parent::__construct();
   
      $this->load->model('master/home_model');

   
    
  }
  protected function template($page,$data)
  {
    if($this->session->userdata('logged_in')!=""){
      $this->load->view('adminb3/header',$data);     
      $this->load->view($this->fkiri."/".$this->kiri);
      $this->load->view($this->folder."/".$page);   
      $this->load->view('adminb3/footer');
    }else{

      header('location:'.base_url().'');
    }
    
  }

  public function index()
  {
    if($this->session->userdata('logged_in')!=""){
      redirect('adminb3/home/home/data_home');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_home()
  {
      date_default_timezone_set("Asia/Jakarta");
      $tgl_skr = date('Y-m-d');
      $data['total']=$this->home_model->total();
      $data['sekarang']=$this->home_model->sekarang($tgl_skr);

      $data['title']  = $this->title;                             
      $data['judul']  = "Data ";
      $page     = "home";             
      $this->template($page,$data); 
  }

  public function load_total()
  {
    echo $this->home_model->total();
      
  }
  
  public function load_sekarang()
  {
      date_default_timezone_set("Asia/Jakarta");
      $tgl_skr = date('Y-m-d');
      echo $this->home_model->sekarang($tgl_skr);   
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