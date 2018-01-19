<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_Model extends CI_Model {

public function edit($kdbarang){
	$query = $this->db->query("
select u.k_umum,u.idk_umum,kb.idk_barang,kb.k_barang,kel.idkelompokbarang,kel.kelompokbarang,
    sat.kdsatuan,sat.satuan,jn.jenisbarang,jn.kdjenisbarang,
      bar.kdbarang,bar.barang,bar.harga
        from 
      m_barang as bar inner join m_k_umum as u on u.idk_umum=bar.idk_umum 
      inner join m_k_barang as kb on kb.idk_barang=bar.idk_barang
      inner join m_kelompokbarang as kel on kel.idkelompokbarang=bar.idkelompokbarang
      inner join m_satuan as sat on sat.kdsatuan=bar.kdsatuan
      inner join m_jenisbarang as jn on jn.kdjenisbarang=bar.kdjenisbarang
        WHERE bar.kdbarang = '$kdbarang'
    ");
	return $query;
	}    

function buat_kode()   {
  $this->db->select('RIGHT(m_barang.kdbarang,7) as kode', FALSE);
  $this->db->order_by('kdbarang','DESC');
  $this->db->limit(1);
  $p='BRG';
  $query = $this->db->get('m_barang');      //cek dulu apakah ada sudah ada kode di tabel.
  if($query->num_rows() <> 0){
   //jika kode ternyata sudah ada.
   $data = $query->row();
   $kode = intval($data->kode) + 1;
  }
  else{
   //jika kode belum ada
   $kode = '0000001';
  }
  $kodemax = str_pad($kode,7 , "0", STR_PAD_LEFT);
  $kodejadi = $p.$kodemax;
  return $kodejadi;
 }
}	