<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengalaman extends CI_Controller {


  var $folder =   "user/master/pengalaman";
  var $kiri = "kiri";
  var $fkiri  = "user/master";
  var $title  =   "Pengalaman Kerja";

  
  function __construct(){
    parent::__construct();
      $this->load->model('user/pengalaman_model');    
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
      redirect('user/pengalaman/data_pengalaman');
    }
    else{

      header('location:'.base_url().'');
    }
    
  }


  public function data_pengalaman($kdregis=0)
  {
      $kdregis=$this->session->userdata('kdregis');
      $data['dt_pengalaman']=$this->db->get_where('m_user_pengalaman',  array('kduser_regis' =>$kdregis )); 
      $data['title']  = $this->title;                      
      $data['judul']  = $this->title;
      $page     = "home";  
      $this->template($page,$data); 
  }

  public function input()
  {
    $data['title']  = $this->title; 
    $page     = "input";              
    $this->template($page,$data); 
  }

  public function simpan()
  {
    $kdregis=$this->session->userdata('kdregis');
    
    $this->form_validation->set_rules('nm_perusahaan', 'Nama Perusahaan', 'trim|required');
    $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
    $this->form_validation->set_rules('tgl_awal', 'Start', 'trim|required');
    $this->form_validation->set_rules('tgl_akhir', 'End', 'trim|required');
    if($this->form_validation->run() == FALSE)
      {
              
        $this->session->set_flashdata('save_pengalaman', "Lengkapi Form");
        header('location:'.base_url().'user/pengalaman/data_pengalaman');
      }
      else
      {

        date_default_timezone_set("Asia/Jakarta");
        $created_at=date("Y-m-d h:i:s");
        $update_at=date("Y-m-d h:i:s");
        $kdregis=$this->session->userdata('kdregis'); 

      
        $nm_perusahaan=$this->input->post('nm_perusahaan');
        $jabatan=$this->input->post('jabatan');
        $tgl_awal=$this->input->post('tgl_awal');
        $tgl_akhir=$this->input->post('tgl_akhir');
        
        if ($tgl_awal > $tgl_akhir) 
        //jika data salah
        {
          $this->session->set_flashdata('save_pengalaman', "Mohon diisi dengan benar");
          header('location:'.base_url().'user/pengalaman/data_pengalaman');  
        }
        //jika data benar 
        else 
        {
                $dt_pengalaman=array(
                  'kduser_regis'=>$kdregis,
                  'nm_perusahaan'=>$nm_perusahaan,
                  'jabatan'=>$jabatan,
                  'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,          
                  'created_at'=>$created_at,
                  'created_by'=>$kdregis
                );
                
                $dt=array_merge($dt_pengalaman);
                $this->db->insert('m_user_pengalaman ',$dt);

                $this->session->set_flashdata('save_pengalaman', "Data berhasil disimpan");
                header('location:'.base_url().'user/pengalaman/data_pengalaman');   
        }
        

           

               
      }

   

    
  }

  public function edit($kduser_pengalaman=0)
  {
    $kdregis=$this->session->userdata('kdregis');
          //submit
    if(isset($_POST['submit']))
        {
          
          $this->form_validation->set_rules('nm_perusahaan', 'Nama Perusahaan', 'trim|required');
          $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
          $this->form_validation->set_rules('tgl_awal', 'Start', 'trim|required');
          $this->form_validation->set_rules('tgl_akhir', 'End', 'trim|required');
          if($this->form_validation->run() == FALSE)
            {
                    
              $this->session->set_flashdata('save_pengalaman', "Lengkapi Form");
              header('location:'.base_url().'user/pengalaman/data_pengalaman');
            }
            else
            {

              date_default_timezone_set("Asia/Jakarta");
              $created_at=date("Y-m-d h:i:s");
              $update_at=date("Y-m-d h:i:s");
              $kdregis=$this->session->userdata('kdregis'); 

              //user
              
              $kduser_pengalaman=$this->input->post('kduser_pengalaman');
              $nm_perusahaan=$this->input->post('nm_perusahaan');
              $jabatan=$this->input->post('jabatan');
              $tgl_awal=$this->input->post('tgl_awal');
              $tgl_akhir=$this->input->post('tgl_akhir');

              if ($tgl_awal > $tgl_akhir) 
              //jika data salah
              {
                $this->session->set_flashdata('save_pengalaman', "Mohon diisi dengan benar");
                header('location:'.base_url().'user/pengalaman/data_pengalaman');  
              }
              //jika data benar 
              else 
              {
                $dt_pengalaman=array(
                        'kduser_regis'=>$kdregis,
                        'nm_perusahaan'=>$nm_perusahaan,
                        'jabatan'=>$jabatan,
                        'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir,          
                        'update_at'=>$update_at,
                        'update_by'=>$kdregis
                      );

                $this->db->where(
                  array(
                  'kduser_pengalaman' => $kduser_pengalaman,
                  'kduser_regis' => $kdregis
                   ) 
                  );
                $this->db->update('m_user_pengalaman', $dt_pengalaman);
                $this->session->set_flashdata('save_pengalaman', "Data berhasil disimpan");
                header('location:'.base_url().'user/pengalaman/data_pengalaman');   
              } 
     
            }
    //jika tidak submit        
    }
    else
    {
      $data['title']  = $this->title; 
      $page     = "edit";
      $data['edit'] = $this->pengalaman_model->edit($kduser_pengalaman,$kdregis)->row();        
      $this->template($page,$data);
    }

             
           


    
  }

  
}