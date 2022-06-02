<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use OpenApi\Annotations as OA;


class Auth extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
		header('Content-Type: application/json');
		$this->load->model('Auth_model', 'Auth');
    }
  /**
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *    @OA\Response(response="200",
	 * 		description="Success",
	 *      @OA\JsonContent(
     *          @OA\Property(property="status",type="boolean"),
     *          @OA\Property(property="token",default="eyJ0eXAiOiJKV1QiLCJhbxxxxxxxxx",type="string"),
     *     ),
	 * ),
     *    @OA\Response(response="400", description="required field",
	 *       @OA\JsonContent(
     *       ref="#/components/schemas/required"
     *     ),
	 * ),
     *    @OA\RequestBody(
     *      required=true,
	 *      @OA\JsonContent(
     *          @OA\Property(property="username",description="Login username.",type="string"),
     *          @OA\Property(property="password",description="Login Password.",type="string"),
     *     ),
     *   ),
     * )
     */
	public function login()
	{
		$val = ['username'=>'username',
				'password'=>'password'
				];

		$data = array('success' => false, 'messages' => array());
		$input = json_decode(trim(file_get_contents('php://input')), true);

		if($input)
		{
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

					$auth = new Auth_model();
					$user = array (
						'username' => $input['username']
					);

				  $cek = $auth->login($user);

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

}
