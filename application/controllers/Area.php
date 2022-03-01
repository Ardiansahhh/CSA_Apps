<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $data = array('data_wilayah' => $this->all->get_all('tb_ruang_lingkup'),
                      'menu'         => 'Menu Wilayah',
                      'content'      => 'Admin/wilayah/data_wilayah');
        $this->load->view('layout/wrapper', $data);
    }

    
    public function tambah_wilayah() {
       $nm_wil = $this->input->post('nama_wilayah', true);
       $kode   = $this->input->post('kode_ruang', true);
       $query  = $this->all->get(array('kode_ruang' => $kode), 'tb_ruang_lingkup');
        if($query != NULL) {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Kode Telah Digunakan</div>');
            redirect(base_url('Area'), 'refresh');
        } else {
            $data = array('kode_ruang'   => $kode,
                          'nama_wilayah' => $nm_wil,
                          'set_wilayah'  => 0);
            $this->all->in($data, 'tb_ruang_lingkup');
            $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
            redirect(base_url('Area'), 'refresh');
        }
    }

    public function reset() {
        $this->db->query("UPDATE tb_customer SET ruang_lingkup = '', set_wilayah = 0 ");
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disetting</div>');
        redirect(base_url('Area'), 'refresh');
    }

    public function pilih($kode_ruang) {
        if(isset($_POST['data'])) {
            $kode  = implode(', ', $_POST['kode_toko']);
            $hasil = explode(',', $kode);
            $in    = count($hasil);
            if(!empty($_POST['kode_toko'])) {
                foreach($_POST['kode_toko'] as $kode) {
                    $save[] = $kode;
                    for($i = 0; $i < count($save); $i++) {
                        $k = $save[$i];
                        $this->all->edit(array('ruang_lingkup' => $kode_ruang,
                                               'set_wilayah'   => 1), 'tb_customer', array('kode_toko' => $k));
                    }
                }
               $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disetting</div>');
               redirect(base_url('Area/input_toko/'.$kode_ruang), 'refresh');   
            } 
        }  
    }

    public function input_toko($kode_ruang) {
        $this->cart->destroy();
        $wil  = $this->all->get(array('kode_ruang' => $kode_ruang), 'tb_ruang_lingkup');
        $data = array('data_cust' => $this->db->query("SELECT * FROM tb_customer WHERE set_wilayah = 0")->result(),
                      'menu'      => 'Menentukan Ruang Lingkup Toko',
                      'kode_ruang'=> $kode_ruang,
                      'wilayah'   => $wil->nama_wilayah,
                      'content'   => 'Admin/wilayah/data_toko_wilayah');
        $this->load->view('layout/wrapper', $data);
    }

    public function edit_wilayah($id_wilayah) {
        if(isset($_POST['editdata'])) {
            $query = $this->all->get(array('id_urut' => $id_wilayah), 'tb_ruang_lingkup');
            if($query != NULL) {
                $kode = $this->input->post('kode_ruang', true);
                $nama = $this->input->post('nama_wilayah', true);
                $data = array('kode_ruang' => $kode,
                            'nama_wilayah' => $nama);
                $this->all->edit($data, 'tb_ruang_lingkup', array('id_urut' => $id_wilayah));
                $this->db->query("UPDATE tb_customer SET ruang_lingkup = '$kode' WHERE ruang_lingkup = '$query->kode_ruang'");
                $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Diubah</div>');
                redirect(base_url('Area'), 'refresh');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
                redirect(base_url('Area'), 'refresh');
            } 
        } else {
            redirect(base_url('Area'), 'refresh');
        }
    }

    public function detail_toko($kode_ruang) {
        $query = $this->db->query("SELECT * FROM tb_customer INNER JOIN tb_ruang_lingkup ON tb_customer.ruang_lingkup = tb_ruang_lingkup.kode_ruang WHERE tb_customer.ruang_lingkup = '$kode_ruang'")->result();
        if($query != NULL) {
            $data = array('data_kab'  => $this->all->get_all('kabupaten'), 
                          'kode_ruang' => $kode_ruang,
                          'data_cust' => $query,
                          'menu'      => 'Detail Toko',
                          'content'   => 'Admin/wilayah/detail_toko');
            $this->load->view('layout/wrapper', $data);
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
            redirect(base_url('Area/detail_toko/'.$kode_ruang), 'refresh');
        }
    }
}