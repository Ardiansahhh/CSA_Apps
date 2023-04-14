<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('All_model', 'all');
	}

	public function index()
	{
		$this->cart->destroy();
		$data = array(
			'data'    => $this->all->get_all('group_area'),
			'menu'      => 'Group Area',
			'content'   => 'Admin/group/data_group'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function tambah()
	{
		if (!isset($_POST['tambah'])) {
			redirect(base_url('Group'), 'refresh');
		} else {
			$nopol  = $this->input->post('no_polisi', true);
			$cNopol = $this->db->query("SELECT * FROM group_area WHERE no_polisi = '$nopol'")->row();
			if ($cNopol != NULL) {
				$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">No.Kendaraan sudah ada/div>');
				redirect(base_url('Group'), 'refresh');
			} else {
				$data = array(
					'no_polisi' => $nopol,
					'kubikasi'  => 0
				);
				$this->all->in($data, 'group_area');
				redirect(base_url('Group'), 'refresh');
			}
		}
	}

	public function pilih($noPol)
	{
		$data = array(
			'data'    => $this->db->query("SELECT * FROM undelivery ORDER BY no_urut ASC")->result(),
			'menu'    => 'Pilih Toko',
			'content' => 'Admin/group/pilih_toko',
			'no_polisi' => $noPol
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function cluster($nopol)
	{
		$data = $this->db->query("SELECT DISTINCT ruang_lingkup FROM undelivery")->result();
		$htg_kubikasi = $this->db->query("SELECT DISTINCT ruang_lingkup FROM kubikasi_ctn")->result();
		if ($data != NULL) {
			$data = array(
				'data_filter' => $data,
				'data_kab'    => $this->all->get_all('kabupaten'),
				'menu'        => 'Pengelompokkan Ruang Lingkup',
				'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
				'content'     => 'Admin/group/cluster',
				'no_polisi'   => $nopol
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Group/'), 'refresh');
		}
	}

	// untuk data foreach
	public function tambah_toko($ruang, $nopol)
	{
		$toko = $this->db->query("SELECT * FROM undelivery WHERE ruang_lingkup = '$ruang'")->result();
		$detail_order = $this->db->query("SELECT * FROM detail_item_undelivery WHERE ruang_lingkup = '$ruang'")->result();
		$hitung_kubikasi = $this->all->get_all('detail_order_area');
		if ($toko != NULL) {
			foreach ($toko as $t) {
				$check_no_sales = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$t->no_sales_order'")->row();
				if ($check_no_sales == NULL) {
					$data = array(
						'no_polisi'      => $nopol,
						'no_sales_order' => $t->no_sales_order,
						'kode_toko'      => $t->kode_toko,
						'ruang_lingkup'  => $t->ruang_lingkup
					);
					$this->all->in($data, 'detail_group_area');
				}
			}
			foreach ($detail_order as $d) {
				$check_brg = $this->db->query("SELECT * FROM detail_order_area WHERE no_polisi = '$nopol' AND kode_barang = '$d->kode_barang'")->row();
				$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row();
				$qty_master_db    = $barang->isi;
				$qty_master_order = $d->kuantiti;
				$qty_half_db      = (int)$barang->isi / 2;
				if ($check_brg == NULL) {
					if ($qty_master_order >= $qty_master_db) {
						$qty_ctn = floor((int)$qty_master_order / (int)$qty_master_db);
						$qty_pcs = (int)$qty_master_order - ((int)$qty_ctn * (int)$qty_master_db);
						if ($qty_pcs >= $qty_half_db) {
							$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
							$data = array(
								'no_polisi'   => $nopol,
								'kode_barang' => $d->kode_barang,
								'qty'         => $d->kuantiti,
								'kubikasi'    => $kubik,
								'harga'       => $d->harga
							);
							$this->all->in($data, 'detail_order_area');
						} else {
							$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
							$data = array(
								'no_polisi'   => $nopol,
								'kode_barang' => $d->kode_barang,
								'qty'         => $d->kuantiti,
								'kubikasi'    => $kubik,
								'harga'       => $d->harga
							);
							$this->all->in($data, 'detail_order_area');
						}
					} else {
						if ($qty_master_order >= $qty_half_db) {
							$data = array(
								'no_polisi'   => $nopol,
								'kode_barang' => $d->kode_barang,
								'qty'         => $d->kuantiti,
								'kubikasi'    => $barang->kubikasi,
								'harga'       => $d->harga
							);
							$this->all->in($data, 'detail_order_area');
						} else {
							$data = array(
								'no_polisi'   => $nopol,
								'kode_barang' => $d->kode_barang,
								'qty'         => $d->kuantiti,
								'kubikasi'    => 0,
								'harga'       => $d->harga
							);
							$this->all->in($data, 'detail_order_area');
						}
					}
				} else {
					$isi      = $check_brg->qty;
					$edit_isi = (int)$d->kuantiti + (int)$isi;
					$editharga    = (int)$check_brg->harga + (int)$d->harga;
					if ($edit_isi >= $qty_master_db) {
						$qty_ctn = floor((int)$edit_isi / (int)$qty_master_db);
						$qty_pcs = (int)$edit_isi - ((int)$qty_ctn * (int)$qty_master_db);
						if ($qty_pcs >= $qty_half_db) {
							$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
							$this->db->query("UPDATE detail_order_area SET qty = '$edit_isi', kubikasi = '$kubik', harga = '$editharga' WHERE no_polisi = '$nopol' AND kode_barang = '$d->kode_barang'");
						} else {
							$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
							$this->db->query("UPDATE detail_order_area SET qty = '$edit_isi', kubikasi = '$kubik', harga = '$editharga' WHERE no_polisi = '$nopol' AND kode_barang = '$d->kode_barang'");
						}
					} else {
						if ($edit_isi >= $qty_half_db) {
							$kubik = (int)$barang->kubikasi;
							$this->db->query("UPDATE detail_order_area SET qty = '$edit_isi', kubikasi = '$kubik', harga = '$editharga' WHERE no_polisi = '$nopol' AND kode_barang = '$d->kode_barang'");
						} else {
							$this->db->query("UPDATE detail_order_area SET qty = '$edit_isi', kubikasi = 0, harga = '$editharga' WHERE no_polisi = '$nopol' AND kode_barang = '$d->kode_barang'");
						}
					}
				}
			}
			redirect(base_url('Group/cluster/' . $nopol), 'refresh');
		}
	}

	public function delt()
	{
		$this->db->query("DELETE FROM detail_group_area");
		$this->db->query("DELETE FROM detail_order_area");
		redirect(base_url('Group/'), 'refresh');
	}


	public function detail($nopol)
	{
		$toko = $this->db->query("SELECT * FROM detail_group_area WHERE no_polisi = '$nopol' ORDER BY no_sales_order ASC")->result();
		if ($toko != NULL) {
			$data = array(
				'data'    => $toko,
				'menu'    => 'Pilih Toko',
				'content' => 'Admin/group/detail_toko',
				'no_polisi' => $nopol
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			redirect(base_url('Group/'), 'refresh');
		}
	}

	public function itemDetail($no_sales_order)
	{
		$toko = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$no_sales_order'")->row();
		$data = array(
			'detail'    => $this->all->get_result(array('no_sales_order' => $no_sales_order), 'detail_item_undelivery'),
			'menu'      => 'Sales Order ' . $no_sales_order . ' - ' . $toko->nama_toko . '',
			'no_sales_order' => $no_sales_order,
			'content'   => 'Admin/delivery/detail_order'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function print_toko($nopol)
	{
		$toko = $this->db->query("SELECT * FROM detail_group_area WHERE no_polisi = '$nopol' ORDER BY no_sales_order ASC")->result();
		$toko2 = $this->db->query("SELECT A.no_polisi, A.no_sales_order, A.kode_toko, A.ruang_lingkup, SUM(B.kubikasi) AS KUBIKASI FROM detail_group_area AS A 
		                           LEFT JOIN detail_item_undelivery AS B ON 
								   A.no_sales_order = B.no_sales_order AND A.ruang_lingkup = B.ruang_lingkup 
								   WHERE A.no_polisi = '$nopol'
								   GROUP BY A.no_polisi, A.no_sales_order, A.kode_toko, A.ruang_lingkup")->result();
		$kubikasi = $this->db->query("SELECT SUM(kubikasi) AS kubikasi FROM detail_order_area WHERE no_polisi = '$nopol'")->row();
		if ($toko != NULL) {
			$data = array(
				'data'    => $toko2,
				'menu'    => 'Pilih Toko',
				'content' => 'Admin/group/print_toko',
				'no_polisi' => $nopol,
				'kubikasi' => $kubikasi
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			redirect(base_url('Group/'), 'refresh');
		}
	}

	// untuk persatuan
	public function simpan()
	{
		if (!isset($_POST['simpan'])) {
			redirect(base_url('Group/'), 'refresh');
		} else {
			$nopol = $this->input->post('no_polisi', true);
			$no_sales_order = $this->input->post('no_sales_order', true);
			$kode_toko = $this->input->post('kode_toko', true);
			$ruang = $this->input->post('ruang_lingkup', true);
			$a = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$no_sales_order'")->result();
			$check_no_sales = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$no_sales_order'")->row();
			if ($check_no_sales == NULL) {
				$data = array(
					'no_polisi'      => $nopol,
					'no_sales_order' => $no_sales_order,
					'kode_toko'      => $kode_toko,
					'ruang_lingkup'  => $ruang
				);
				$this->all->in($data, 'detail_group_area');
				foreach ($a as $b) {
					$check_barang = $this->db->query("SELECT * FROM detail_order_area WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'")->row();
					$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$b->kode_barang'")->row();
					$qty_master_db    = $barang->isi;
					$qty_master_order = $b->kuantiti;
					$qty_half_db      = (int)$barang->isi / 2;
					if ($check_barang == NULL) {
						if ($qty_master_order >= $qty_master_db) {
							$qty_ctn = floor((int)$qty_master_order / (int)$qty_master_db);
							$qty_pcs = (int)$qty_master_order - ((int)$qty_ctn * (int)$qty_master_db);
							if ($qty_pcs >= $qty_half_db) {
								$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							} else {
								$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							}
						} else {
							if ($qty_master_order >= $qty_half_db) {
								$kubik = $barang->kubikasi;
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							} else {
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => 0,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							}
						}
					} else {
						$qty_now = $check_barang->qty;
						$qty_edit = (int)$b->kuantiti + (int)$qty_now;
						$edit = (int)$check_barang->harga + (int)$b->harga;
						if ($qty_edit >= $qty_master_db) {
							$qty_ctn = floor((int)$qty_edit / (int)$qty_master_db);
							$qty_pcs = (int)$qty_edit - ((int)$qty_ctn * (int)$qty_master_db);
							if ($qty_pcs >= $qty_half_db) {
								$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$kubik', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							} else {
								$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$kubik', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							}
						} else {
							if ($qty_edit >= $qty_half_db) {
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$barang->kubikasi', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							} else {
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = 0, harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							}
						}
					}
				}
				redirect(base_url('Group/pilih/' . $nopol), 'refresh');
			} else {
				redirect(base_url('Group/'), 'refresh');
			}
		}
	}

	public function delete()
	{
		if (!isset($_POST['delete'])) {
			redirect(base_url('Group/'), 'refresh');
		} else {
			$no_sales = $this->input->post('no_sales_order', true);
			$no = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$no_sales'")->row();
			$detail_item = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$no_sales'")->result();
			if ($no != NULL) {
				$no_polisi = $no->no_polisi;
				foreach ($detail_item as $d) {
					$item = $this->db->query("SELECT * FROM detail_order_area WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'")->row();
					$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row();
					if ($item != NULL) {
						$jumlah = (int)$item->qty;
						$edit_jumlah = $jumlah - (int)$d->kuantiti;
						$revisi_hrg = (int)$item->harga - (int)$d->harga;
						$qty_half_db = (int)$barang->isi / 2;
						if ($edit_jumlah <= 0) {
							$this->db->query("DELETE FROM detail_order_area WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'");
						} else {
							if ((int)$edit_jumlah >= (int)$d->kuantiti) {
								$qty_ctn = floor((int)$edit_jumlah / (int)$barang->isi);
								$qty_pcs = (int)$edit_jumlah - ((int)$qty_ctn * (int)$barang->isi);
								if ((int)$qty_pcs >= $qty_half_db) {
									$kubikasi = ((int)$qty_ctn * (int)$barang->kubikasi) + (int)$barang->kubikasi;
									$this->db->query("UPDATE detail_order_area SET qty = '$edit_jumlah', kubikasi = '$kubikasi', harga = '$revisi_hrg' WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'");
								} else {
									$kubikasi = ((int)$qty_ctn * (int)$barang->kubikasi);
									$this->db->query("UPDATE detail_order_area SET qty = '$edit_jumlah', kubikasi = '$kubikasi', harga = '$revisi_hrg' WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'");
								}
							} else {
								if ((int)$edit_jumlah >= $qty_half_db) {
									$this->db->query("UPDATE detail_order_area SET qty = '$edit_jumlah', kubikasi = '$barang->kubikasi', harga = '$revisi_hrg' WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'");
								} else {
									$this->db->query("UPDATE detail_order_area SET qty = '$edit_jumlah', kubikasi = 0, harga = '$revisi_hrg' WHERE no_polisi = '$no_polisi' AND kode_barang = '$d->kode_barang'");
								}
							}
						}
					}
				}
				$this->db->query("DELETE FROM detail_group_area WHERE no_sales_order = '$no_sales'");
				redirect(base_url('Group/detail/' . $no_polisi), 'refresh');
			} else {
				redirect(base_url('Group/detail/' . $no->no_polisi), 'refresh');
			}
		}
	}

	public function detail_toko($kode_ruang, $nopol)
	{
		$query = $this->db->query("SELECT * FROM ((undelivery INNER JOIN tb_ruang_lingkup ON undelivery.ruang_lingkup = tb_ruang_lingkup.kode_ruang) INNER JOIN tb_customer ON undelivery.kode_toko = tb_customer.kode_toko) WHERE undelivery.ruang_lingkup = '$kode_ruang' ORDER BY undelivery.no_urut ASC")->result();
		$total = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM kubikasi_ctn WHERE ruang_lingkup = '$kode_ruang'")->row();
		if ($query != NULL) {
			$data = array(
				'data_cust' => $query,
				'kubikasi'  => $total->kubik,
				'menu'      => 'Detail Toko',
				'no_polisi' => $nopol,
				'content'   => 'Admin/group/detail'
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Area/detail/' . $kode_ruang), 'refresh');
		}
	}

	public function simpan_toko()
	{
		if (!isset($_POST['simpan'])) {
			redirect(base_url('Group/'), 'refresh');
		} else {
			$nopol = $this->input->post('no_polisi', true);
			$no_sales_order = $this->input->post('no_sales_order', true);
			$kode_toko = $this->input->post('kode_toko', true);
			$ruang = $this->input->post('ruang_lingkup', true);
			$a = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$no_sales_order'")->result();
			$check_no_sales = $this->db->query("SELECT * FROM detail_group_area WHERE no_sales_order = '$no_sales_order'")->row();
			if ($check_no_sales == NULL) {
				$data = array(
					'no_polisi'      => $nopol,
					'no_sales_order' => $no_sales_order,
					'kode_toko'      => $kode_toko,
					'ruang_lingkup'  => $ruang
				);
				$this->all->in($data, 'detail_group_area');
				foreach ($a as $b) {
					$check_barang = $this->db->query("SELECT * FROM detail_order_area WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'")->row();
					$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$b->kode_barang'")->row();
					$qty_master_db    = $barang->isi;
					$qty_master_order = $b->kuantiti;
					$qty_half_db      = (int)$barang->isi / 2;
					if ($check_barang == NULL) {
						if ($qty_master_order >= $qty_master_db) {
							$qty_ctn = floor((int)$qty_master_order / (int)$qty_master_db);
							$qty_pcs = (int)$qty_master_order - ((int)$qty_ctn * (int)$qty_master_db);
							if ($qty_pcs >= $qty_half_db) {
								$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							} else {
								$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							}
						} else {
							if ($qty_master_order >= $qty_half_db) {
								$kubik = $barang->kubikasi;
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => $kubik,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							} else {
								$data = array(
									'no_polisi' => $nopol,
									'kode_barang' => $b->kode_barang,
									'qty'         => $b->kuantiti,
									'kubikasi'    => 0,
									'harga'       => $b->harga
								);
								$this->all->in($data, 'detail_order_area');
							}
						}
					} else {
						$qty_now = $check_barang->qty;
						$qty_edit = (int)$b->kuantiti + (int)$qty_now;
						$edit = (int)$check_barang->harga + (int)$b->harga;
						if ($qty_edit >= $qty_master_db) {
							$qty_ctn = floor((int)$qty_edit / (int)$qty_master_db);
							$qty_pcs = (int)$qty_edit - ((int)$qty_ctn * (int)$qty_master_db);
							if ($qty_pcs >= $qty_half_db) {
								$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$kubik', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							} else {
								$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$kubik', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							}
						} else {
							if ($qty_edit >= $qty_half_db) {
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = '$barang->kubikasi', harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							} else {
								$this->db->query("UPDATE detail_order_area SET qty = '$qty_edit', kubikasi = 0, harga = '$edit' WHERE no_polisi = '$nopol' AND kode_barang = '$b->kode_barang'");
							}
						}
					}
				}
				redirect(base_url('Group/detail_toko/' . $ruang . '/' . $nopol), 'refresh');
			} else {
				redirect(base_url('Group/'), 'refresh');
			}
		}
	}

	public function detailOrder($nopol)
	{
		$data = $this->db->query("SELECT A.no_urut, A.no_polisi, A.kode_barang, A.qty, A.kubikasi, A.harga, B.nama_barang, B.isi, B.grup FROM detail_order_area AS A
		                          LEFT JOIN barang AS B ON
								  A.kode_barang = B.kode_barang 
								  WHERE A.no_polisi = '$nopol'
								  ORDER BY B.grup, B.nama_barang")->result();
		$kubikasi = $this->db->query("SELECT SUM(kubikasi) AS kubikasi FROM detail_order_area WHERE no_polisi = '$nopol'")->row();
		if ($data != NULL) {
			$data = array(
				'detail'    => $data,
				'no_polisi' => $nopol,
				'menu'      => 'Detail Barang',
				'kubikasi'  => $kubikasi->kubikasi,
				'content'   => 'Admin/group/detail_order'
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			redirect(base_url('Group/'), 'refresh');
		}
	}
}
