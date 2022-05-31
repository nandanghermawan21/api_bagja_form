<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends MY_Controller {

	public function __construct()
    {
        parent::__construct();		
        $this->_authenticate();
		header('Content-Type: application/json');
    }

	public function index()
	{		

        $id = $this->input->get('id');
		if($id == null)
		{
			$da = $this->mdata->view_all('usm_users');
		}
		else
		{
			$da = $this->mdata->view_where('usm_users',['id'=>$id]);
		}
        
        $data = [
            'success' =>true,
            'data'=>$da,
        ];
        http_response_code('200');

		echo json_encode($data);
	}

	public function create()
	{
             $parent = $this->mdata->ambil('usm_users','id')+1;
		$val = [
			'username' => 'Username',
			'password' => 'Password',
			'nama' => 'Nama',
            'alamat' => 'Alamat',
			'nohp' => 'No HP',
			'email' => 'Email',
			'organitation_id' => 'organitation_id',        
		];

		$data = array('success' => false, 'messages' => array());

		foreach($val as $row => $key) :
			$this->form_validation->set_rules($row, $key, 'trim|required|xss_clean');
		endforeach;
		$this->form_validation->set_error_delimiters(null, null);

		if ($this->form_validation->run() == FALSE) {
				foreach ($val as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
				http_response_code('400');
		  } 
		  else 
		  {
					$val = [
						'username' => $this->input->post('username'),
						'password' => $this->key->lockhash(trim($this->input->post('password'))),
						'nama' => $this->input->post('nama'),
                        'alamat' => $this->input->post('alamat'),
						'nohp' => $this->input->post('nohp'),
						'email' => $this->input->post('email'),
						'organitation_id' => $this->input->post('organitation_id'),   
                        'parent_user_id'=>$parent,                  
					];
					$this->mdata->insert_all('usm_users',$val);
					$data = [
						'success' =>true,
						'message'=>'Insert users sucess'
					];
					http_response_code('200');						
		  }		
		echo json_encode($data);
	}

    public function update()
	{
		$val = [
            'id' => 'id',
			'username' => 'Username',
			'password' => 'Password',
			'nama' => 'Nama',
            'alamat' => 'Alamat',
			'nohp' => 'No HP',
			'email' => 'Email',
			'organitation_id' => 'organitation',
            'parent_user_id' => 'parante',
		];

		$data = array('success' => false, 'messages' => array());

		foreach($val as $row => $key) :
			$this->form_validation->set_rules($row, $key, 'trim|required|xss_clean');
		endforeach;
		$this->form_validation->set_error_delimiters(null, null);

		if ($this->form_validation->run() == FALSE) {
				foreach ($val as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
				http_response_code('400');
		  } 
		  else 
		  {
					$val = [
						'username' => $this->input->post('username'),
						'password' => $this->key->lockhash(trim($this->input->post('password'))),
						'nama' => $this->input->post('nama'),
                        'alamat' => $this->input->post('alamat'),
						'nohp' => $this->input->post('nohp'),
						'email' => $this->input->post('email'),
						'organitation_id' => $this->input->post('organitation'),
					];

                    $wh = ['id'=> $this->input->post('id') ];
                    $cc = $this->mdata->check_all('usm_users',$wh,1);
                    if($cc)
                    {
                        $cc = $this->mdata->update_all($wh,$val,'usm_users');
                        $data = [
                            'success' =>true,
                            'message'=>'update user success'
                        ];
                        http_response_code('200');
                    }
                    else
                    {
                        $data = [
                            'success' =>false,
                            'message'=> "invalid field id"
                        ];
                        http_response_code('400');
                    }				
		  }		
		echo json_encode($data);
	}

    public function delete()
	{
		$id = $this->input->get('id');
		$da = $this->mdata->delete_all('usm_users',['id'=>$id]);
		
        $data = [
            'success' =>true,
            'data'=>$da,
        ];
        http_response_code('200');

		echo json_encode($data);
	}

	

}
