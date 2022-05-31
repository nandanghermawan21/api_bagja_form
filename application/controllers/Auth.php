<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends MY_Controller {

	public function __construct()
    {
        parent::__construct();		
		header('Content-Type: application/json');
    }

	public function login()
	{
		$val = ['username'=>'username',
				'password'=>'password'
				];

		$data = array('success' => false, 'messages' => array());
		$input = json_decode(trim(file_get_contents('php://input')), true);		
		$this->form_validation->set_data($input);
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
					'username' => $input['username']       
				);
			
			  $cek = $this->mdata->check_all('usm_users',$user,1);

			  if($cek)
			  {
				if($this->key->openhash($input['password'],$cek->password))
				{
					$c = $this->_createJWToken($input['username']);

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
