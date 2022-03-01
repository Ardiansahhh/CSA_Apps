<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_urgent extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        // $this->cart->destroy();
        $data = array('barang'      => $this->all->get_all('barang'),
                      'toko'        => $this->db->query("SELECT * FROM tb_customer ORDER BY kode_toko ASC")->result(),
                      'toko_urgent' => $this->all->get_all('urgent'),
                      'menu'        => 'Menu Barang',
                      'invoice'     => strtoupper(random_string('alnum', 8)),
                      'content'     => 'Admin/sales/form_urgent');
        $this->load->view('layout/wrapper', $data);
    }

    public function cart() {
        $invoice   = $this->input->post('invoice');
        $toko      = $this->input->post('kode_toko');
        $data   = array('no_pesanan'  => $invoice,
                        'toko'        => $toko,
                        'tanggal'     => date('Y-m-d h:i:s'));
        $this->all->in($data, 'urgent');
        redirect(base_url('Form_urgent'), 'refresh');
    }

    public function delt_urgent($no_pesanan) {
        $this->all->delt(array('no_pesanan' => $no_pesanan), 'detail_urgent');
        $this->all->delt(array('no_pesanan' => $no_pesanan), 'urgent');
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
        redirect(base_url('Form_urgent'), 'refresh');
    } 

    public function detail_order($no_pesanan) {
        $this->cart->destroy();
        $data = array('detail'    => $this->all->get_result(array('no_pesanan' => $no_pesanan), 'detail_urgent'),
                      'menu'      => 'Detail Order',
                      'no_pesanan'=> $no_pesanan,
                      'content'   => 'Admin/detail/detail_urgent');
        $this->load->view('layout/wrapper', $data);
    }

    public function tambah_detail() {
        if(isset($_POST['tambah'])) {
            $kode_brg = $this->input->post('kode', true);
            $no_pesan = $this->input->post('no_pesanan', true);
            $get      = $this->all->get(array('kode_barang' => $kode_brg), 'barang');
            $disc     = $this->input->post('disc', true);
            $ctn      = $this->input->post('ctn', true);
            $pcs      = $this->input->post('pcs', true);
            $ext      = $this->input->post('ext', true);
            if($ctn == NULL) {
                $before_disc1 = ($pcs * $get->harga);
                if($disc == NULL) {
                    $after_disc1  = $before_disc1 - 0;
                    $data = array('no_pesanan'   => $no_pesan,
                                  'kode_barang'  => $kode_brg,
                                  'ctn'          => $ctn,
                                  'pcs'          => $pcs,
                                  'ext'          => $ext,
                                  'harga'        => $get->harga,
                                  'disc'         => 0,
                                  'subtotal'     => $before_disc1,
                                  'after_disc'   => $after_disc1);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                } else {
                    $disc1        = ($disc/100) * $before_disc1;
                    $after_disc1  = $before_disc1 - $disc1;
                    $data = array('no_pesanan'   => $no_pesan,
                                'kode_barang'  => $kode_brg,
                                'ctn'          => $ctn,
                                'pcs'          => $pcs,
                                'ext'          => $ext,
                                'harga'        => $get->harga,
                                'disc'         => $disc,
                                'subtotal'     => $before_disc1,
                                'after_disc'   => $after_disc1);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                } 
            } elseif($pcs == NULL) {
                $before_disc2 = (($ctn * $get->isi) * $get->harga);
                if($disc == NULL) {
                    $after_disc2  = $before_disc2 - 0;
                    $data = array('no_pesanan'   => $no_pesan,
                                'kode_barang'  => $kode_brg,
                                'ctn'          => $ctn,
                                'pcs'          => $pcs,
                                'ext'          => $ext,
                                'harga'        => $get->harga,
                                'disc'         => 0,
                                'subtotal'     => $before_disc2,
                                'after_disc'   => $after_disc2);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                } else {
                    $disc2        = ($disc/100) * $before_disc2;
                    $after_disc2  = $before_disc2 - $disc2;
                    $data = array('no_pesanan'   => $no_pesan,
                                'kode_barang'  => $kode_brg,
                                'ctn'          => $ctn,
                                'pcs'          => $pcs,
                                'ext'          => $ext,
                                'harga'        => $get->harga,
                                'disc'         => $disc,
                                'subtotal'     => $before_disc2,
                                'after_disc'   => $after_disc2);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                }
            } else {
                $before_disc3 = ((($ctn * $get->isi ) + $pcs) * $get->harga);
                if($disc == NULL) {
                    $after_disc3  = $before_disc3 - 0;
                    $data = array('no_pesanan'   => $no_pesan,
                                  'kode_barang'  => $kode_brg,
                                  'ctn'          => $ctn,
                                  'pcs'          => $pcs,
                                  'ext'          => $ext,
                                  'harga'        => $get->harga,
                                  'disc'         => 0,
                                  'subtotal'     => $before_disc3,
                                  'after_disc'   => $after_disc3);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                } else {
                    $disc3        = ($disc/100) * $before_disc3;
                    $after_disc3  = $before_disc3 - $disc3;
                    $data = array('no_pesanan' => $no_pesan,
                                'kode_barang'  => $kode_brg,
                                'ctn'          => $ctn,
                                'pcs'          => $pcs,
                                'ext'          => $ext,
                                'harga'        => $get->harga,
                                'disc'         => $disc,
                                'subtotal'     => $before_disc3,
                                'after_disc'   => $after_disc3);
                    $this->all->in($data, 'detail_urgent');
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
                    redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh');
                }
            } 
        } else {
              $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Anda Belum Memasukkan Data</div>');
            redirect(base_url('Form_urgent/detail_order/'.$no_pesan), 'refresh'); 
        }
    }


    public function invoice($no_pesanan) {
        $get     = $this->all->get(array('no_pesanan' => $no_pesanan), 'urgent');
        $detail  = $this->all->get_result(array('no_pesanan' => $no_pesanan), 'detail_urgent');
        $data    = array('data_urgent'  => $get,
                         'detail'       => $detail,
                         'no_pesanan'   => $no_pesanan,
                         'menu'         => 'Cetak Faktur',
                         'content'      => 'Admin/detail/invoice');
        $this->load->view('layout/wrapper', $data);
    }

    public function print($no_pesanan) {
        $get     = $this->all->get(array('no_pesanan' => $no_pesanan), 'urgent');
        $detail  = $this->all->get_result(array('no_pesanan' => $no_pesanan), 'detail_urgent');
        $data    = array('data_urgent'  => $get,
                         'detail'       => $detail,
                         'no_pesanan'   => $no_pesanan,
                         'menu'         => 'Cetak Faktur',
                         'content'      => 'Admin/detail/print_faktur');
        $this->load->view('layout/wrapper', $data);
    }

}