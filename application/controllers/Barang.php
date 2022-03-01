<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $this->cart->destroy();
        $data = array('barang'    => $this->all->get_all('barang'),
                      'grup'      => $this->db->query("SELECT DISTINCT grup FROM barang")->result(),
                      'menu'      => 'Menu Barang',
                      'content'   => 'Admin/barang/data_barang');
        $this->load->view('layout/wrapper', $data);
    }

    public function csv() {
        if(!isset($_POST['import'])) {
            $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Maaf anda belum meilih data</div>');
            redirect(base_url('Barang'), 'refresh');
        } else {
            $this->cart->destroy();
            $fileName = $_FILES["csv"]["tmp_name"];
            if($_FILES["csv"]["size"] > 0) {
                $file = fopen($fileName, "r");
                while(($column = fgetcsv($file, 10000, ";")) !== false ) {
                    $query = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$column[0]'")->row();
                    if($query != NULL) {
                        $data = array('id'      => $query->kode_barang,
                                      'qty'     => 1,
                                      'price'   => 1,
                                      'name'    => $query->nama_barang);
                        $this->cart->insert($data);
                     } elseif($query == NULL) {
                        $data = array('kode_barang'   => $column[0],
                                      'nama_barang'   => $column[1],
                                      'harga'         => $column[4],
                                      'grup'          => $column[2],
                                      'isi'           => $column[3]);
                        $this->all->in($data, 'barang');
                    }
                } 
                if(!empty($this->cart->contents())) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Data Ganda terdeteksi</div>');
                    redirect(base_url('Barang'), 'refresh');
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Ditambahkan</div>');
                    redirect(base_url('Barang'), 'refresh');
                }
            }
        }
    }

     public function delt() {
        $this->db->query("DELETE FROM barang");
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
        redirect(base_url('Barang'), 'refresh');
    }

    public function filter_barang() {
            if(isset($_POST['filter'])) {
                $grup  = $this->input->post('grup', true);
                $query = $this->all->get_result(array('grup' => $grup), 'barang');
                if($query != NULL) {
                    $data = array('barang'   => $query,
                                  'menu'     => 'Menu Barang',
                                  'grup'      => $this->db->query("SELECT DISTINCT grup FROM barang")->result(),
                                  'content'  => 'Admin/barang/filter_barang');
                   $this->load->view('layout/wrapper', $data);
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">>Kode Toko '.$kode.' Tidak Ditemukan</div>');
                    redirect(base_url('Barang'), 'refresh');
                }
            }
        }

}