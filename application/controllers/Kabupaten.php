<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $data = array('data_kab' => $this->all->get_all('kabupaten'),
                      'menu'     => 'Menu Kabupaten',
                      'content'  => 'Admin/wilayah/data_kabupaten');
        $this->load->view('layout/wrapper', $data);
    }

    public function tambah() {
        $nm_wil = $this->input->post('nama', true);
        $kode   = $this->input->post('id_kab', true);
        $query  = $this->all->get(array('id_kab' => $kode), 'kabupaten');
         if($query != NULL) {
             $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Kode Telah Digunakan</div>');
             redirect(base_url('Kabupaten'), 'refresh');
         } else {
             $data = array('id_kab'   => $kode,
                           'nama' => $nm_wil);
             $this->all->in($data, 'kabupaten');
             $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
             redirect(base_url('Kabupaten'), 'refresh');
         }
     }

     public function edit_kab($id) {
        if(isset($_POST['editdata'])) {
            $query = $this->all->get(array('id_kab' => $id), 'kabupaten');
            if($query != NULL) {
                $kode = $this->input->post('id_kab', true);
                $nama = $this->input->post('nama', true);
                $data = array('id_kab' => $kode,
                              'nama' => $nama);
                $this->all->edit($data, 'kabupaten', array('id_kab' => $id));
                // $this->db->query("UPDATE tb_customer SET id_kab = '$kode' WHERE id_kab = '$query->id_kab'");
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Diubah</div>');
                redirect(base_url('Kabupaten'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
                redirect(base_url('Kabupaten'), 'refresh');
            } 
        } else {
            redirect(base_url('Kabupaten'), 'refresh');
        }
    }

    public function all_area($kode) {
        if(isset($_POST['filter'])) {
                $kab = $this->input->post('kode_kab');
                $data = array('id_kab' => $kab);
                $this->all->edit($data, 'tb_customer', array('ruang_lingkup' => $kode));
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disetting</div>');
                redirect(base_url('Area/detail_toko/'.$kode), 'refresh');
        } else {
            redirect(base_url('Area'), 'refresh');
        }
    }

}