<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends MY_Controller {

	public function __construct()
    {
        parent::__construct();		
		header('Content-Type: application/json');
    }

	public function login()
	{
		$val = [
			'username' => 'Username',
			'password' => 'Password'
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

        } else {

				$user = array (        
					'username' => $this->input->post('username')        
				);
			
			  $cek = $this->mdata->check_all('usm_users',$user,1);

			  if($cek)
			  {
				if($this->key->openhash($this->input->post('password'),$cek->password))
				{
					$c = $this->_createJWToken($this->input->post('username'));

					$data = [
						'success' =>true,
						'token'=>$c						
					];
					http_response_code('200');
				}
				else
				{
					$data = [
						'success' =>false,
						'message'=>'invalid username or password'
					];
					http_response_code('400');
				}		

			  }
			  else
			  {
				$data = [
					'success' =>false,
					'message'=>'invalid username or password'
				];
				http_response_code('400');
			  }

	        }

	        echo json_encode($data);
	}


}
