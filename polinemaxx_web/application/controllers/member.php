<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->API="http://localhost:8000/api";
		$this->load->model('polinemaxx_model');
        $this->load->library('curl');
	}

	public function index()
	{
        $respon = json_decode($this->curl->simple_get($this->API.'/film'));
        $data['film']= $respon->values;
		$data['title'] = 'PolinemaXX';
        if ($this->input->post('keyword')){
            $data['film']=$this->polinemaxx_model->searchFilm();
        }
        $this->load->view('polinemaxx/user/index', $data);
	}

	public function detail($id_film)
    {
        //$params = array('id_film' => $this->curl->segment(2));
        $respon = $this->curl->simple_get($this->API . '/film/' . $id_film);
        $film = json_decode($respon, true);
        $data['film'] = $film['values'];
        $data['title']='PolinemaXX | Detail Film';
        $this->load->view('polinemaxx/user/detail',$data);
    }

    public function theater()
    {
        $respon = json_decode($this->curl->simple_get($this->API.'/theater'));
        $data['theater']= $respon->values;
        $data['title'] = 'PolinemaXX | Theater Malang';
        $this->load->view('polinemaxx/user/theater', $data);
    }

    public function wilayah()
    {
        $data['title']='PolinemaXX | Lokasi Theater';
        $this->load->view('polinemaxx/user/wilayah', $data);
    }

    public function beli($id_film)
    {
        //$params = array('id_film' => $this->curl->segment(2));
        $respon = $this->curl->simple_get($this->API . '/film/' . $id_film);
        $film = json_decode($respon, true);
        $data['film'] = $film['values'];
    	$data['title'] = 'PolinemaXX | Beli Tiket';
    	$this->load->view('polinemaxx/user/kursi', $data);
    }

    public function pembayaran()
    {
        $data = array(
            'title' => 'PolinemaXX | Pembayaran Tiket',
            'pembayaran' => $this->polinemaxx_model->datatabelsLaporan()
        );
        $this->load->view('polinemaxx/user/bayar', $data);
    }

    public function profile()
    {
        $data['title'] = 'PolinemaXX | Profile';
        $this->load->view('polinemaxx/user/profile', $data);
    }
}

/* End of file member.php */
/* Location: ./application/controllers/member.php */
?>