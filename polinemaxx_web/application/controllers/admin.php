<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
    var $API="";

	public function __construct()
	{
		parent::__construct();
        $this->API="http://localhost:8000/api";
		$this->load->model('polinemaxx_model');
        $this->load->library('curl');
	}

	public function index()
	{
		$judul['title']='Polinemaxx | Login Admin';
        $this->load->view('polinemaxx/admin/login-page', $judul);
	}

	public function dashboard()
	{
		$data['title'] = 'Polinemaxx | Dashboard Admin';
		$data['film'] = $this->polinemaxx_model->jumlahFilm();
		$data['member'] = $this->polinemaxx_model->jumlahMember();
		$data['theater'] = $this->polinemaxx_model->jumlahTheater();
		$this->load->view('polinemaxx/admin/dashboard', $data);

	}

	//film

	public function film()
	{
        $respon = json_decode($this->curl->simple_get($this->API.'/film'));
		$data = array(
            'title' => 'Polinemaxx | Data Film',
            'film'=> $respon->values
        );
		$this->load->view('polinemaxx/admin/film', $data);
	}

	public function detailFilm($id_film)
	{
		$data['title'] = 'Polinemaxx | Detail Film';
		$respon = $this->curl->simple_get($this->API . '/film/' . $id_film);
        $film = json_decode($respon, true);
        $data['film'] = $film['values'];
		$this->load->view('polinemaxx/admin/detail_film', $data);
	}

	public function tambahFilm()
	{
		$data['title'] = 'Polinemaxx | Tambah Film';
		$this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('dimensi', 'dimensi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('polinemaxx/admin/tambah_film');
        } else {
            $config['upload_path'] = APPPATH.'../assets/film/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|avi|flv|wmv|mp4';
            $config['max_size']  = '600000';
            $config['overwrite'] = FALSE;
            
            $this->load->library('upload', $config);

            $this->upload->initialize($config);
            
            $data['nama'] = $this->input->post('nama',TRUE);
            $data['dimensi'] = $this->input->post('dimensi',true);
            $data['usia'] = $this->input->post('usia',true);
            $data['kategori'] = $this->input->post('kategori',true);
            $data['durasi'] = $this->input->post('durasi',true);
            $data['produser'] = $this->input->post('produser',true);
            $data['direktor'] = $this->input->post('direktor',true);
            $data['penulis'] = $this->input->post('penulis',true);
            $data['cast'] = $this->input->post('cast',true);
            $data['deskripsi'] = $this->input->post('deskripsi',true);
            
            if ( ! $this->upload->do_upload('gambar') && ! $this->upload->do_upload('trailer') ){
                $error = array('error' => $this->upload->display_errors(),
            					'film' => $this->polinemaxx_model->datatabelsFilm());
                $this->load->view('polinemaxx/admin/film', $error);
            }
            else{
                if (isset($_POST['submit'])) {
                $data['nama'] = $this->input->post('nama',TRUE);
                $data['dimensi'] = $this->input->post('dimensi',true);
                $data['usia'] = $this->input->post('usia',true);
                $data['kategori'] = $this->input->post('kategori',true);
                $data['durasi'] = $this->input->post('durasi',true);
                $data['produser'] = $this->input->post('produser',true);
                $data['direktor'] = $this->input->post('direktor',true);
                $data['penulis'] = $this->input->post('penulis',true);
                $data['cast'] = $this->input->post('cast',true);
                $data['deskripsi'] = $this->input->post('deskripsi',true);

                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
                $data['trailer'] = $upload_data['file_name'];

                $insert = $this->curl->simple_post($this->API.'/film',$data, array(CURLOPT_BUFFERSIZE => 10));
                    if ($insert) {
                        $this->session->set_flashdata('hasil', 'Tambah data film baru berhasil!');
                    }else{
                        $this->session->set_flashdata('hasil', 'Tambah data film baru gagal!');
                    }
                    redirect('admin/film');
                }else{
                    $this->load->view('polinemaxx/admin/film',$data);
                }
            }
        }
	}

    public function editFilm($id_film)
    {
        $data['title'] = 'Polinemaxx | Ubah Film';
        $respon = $this->curl->simple_get($this->API . '/film/' . $id_film);
        $film = json_decode($respon, true);
        $data['film'] = $film['values'];

        $data['dimensi']=['2D','3D'];
        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('polinemaxx/admin/edit_film',$data);
        } else {
            $config['upload_path'] = APPPATH.'../assets/film/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|avi|flv|wmv|mp4';
            $config['max_size']  = '600000';
            $config['overwrite'] = FALSE;
            
            $this->load->library('upload', $config);

            $this->upload->initialize($config);
            $data['nama'] = $this->input->post('nama',TRUE);
            $data['dimensi'] = $this->input->post('dimensi',true);
            $data['usia'] = $this->input->post('usia',true);
            $data['kategori'] = $this->input->post('kategori',true);
            $data['durasi'] = $this->input->post('durasi',true);
            $data['produser'] = $this->input->post('produser',true);
            $data['direktor'] = $this->input->post('direktor',true);
            $data['penulis'] = $this->input->post('penulis',true);
            $data['cast'] = $this->input->post('cast',true);
            $data['deskripsi'] = $this->input->post('deskripsi',true);
            
            if ( !$this->upload->do_upload('gambar') && !$this->upload->do_upload('trailer') ){
                $data['gambar'] = $this->input->post('fotoLama',TRUE);
                $data['trailer'] = $this->input->post('videoLama',TRUE);
                $this->polinemaxx_model->ubahFilm($data);
                $this->session->set_flashdata('flash-data','diubah');
                redirect('admin/film','refresh');
            } elseif (!$this->upload->do_upload('gambar') && $this->upload->do_upload('trailer')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $this->input->post('fotoLama',TRUE);
                $data['trailer'] = $upload_data['file_name'];
                $this->polinemaxx_model->ubahFilm($data);
                $this->session->set_flashdata('flash-data','diubah');
                redirect('admin/film','refresh');
            }elseif ($this->upload->do_upload('gambar') && !$this->upload->do_upload('trailer')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
                $data['trailer'] = $this->input->post('videoLama',TRUE);
                $this->polinemaxx_model->ubahFilm($data);
                $this->session->set_flashdata('flash-data','diubah');
                redirect('admin/film','refresh');
            }
            else{
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];
                $data['trailer'] = $upload_data['file_name'];
                $this->polinemaxx_model->ubahFilm($data);
                $this->session->set_flashdata('flash-data','diubah');
                redirect('admin/film','refresh');
            }
        }
    }

    public function hapusFilm($id_film){
      if (empty($id_film)) {
        redirect('admin/film');
      }else{
        $delete = $this->curl->simple_delete($this->API.'/film/'. $id_film, array(CURLOPT_BUFFERSIZE => 10));
        if ($delete) {
            $this->session->set_flashdata('hasil', 'Hapus data film berhasil!');
        }else{
            $this->session->set_flashdata('hasil', 'Hapus data film gagal!');
        }
        redirect('admin/film','refresh');
      }
    }

	//member

	public function member()
	{
        $respon = json_decode($this->curl->simple_get($this->API.'/member'));
		$data = array(
            'title' => 'Polinemaxx | Data Member',
            'member'=> $respon->values
        );
		$this->load->view('polinemaxx/admin/member', $data);
	}

	public function detailMember($id_user)
	{
		$data['title'] = 'Polinemaxx | Detail Member';
        $respon = $this->curl->simple_get($this->API . '/member/' . $id_user);
        $member = json_decode($respon, true);
        $data['member'] = $member['values'];
		$this->load->view('polinemaxx/admin/detail_member', $data);
	}

	public function tambahMember()
	{
		$judul['title'] = 'Polinemaxx | Tambah Member';
		$this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('nohp', 'nohp', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
        	$this->load->view('polinemaxx/admin/tambah_member', $judul);
        }else{
            if (isset($_POST['submit'])) {
                $data['id_user'] = $this->input->NULL;
                $data['nama'] = $this->input->post('nama');
                $data['alamat'] = $this->input->post('alamat');
                $data['nohp'] = $this->input->post('nohp');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');

                $insert = $this->curl->simple_post($this->API.'/member',$data, array(CURLOPT_BUFFERSIZE => 10));
                if ($insert) {
                    $this->session->set_flashdata('hasil', 'Tambah data member baru berhasil!');
                }else{
                    $this->session->set_flashdata('hasil', 'Tambah data member bar gagal!');
                }
                redirect('admin/member');
            }else{
                $this->load->view('polinemaxx/admin/tambah_member');
            }
        }
	}

    public function editMember($id_user)
    {
       $data['title'] = 'Polinemaxx | Edit Member';
        $respon = $this->curl->simple_get($this->API . '/member/' . $id_user);
        $member = json_decode($respon, true);
        $data['member'] = $member['values'];
        
        $this->load->view('polinemaxx/admin/edit_member', $data);
    }

	public function updatemember()
	{
        if (isset($_POST['submit'])) {
            $id_user = $this->input->post('id_user');
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('alamat', 'alamat', 'required');
            $this->form_validation->set_rules('nohp', 'nohp', 'required');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('polinemaxx/admin/edit_member');
            }else{
                $id = $this->input->post('id_user');
                $data['id_user'] = $this->input->post('id_user');
                $data['nama'] = $this->input->post('nama');
                $data['alamat'] = $this->input->post('alamat');
                $data['nohp'] = $this->input->post('nohp');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');

                $update = $this->curl->simple_put($this->API.'/member/update/'. $id, $data, array(CURLOPT_BUFFERSIZE => 10));
                if ($update) {
                    $this->session->set_flashdata('hasil', 'Ubah data member berhasil!');
                }else{
                    $this->session->set_flashdata('hasil', 'Ubah data member gagal!');
                }
                redirect('admin/member');
            }
        }else{
            $data['title'] = 'Admin Perpustakaan | Halaman Member';
            $params = array('id_user' => $this->uri->segment(3));
            $respon = json_decode($this->curl->simple_get($this->API.'/member/',$params));
            $data['member'] = $respon->values;

            $this->load->view('polinemaxx/admin/edit_member', $data);
        }
	}

	public function hapusMember($id_user)
	{
		if (empty($id_user)) {
        redirect('admin/member');
        }else{
            $delete = $this->curl->simple_delete($this->API.'/member/'. $id_user, array(CURLOPT_BUFFERSIZE => 10));
            if ($delete) {
                $this->session->set_flashdata('hasil', 'Hapus data member berhasil!');
            }else{
                $this->session->set_flashdata('hasil', 'Hapus data member gagal!');
            }
        redirect('admin/member','refresh');
      }
	}

	// end member

	// theatrer

	public function theater()
	{
        $respon = json_decode($this->curl->simple_get($this->API.'/theater'));
		$data = array(
            'title' => 'Polinemaxx | Data Theater',
            'theater' => $respon->values
        );
		$this->load->view('polinemaxx/admin/theater', $data);
	}

	public function detailTheater($id)
	{
		$data['title'] = "Polinemaxx | Detail Theater";
        $respon = $this->curl->simple_get($this->API . '/theater/' . $id);
        $theater = json_decode($respon, true);
        $data['theater'] = $theater['values'];
		$this->load->view('polinemaxx/admin/detail_theater', $data);
	}

	public function tambahTheater()
	{
		$judul['title'] = 'Polinemaxx | Tambah Theater';
		$this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('telp', 'telp', 'required');
        $this->form_validation->set_rules('bioskop', 'bioskop', 'required');

        if ($this->form_validation->run() == FALSE) {
            # code...
            $this->load->view('polinemaxx/admin/tambah_theater', $judul);
        }else {
            if (isset($_POST['submit'])) {
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'telp' => $this->input->post('telp'),
                    'bioskop' => $this->input->post('bioskop'));

                $insert = $this->curl->simple_post($this->API.'/theater',$data, array(CURLOPT_BUFFERSIZE => 10));
                if ($insert) {
                    $this->session->set_flashdata('hasil', 'Tambah data theater baru berhasil!');
                }else{
                    $this->session->set_flashdata('hasil', 'Tambah data theater baru gagal!');
                }
                redirect('admin/theater');
            }else{
                $this->load->view('polinemaxx/admin/tambah_theater', $judul);
            }
        }
	}

    public function editTheater($id)
    {
       $data['title'] = 'Polinemaxx | Edit Theater';
        $respon = $this->curl->simple_get($this->API . '/theater/' . $id);
        $theater = json_decode($respon, true);
        $data['theater'] = $theater['values'];
        
        $this->load->view('polinemaxx/admin/edit_theater', $data);
    }

    public function updatetheater()
    {
        if (isset($_POST['submit'])) {
            $id_user = $this->input->post('id_user');
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('alamat', 'alamat', 'required');
            $this->form_validation->set_rules('telp', 'telp', 'required');
            $this->form_validation->set_rules('bioskop', 'bioskop', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('polinemaxx/admin/edit_member');
            }else{
                $id =  $this->input->post('id');
                $data = array(
                    'id' => $this->input->post('id'),
                    'nama' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'telp' => $this->input->post('telp'),
                    'bioskop' => $this->input->post('bioskop'));

                $update = $this->curl->simple_put($this->API.'/theater/update/'. $id, $data, array(CURLOPT_BUFFERSIZE => 10));
                if ($update) {
                    $this->session->set_flashdata('hasil', 'Ubah data theater berhasil!');
                }else{
                    $this->session->set_flashdata('hasil', 'Ubah data theater gagal!');
                }
                redirect('admin/theater');
            }
        }else{
            $data['title'] = 'Polinemaxx | Edit Theater';
            $params = array('id' => $this->uri->segment(3));
            $respon = json_decode($this->curl->simple_get($this->API.'/theater/',$params));
            $data['theater'] = $respon->values;

            $this->load->view('polinemaxx/admin/edit_member', $data);
        }
    }

	/*public function editTheater($id)
	{
		$data['title'] = 'Polinemaxx | Edit Theater';
		$data['theater'] = $this->polinemaxx_model->getTheaterId($id);

		$this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('telp', 'telp', 'required');
        $this->form_validation->set_rules('bioskop', 'bioskop', 'required');

        if ($this->form_validation->run() == FALSE) {
        	$this->load->view('polinemaxx/admin/edit_theater', $data);
        }else{
            $this->polinemaxx_model->ubahmember();
        	$this->session->set_flashdata('flash-data','diubah');

            redirect('admin/theater','refresh');
        }
	}*/

	public function hapusTheater($id)
	{
		if (empty($id)) {
        redirect('admin/theater');
        }else{
            $delete = $this->curl->simple_delete($this->API.'/theater/'. $id, array(CURLOPT_BUFFERSIZE => 10));
            if ($delete) {
                $this->session->set_flashdata('hasil', 'Hapus data theater berhasil!');
            }else{
                $this->session->set_flashdata('hasil', 'Hapus data theater gagal!');
            }
        redirect('admin/theater','refresh');
        }
	}

	// end theater

	//laporan

	public function laporan()
	{
		$data = array(
            'title' => 'Polinemaxx | Laporan',
            'laporan' => $this->polinemaxx_model->datatabelsLaporan()
        );
		$this->load->view('polinemaxx/admin/laporan', $data);
	}

	// end laporan

	//login logout

	public function logout()
    {
        $this->session->sess_destroy();
        
        redirect('admin/','refresh');
    }

    public function proses_login()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars($this->input->post('password'));

        $cekLogin = $this->polinemaxx_model->loginAdmin($username,$password);

        if ($cekLogin) {
            foreach ($cekLogin as $key){
                $session_data = array(
                'id'   => $key->id,
               'nama'   => $key->nama,
                'username' => $key->username,
                'password' => $key->password
            );
                $this->session->set_userdata($session_data);
                redirect('admin/dashboard','refresh');
            }
        }else{
            redirect('admin/dashboard','refresh');
        }
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
?>