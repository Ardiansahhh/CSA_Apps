<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        // $this->cart->destroy();
        $data = array('barang'    => $this->all->get_all('barang'),
                      'grup'      => $this->db->query("SELECT DISTINCT grup FROM barang")->result(),
                      'salesman'  => $this->all->get_all('salesman'),
                      'pinjam'    => $this->all->get_all('pinjam'),
                      'menu'      => 'Menu Barang',
                      'invoice'   => strtoupper(random_string('alnum', 16)),
                      'content'   => 'Admin/sales/form_sales');
        $this->load->view('layout/wrapper', $data);
    }

    public function cart() {
        $get       = $this->input->post('kode_barang');
        $jumlah    = $this->input->post('jumlah');
        $ext       = $this->input->post('extra');
        $reason    = $this->input->post('alasan');
        $salesman  = $this->input->post('salesman');
        $barang    = $this->all->get(array('kode_barang' => $get), 'barang');
        $c_sales   = $this->all->get(array('kode' => $salesman), 'salesman');
        if($jumlah >= $barang->isi) {
           $mod    = $jumlah%$barang->isi;
           $bagi   = floor($jumlah/$barang->isi);
           $data   = array('kode'    => $barang->kode_barang,
                           'nama'    => $barang->nama_barang,
                           'ctn'     => $bagi,
                           'pcs'     => $mod,
                           'extra'   => $ext,
                           'harga'   => $barang->harga,
                           'peminjam'=> $c_sales->nama,
                           'alasan'  => $reason);
            $this->all->in($data, 'pinjam');
            redirect(base_url('Sales'), 'refresh');
        } elseif($jumlah < $barang->isi) {
           $pcs    = $jumlah;
           $data   = array('kode'    => $barang->kode_barang,
                           'nama'    => $barang->nama_barang,
                           'ctn'     => '',
                           'pcs'     => $pcs,
                           'extra'   => $ext,
                           'harga'   => $barang->harga,
                           'peminjam'=> $c_sales->nama,
                           'alasan'  => $reason);
            $this->all->in($data, 'pinjam');
            redirect(base_url('Sales'), 'refresh');
        }
    }

    public function delt() {
        $this->db->query("DELETE FROM pinjam");
        $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
        redirect(base_url('Sales'), 'refresh');
    } 

    public function invoice() {
      // $this->cart->destroy();
        $data = array('menu'      => 'Menu Barang',
                      'content'   => 'Admin/sales/invoice');
        $this->load->view('layout/wrapper', $data);
    }

}