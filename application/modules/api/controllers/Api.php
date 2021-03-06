<?php  defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller{
	function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->library(array('datatables'));
        $this->load->model('M_kanwil','kanwil');
        $this->load->model('M_cabang','cabang');
        $this->load->model('M_kcp','kcp');
        $this->load->model('M_posisi','posisi');
        $this->load->model('M_fisik','fisik');
        $this->load->model('M_laporan','laporan');
        $this->load->model('M_report','report');
        $this->load->model('M_Parameter','parameter');
        $this->load->model('M_mcoa','mcoa');

        $this->load->library(array('form_validation'));
        $this->load->helper('url');
    }

	function index_get(){
		$this->response('Api untuk BJB Syariah');
	}

	/* kanwil */
	function kanwil_get(){
		$data=$this->kanwil->get();

		$this->response($data);
	}

	function kanwil_post(){
	    $this->form_validation->set_data($this->post());
	    $this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id_kanpus'=>1,
				'nama_kanwil'=>$this->post('nama')
			);

			$simpan=$this->kanwil->save($data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');

		}else{
			$json=array('success'=>false,'pesan'=>'Tidak ada data');
		}

		$this->response($json, 200);
	}

	function kanwilDetail_get($id){
		$kanwil=$this->kanwil->get_by_id($id);

		$json=array(
				'success'=>true,
				'pesan'=>'Data Berhasil diload',
				'kanwil'=>$kanwil
			);

		$this->response($json,200);
	}

	function kanwil_put($id){
		$this->form_validation->set_data($this->put());

		$this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
				'nama_kanwil'=>$this->put('nama')
			);

			$this->kanwil->update($id,$data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil diupdate');
		}else{
			$json=array('success'=>false,'pesan'=>'Data Gagal diupdate');
		}

     	$this->response($json, 200);  	
	}

	function kanwil_delete($id){
		$this->kanwil->delete($id);

		$json=array('success'=>true,'pesan'=>'Data Berhasil dihapus');

		$this->response($json,200);
	}
	/* end of kanwil */

	/* cabang */
	function cabang_get(){
		$data=$this->cabang->get();

		$this->response($data);
	}

	function cabang_post(){
		$this->form_validation->set_data($this->post());

		$this->form_validation->set_rules('kanwil','Kanwil','required');
	    $this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
				'id_kanwil'=>$this->post('kanwil'),
				'nama_cabang'=>$this->post('nama')
			);

			$simpan=$this->cabang->save($data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');

		}else{
			$json=array('success'=>false,'pesan'=>'Tidak ada data');
		}

		$this->response($json, 200);
	}

	function cabangDetail_get($id){
		$cabang=$this->cabang->get_by_id($id);

		$json=array(
				'success'=>true,
				'pesan'=>'Data Berhasil diload',
				'cabang'=>$cabang
			);

		$this->response($json,200);
	}

	function cabang_put($id){
		$this->form_validation->set_data($this->put());

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('kanwil','Kanwil','required');

		if($this->form_validation->run()==true){
			$data=array(
				'nama_cabang'=>$this->put('nama'),
				'id_kanwil'=>$this->put('kanwil')
			);

			$this->cabang->update($id,$data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil diupdate');
		}else{
			$json=array('success'=>false,'pesan'=>'Data Gagal diupdate');
		}

     	$this->response($json, 200);  	
	}	

	function cabang_delete($id){
		$this->cabang->delete($id);

		$json=array('success'=>true,'pesan'=>'Data Berhasil dihapus');

		$this->response($json,200);
	}
	/* end cabang */

	/* kcp */
	function kcp_get(){
		$data=$this->kcp->get();

		$this->response($data);
	}

	function kcp_post(){
		$this->form_validation->set_data($this->post());

		$this->form_validation->set_rules('cabang','Cabang','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telp','Telp','required');
		$this->form_validation->set_rules('fax','Fax','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()==true){
			$data=array(
					'id_cabang'=>$this->post('cabang'),
					'nama_kcp'=>$this->post('nama'),
					'alamat_kcp'=>$this->post('alamat'),
					'telp_kcp'=>$this->post('telp'),
					'fax_kcp'=>$this->post('fax'),
					'username'=>$this->post('username'),
					'password'=>md5($this->post('password'))
				);

			$this->kcp->save($data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');
		}else{
			$json=array('success'=>false,'pesan'=>'Data Gagal disimpan, Data tidak lengkap');
		}

		$this->response($json);
	}

	function kcp_put($id){
		$this->form_validation->set_data($this->put());

		$this->form_validation->set_rules('cabang','Cabang','required');
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telp','Telp','required');
		$this->form_validation->set_rules('fax','Fax','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()==true){
			$data=array(
					'id_cabang'=>$this->put('cabang'),
					'nama_kcp'=>$this->put('nama'),
					'alamat_kcp'=>$this->put('alamat'),
					'telp_kcp'=>$this->put('telp'),
					'fax_kcp'=>$this->put('fax'),
					'username'=>$this->put('username'),
					'password'=>md5($this->put('password'))
				);

			$this->kcp->update($id,$data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil diupdate');
		}else{
			$json=array('success'=>false,'pesan'=>'Data Gagal disimpan, Data tidak lengkap');
		}

		$this->response($json);	
	}

	function kcpDetail_get($id){
		$kcp=$this->kcp->get_by_id($id);

		$this->response($kcp,200);
	}

	function kcp_delete($id){
		$this->kcp->delete($id);

		$json=array('success'=>true,'pesan'=>'Data berhasil dihapus');

		$this->response($json,200);
	}
	/* end kcp*/

	/* posisi */
	function posisi_get(){
		$data=$this->posisi->get();

		$this->response($data);
	}

	function posisiDetail_get($id){
		$data=$this->posisi->get_by_id($id);

		$json=array(
				'success'=>true,
				'pesan'=>'Data Berhasil diload',
				'posisi'=>$data
			);

		$this->response($json,200);
	}

	function posisi_post(){
		$this->form_validation->set_data($this->post());

		$this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
					'nama_posisi'=>$this->post('nama')
				);

			$this->posisi->save($data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');
		}else{
			$json=array('success'=>false,'pesan'=>'Data tidak lengkap');
		}

		$this->response($json);
	}

	function posisi_put($id){
		$this->form_validation->set_data($this->put());

		$this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
					'nama_posisi'=>$this->put('nama')
				);

			$this->posisi->update($id,$data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');
		}else{
			$json=array('success'=>false,'pesan'=>'Data tidak lengkap');
		}

		$this->response($json);
	}

	function posisi_delete($id){
		$this->posisi->delete($id);

		$json=array('success'=>true,'pesan'=>'Data Berhasil dihapus');

		$this->response($json);
	}
	/* end posisi */

	/* category mcoa */
	function categoryMcoaPosisi_get($id){
		$posisi=$this->posisi->get_by_id($id);
		$parameter=$this->parameter->get_by_posisi($id);

		$json=array(
				'posisi'=>$posisi,
				'parameter'=>$parameter
			);

		$this->response($json);
	}

	function categoryMcoa_post(){
		$this->form_validation->set_data($this->post());

		$this->form_validation->set_rules('posisi','Posisi','required');
		$this->form_validation->set_rules('kategori','Kategori','required');

		if($this->form_validation->run()==true){
			$data=array(
					'nama_kategori'=>$this->post('kategori'),
					'id_posisi'=>$this->post('posisi'),
					'jenis'=>'Mcoa'
				);

			$this->mcoa->save($data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');
		}else{
			$json=array('success'=>false,'pesan'=>'Data tidak lengkap');
		}

		$this->response($json);
	}

	function categoryDetailMcoa_get($id){
		$mcoa=$this->mcoa->get_by_id($id);

		$this->response($mcoa);
	}

	function categoryMcoa_put($id){
		$this->form_validation->set_data($this->put());

		$this->form_validation->set_rules('nama','Nama','required');

		if($this->form_validation->run()==true){
			$data=array(
					'nama_kategori'=>$this->put('nama')
				);

			$this->mcoa->update($id,$data);

			$json=array('success'=>true,'pesan'=>'Data Berhasil disimpan');
		}else{
			$json=array('success'=>false,'pesan'=>'Data tidak lengkap');
		}

		$this->response($json);
	}

	function categoryMcoa_delete($id){
		$this->mcoa->delete($id);

		$json=array('success'=>true,'pesan'=>'Data Berhasil dihapus');

		$this->response($json);
	}
	/* end category mcoa */

	/* fisik */
	function fisik_get(){
		$data=$this->fisik->get();

		$this->response($data);
	}
	/* end fisik */

	/* daftar laporan */
	function laporan_get(){
		$data=$this->laporan->get();

		$this->response($data);
	}
	/* end daftar laporan */

	/* report list kcp*/
	function report_list_kcp_get(){
		$data=$this->report->get();

		$this->response($data);
	}
	/* end report list kcp*/
}