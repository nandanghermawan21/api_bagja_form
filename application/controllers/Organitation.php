<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Organitation extends MY_Controller {

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
			$da = $this->mdata->view_all('csm_organitation');
		}
		else
		{
			$da = $this->mdata->view_where('csm_organitation',['id'=>$id]);
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
		$val = [
			'name' => 'name',
			'code' => 'code'
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
			  }
			  else
			  {
						$val = [
							'name' => $input['name'],
							'code' => $input['code']
						];
						$this->mdata->insert_all('csm_organitation',$val);
						$data = [
							'success' =>true,
							'message'=>'create organitation success'
						];
						http_response_code('200');
			  }
			echo json_encode($data);
		}
	}

	public function show()
	{

	}

	public function update()
	{

		$val = [					
			'id' => 'id',
			'name' => 'name',
			'code' => 'code'
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
				}
				else
				{
						$val = [
							'name' => $input['name'],
							'code' => $input['code']
						];
						$wh = ['id'=> $input['id'] ];
	
						$cc = $this->mdata->check_all('usm_user',$wh,1);
	
						if($cc)
						{
							$cc = $this->mdata->update_all($wh,$val,'csm_organitation');
							$data = [
								'success' =>true,
								'message'=>'update organitation success'
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
	}

	public function delete()
	{
		$id = $this->input->get('id');
		$da = $this->mdata->delete_all('csm_organitation',['id'=>$id]);
		
        $data = [
            'success' =>true,
            'data'=>$da,
        ];
        http_response_code('200');

		echo json_encode($data);
	}



}
