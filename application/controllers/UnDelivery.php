<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnDelivery extends CI_Controller
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
			'data'    => $this->db->query("SELECT * FROM undelivery ORDER BY no_urut ASC")->result(),
			'menu'      => 'Belum Terkirim',
			'content'   => 'Admin/delivery/data_delivery'
		);
		$this->load->view('layout/wrapper', $data);
	}

	public function csv()
	{
		if (!isset($_POST['import'])) {
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Maaf anda belum meilih data</div>');
			redirect(base_url('UnDelivery'), 'refresh');
		} else {
			$this->cart->destroy();
			$fileName = $_FILES["csv"]["tmp_name"];
			if ($_FILES["csv"]["size"] > 0) {
				$file = fopen($fileName, "r");
				while (($column = fgetcsv($file, 10000, ";")) !== false) {
					//selama proses import, input semuanya  terlebih dahulu ke tabel detail item undelivery.
					// $qty_order         = (int)$column[6] + (int)$column[7];
					$qty_order         = (int)$column[6] + (int)$column[7];
					$length_string = strlen($column[2]);
					if ($length_string == 1) {
						$kd_toko = '00000' . $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8],
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					} elseif ($length_string == 2) {
						$kd_toko = '0000' . $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8],
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					} elseif ($length_string == 3) {
						$kd_toko = '000' . $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8],
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					} elseif ($length_string == 4) {
						$kd_toko = '00' . $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8],
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					} elseif ($length_string == 5) {
						$kd_toko = '0' . $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8]
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					} else {
						$kd_toko = $column[2];
						$toko = $this->db->query("SELECT * FROM tb_customer WHERE kode_toko LIKE '%$kd_toko%'")->row();
						$check = $this->db->query("SELECT * FROM undelivery WHERE no_sales_order = '$column[0]'")->row();
						$checkbarang = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'")->row();
						if ($check == NULL) {
							$data = array(
								'no_sales_order' => $column[0],
								'tanggal_rilis'  => $column[1],
								'kode_toko'      => $kd_toko,
								'nama_toko'      => $column[3],
								'ruang_lingkup'  => $toko->ruang_lingkup,
								'id_kab'         => $toko->id_kab
							);
							$this->all->in($data, 'undelivery');
						}
						$detail_item = array(
							'no_sales_order' => $column[0],
							'kode_barang' => $column[4],
							'nama_barang' => $column[5],
							'ruang_lingkup' => $toko->ruang_lingkup,
							'kuantiti' => $qty_order,
							'harga' => $column[8],
						);
						$this->all->in($detail_item, 'detail_item_undelivery');
						if ($checkbarang == NULL) {
							//jika data tidak ada, input data baru dengan
							$data = array(
								'ruang_lingkup' => $toko->ruang_lingkup,
								'kode_barang'   => $column[4],
								'pcs'           => $qty_order
							);
							$this->all->in($data, 'kubikasi_ctn');
						} else {
							//jika data ada, edit datanya
							$qty_pcs_db = $checkbarang->pcs;
							$revisi_pcs = (int)$qty_order + (int)$qty_pcs_db;
							$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_pcs' WHERE ruang_lingkup = '$toko->ruang_lingkup' AND kode_barang = '$column[4]'");
						}
					}
				}
				$detail = $this->db->query("SELECT * FROM detail_item_undelivery")->result();
				if ($detail != NULL) {
					foreach ($detail as $d) {
						$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang LIKE '%$d->kode_barang%'")->row();
						$barang_toko = $d->kuantiti;
						$barang_db   = $barang->isi;
						$brg_half    = (int)$barang->isi / 2;
						if ($barang_toko >= $barang_db) {
							$qty_ctn = floor((int)$barang_toko / (int)$barang_db);
							$qty_pcs = (int)$barang_toko - ((int)$qty_ctn * (int)$barang_db);
							if ($qty_pcs >= $brg_half) {
								$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
								$this->db->query("UPDATE detail_item_undelivery SET kubikasi = '$kubik' WHERE no_sales_order = '$d->no_sales_order' AND kode_barang = '$d->kode_barang'");
							} else {
								$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
								$this->db->query("UPDATE detail_item_undelivery SET kubikasi = '$kubik' WHERE no_sales_order = '$d->no_sales_order' AND kode_barang = '$d->kode_barang'");
							}
						} else {
							if ($barang_toko >= $brg_half) {
								$this->db->query("UPDATE detail_item_undelivery SET kubikasi = '$barang->kubikasi' WHERE no_sales_order = '$d->no_sales_order' AND kode_barang = '$d->kode_barang'");
							} else {
								$this->db->query("UPDATE detail_item_undelivery SET kubikasi = 0 WHERE no_sales_order = '$d->no_sales_order' AND kode_barang = '$d->kode_barang'");
							}
						}
					}
				}
				$all_detail = $this->all->get_all('kubikasi_ctn');
				if ($all_detail != NULL) {
					foreach ($all_detail as $detail) {
						$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$detail->kode_barang'")->row();
						if ($barang != NULL) {
							$qty_master_db    = $barang->isi;
							$qty_master_order = $detail->pcs;
							$qty_half_db      = (int)$barang->isi / 2;
							if ($qty_master_order >= $qty_master_db) {
								$qty_ctn = floor((int)$qty_master_order / (int)$qty_master_db);
								$qty_pcs = (int)$qty_master_order - ((int)$qty_ctn * (int)$qty_master_db);
								if ($qty_pcs >= $qty_half_db) {
									$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);
									$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$kubik' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
								} else {
									$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
									$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$kubik' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
								}
							} else {
								if ($qty_master_order >= $qty_half_db) {
									$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$barang->kubikasi' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
								} else {
									$this->db->query("UPDATE kubikasi_ctn SET kubikasi = 0 WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
								}
							}
						}
					}
					// $this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
					redirect(base_url('UnDelivery'), 'refresh');
				}
			}
		}
	}

	public function delt()
	{
		$this->db->query("DELETE FROM kubikasi_ctn");
		$this->db->query("DELETE FROM undelivery");
		$this->db->query("DELETE FROM detail_item_undelivery");
		$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
		redirect(base_url('UnDelivery'), 'refresh');
	}

	public function cluster()
	{
		//$this->db->query("DELETE FROM kubikasi");
		$data = $this->db->query("SELECT DISTINCT ruang_lingkup FROM undelivery")->result();
		$htg_kubikasi = $this->db->query("SELECT DISTINCT ruang_lingkup FROM kubikasi_ctn")->result();
		// $all_detail = $this->all->get_all('kubikasi_ctn');
		// if($all_detail != NULL) {
		// 	foreach($all_detail as $detail) {
		// 		$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$detail->kode_barang'")->row();
		// 		if($barang != NULL) {
		// 			$qty_master_db    = $barang->isi;
		// 			$qty_master_order = $detail->pcs;
		// 			$qty_half_db      = (int)$barang->isi / 2;
		// 			if($qty_master_order >= $qty_master_db) {
		// 				$qty_ctn = floor((int)$qty_master_order / (int)$qty_master_db);
		// 				$qty_pcs = (int)$qty_master_order - ((int)$qty_ctn * (int)$qty_master_db);
		// 				$kubikasi_db = $this->db->query("SELECT * FROM kubikasi WHERE ruang_lingkup = '$detail->ruang_lingkup'")->row();
		// 				if($qty_pcs >= $qty_half_db) {
		// 					$kubik = (int)$barang->kubikasi + ((int)$qty_ctn * (int)$barang->kubikasi);							
		// 					$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$kubik' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
		// 				} else {
		// 					$kubik = (int)$qty_ctn * (int)$barang->kubikasi;
		// 					$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$kubik' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
		// 				}
		// 			} else {
		// 				if($qty_master_order >= $qty_half_db) {
		// 					$this->db->query("UPDATE kubikasi_ctn SET kubikasi = '$barang->kubikasi' WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
		// 				} else {
		// 					$this->db->query("UPDATE kubikasi_ctn SET kubikasi = 0 WHERE ruang_lingkup = '$detail->ruang_lingkup' AND kode_barang = '$detail->kode_barang'");
		// 				}
		// 			}
		// 		} 
		// 	} 
		// foreach($htg_kubikasi as $ht) {
		// 	$a = $this->db->query("SELECT SUM(kubikasi) AS total FROM kubikasi_ctn WHERE ruang_lingkup = '$ht->ruang_lingkup'")->row();
		// 	$check = $this->db->query("SELECT * FROM kubikasi WHERE ruang_lingkup = '$ht->ruang_lingkup'")->row();
		// 	if($check == NULL) {
		// 		$detail_item = array('ruang_lingkup' => $ht->ruang_lingkup,
		// 							 'total_kubikasi' => $a->total);
		// 				$this->all->in($detail_item, 'kubikasi');
		// 	}
		// }
		//}	
		if ($data != NULL) {
			$data = array(
				'data_filter' => $data,
				'data_kab'    => $this->all->get_all('kabupaten'),
				'menu'        => 'Pengelompokkan Ruang Lingkup',
				'lingkup'     => $this->all->get_all('tb_ruang_lingkup'),
				'content'     => 'Admin/delivery/cluster'
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('UnDelivery/'), 'refresh');
		}
	}

	public function detail($kode_ruang)
	{
		$query = $this->db->query("SELECT * FROM ((undelivery INNER JOIN tb_ruang_lingkup ON undelivery.ruang_lingkup = tb_ruang_lingkup.kode_ruang) INNER JOIN tb_customer ON undelivery.kode_toko = tb_customer.kode_toko) WHERE undelivery.ruang_lingkup = '$kode_ruang' ORDER BY undelivery.no_urut ASC")->result();
		$total_kubikasi = $this->db->query("SELECT SUM(kubikasi) AS kubik FROM kubikasi_ctn WHERE ruang_lingkup = '$kode_ruang'")->row();
		if ($query != NULL) {
			$data = array(
				'data_cust' => $query,
				'kode_ruang' => $kode_ruang,
				'total_kubikasi' => (int)$total_kubikasi->kubik,
				'menu'      => 'Detail Toko',
				'content'   => 'Admin/delivery/detail'
			);
			$this->load->view('layout/wrapper', $data);
		} else {
			$this->session->set_flashdata('flash', '<div class="alert alert-warning text-center" role="alert">Data Tidak Ditemukan</div>');
			redirect(base_url('Area/detail/' . $kode_ruang), 'refresh');
		}
	}

	public function detailOrder($ruang_lingkup)
	{
		$data = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$ruang_lingkup'")->result();
		$area = $this->db->query("SELECT * FROM tb_ruang_lingkup WHERE kode_ruang = '$ruang_lingkup'")->row();
		if ($data != NULL) {
			$data = array(
				'detail'    => $data,
				'menu'      => 'Ruang Lingkup ' . $area->nama_wilayah,
				'content'   => 'Admin/delivery/detail_area'
			);
			$this->load->view('layout/wrapper', $data);
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

	public function delete($no_sales_order)
	{
		if (!isset($_POST['hapus'])) {
			redirect(base_url('Undelivery'), 'refresh');
		} else {
			$this->db->query("DELETE FROM undelivery WHERE no_sales_order = '$no_sales_order'");
			$this->db->query("DELETE FROM detail_item_undelivery WHERE no_sales_order = '$no_sales_order'");
			$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
			redirect(base_url('UnDelivery'), 'refresh');
		}
	}

	public function hapus($no_sales_order, $kode_ruang)
	{
		if (!isset($_POST['hapus'])) {
			redirect(base_url('Undelivery'), 'refresh');
		} else {
			$detail_item = $this->db->query("SELECT * FROM detail_item_undelivery WHERE no_sales_order = '$no_sales_order'")->result();
			if ($detail_item != NULL) {
				foreach ($detail_item as $d) {
					$data_kubikasi = $this->db->query("SELECT * FROM kubikasi_ctn WHERE ruang_lingkup = '$d->ruang_lingkup' AND kode_barang = '$d->kode_barang'")->row();
					$barang = $this->db->query("SELECT * FROM barang WHERE kode_barang = '$d->kode_barang'")->row();
					if ($data_kubikasi != NULL) {
						$revisi_qty = (int)$data_kubikasi->pcs - (int)$d->kuantiti;
						$half_qty = (int)$barang->isi / 2;
						if ($revisi_qty <= 0) {
							$this->db->query("DELETE FROM kubikasi_ctn WHERE ruang_lingkup = '$kode_ruang' AND kode_barang = '$d->kode_barang'");
						} else {
							if ((int)$revisi_qty >= (int)$d->kuantiti) {
								$ctn = floor((int)$revisi_qty / (int)$barang->isi);
								$pcs = (int)$revisi_qty - ((int)$ctn * (int)$barang->isi);
								if ((int)$pcs >= (int)$half_qty) {
									$kubikasi = ((int)$ctn * (int)$barang->kubikasi) + (int)$barang->kubikasi;
									$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_qty', kubikasi = '$kubikasi' WHERE ruang_lingkup = '$d->ruang_lingkup' AND kode_barang = '$d->kode_barang'");
								} else {
									$kubikasi = ((int)$ctn * (int)$barang->kubikasi);
									$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_qty', kubikasi = '$kubikasi' WHERE ruang_lingkup = '$d->ruang_lingkup' AND kode_barang = '$d->kode_barang'");
								}
							} else {
								if ((int)$revisi_qty >= (int)$half_qty) {
									$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_qty', kubikasi = '$barang->kubikasi' WHERE ruang_lingkup = '$d->ruang_lingkup' AND kode_barang = '$d->kode_barang'");
								} else {
									$this->db->query("UPDATE kubikasi_ctn SET pcs = '$revisi_qty', kubikasi = 0 WHERE ruang_lingkup = '$d->ruang_lingkup' AND kode_barang = '$d->kode_barang'");
								}
							}
						}
					}
				}
				$this->db->query("DELETE FROM undelivery WHERE no_sales_order = '$no_sales_order'");
				$this->db->query("DELETE FROM detail_item_undelivery WHERE no_sales_order = '$no_sales_order'");
				$this->session->set_flashdata('flash', '<div class="alert alert-success text-center" role="alert">Data Telah Dihapus</div>');
				redirect(base_url('Undelivery/detail/' . $kode_ruang), 'refresh');
			}
		}
	}
}
