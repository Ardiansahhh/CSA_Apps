<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('All_model', 'all');
    }

    public function index() {
        $this->cart->destroy();
        $data = array('salesman'  => $this->all->get_all('salesman'),
                      'menu'      => 'Data Salesman',
                      'content'   => 'Admin/salesman/data_salesman');
        $this->load->view('layout/wrapper', $data);
    }

    public function tambah() {
        if(isset($_POST['tambah'])) {
            $data = array('nama'     => strtoupper($this->input->post('nama', true)),
                          'no_telp'  => $this->input->post('no_telp', true));
            $this->all->in($data, 'salesman');
            $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Disimpan</div>');
            redirect(base_url('Salesman/'), 'refresh'); 
        } else {
              $this->session->set_flashdata('flash', '<div class="alert alert-danger text-center" role="alert">Anda Belum Memasukkan Data</div>');
            redirect(base_url('Salesman/'), 'refresh'); 
        }
    }

    public function edit($kode) {
        if(isset($_POST['edit'])) {
                    $data = array('nama'     => strtoupper($this->input->post('nama', true)),
                                  'no_telp'  => $this->input->post('no_telp', true));
                    $this->all->edit($data, 'salesman', array('kode' => $kode));
                    $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Berhasil Diubah</div>');
                    redirect(base_url('Salesman/'), 'refresh');
                } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Anda belum memilih data salesman</div>');
                redirect(base_url('Salesman/'), 'refresh');
            }
        }
}