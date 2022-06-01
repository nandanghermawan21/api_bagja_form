<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Collection extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->_authenticate();
		header('Content-Type: application/json');   
    }

	public function index()
	{
		$id = $this->input->get('id');
        $tab  = array ('sys_collection','sys_collection_data');
        $sama   = array (null,'sys_collection.id=sys_collection_data.collection_id');     
        $wh = ['collection_id'=>$id];
		if($id == null)
		{
            $da = $this->mdata->join_all($tab,$sama,0);
		}
		else
		{
			$da = $this->mdata->join_all($tab,$sama,$wh);
		}
        $data = [
            'success' =>true,
            'data'=>$da,
        ];
        http_response_code('200');

		echo json_encode($data);
	}

	public function list()
	{
		$uri = $this->uri->segment(3);
        
        switch ($uri) {                        
            case null:
            case false:
            case '':
                $this->_show();
                break;           
            case 'create':
                $this->_create();
                break;
            case 'update':
                $this->_update();
                break;
            case 'delete':
                $this->_delete();
                break;
            default:
                show_404();
                break;
        }
	}

    public function _show()
    {
        $id = $this->input->get('id');
		if($id == null)
		{
			$da = $this->mdata->view_all('sys_collection');
		}
		else
		{
			$da = $this->mdata->view_where('sys_collection',['id'=>$id]);
		}
        $data = [
            'success' =>true,
            'data'=>$da,
        ];
        http_response_code('200');

		echo json_encode($data);
    }

    public function _create()
	{
		$val = [			
			'name' => 'name'
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
	
			if ($this->form_validation->run() == FALSE) 
            {
					foreach ($val as $key => $value) {
						$data['messages'][$key] = form_error($key);
					}
					http_response_code('400');
			  }
			  else
			  {
						$val = [							
							'name' => $input['name']
						];
						$this->mdata->insert_all('sys_collection',$val);
						$data = [
							'success' =>true,
							'message'=>'create collection success'
						];
						http_response_code('200');
			  }
			echo json_encode($data);
		}
	}

	public function _update()
	{

				$val = [					
					'id' => 'id',
					'name' => 'nanme'					
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
								'name' => $input['name']
							];
								$wh = ['id'=> $input['id'] ];
	
								$cc = $this->mdata->check_all('sys_collection',$wh,1);
	
								if($cc)
								{
								   $cc = $this->mdata->update_all($wh,$val,'sys_collection');
								   $data = [
									   'success' =>true,
									   'message'=>'update collection success'
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

	public function _delete()
	{
		$id = $this->input->get('id');
		$da = $this->mdata->delete_all('sys_collection',['id'=>$id]);

        if($da > 0)
        {
            $data = [
                'success' =>true,                
                'message'=>'delete collection success',
            ];
            http_response_code('200');
        }
        else
        {
            $data = [
                'success' =>false,                
                'message'=>'delete collection invalid data',
            ];
            http_response_code('400');
        }

		

		echo json_encode($data);
	}

    public function data()
	{
		$uri = $this->uri->segment(3);
        
        switch ($uri) {                        
            case null:
            case false:
            case '':
                $this->show();
                break;           
            case 'create':
                $this->create();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                show_404();
                break;
        }
	}

    public function show()
    {
        $id = $this->input->get('id');
		if($id == null)
		{
			$da = $this->mdata->view_all('sys_collection_data');
		}
		else
		{
			$da = $this->mdata->view_where('sys_collection_data',['id'=>$id]);
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
            'collection_id'=> 'collection_id',
            'value'=> 'value',
			'label' => 'label'
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
	
			if ($this->form_validation->run() == FALSE) 
            {
					foreach ($val as $key => $value) {
						$data['messages'][$key] = form_error($key);
					}
					http_response_code('400');
			  }
			  else
			  {
						$cc = $this->mdata->insert_all('sys_collection_data',$input);
                        if($cc > 0 )
                        {
                            $data = [
                                'success' =>true,
                                'message'=>'create collection data success'
                            ];
                            http_response_code('200');
                        }
                        else
                        {
                            $data = [
                                'success' =>true,
                                'message'=>'create collection data failed'
                            ];
                            http_response_code('400');

                        }
			  }
			echo json_encode($data);
		}
	}

	public function update()
	{

                $val = [	
                    'collection_id'=> 'collection id',
                    'value'=> 'value',
                    'label' => 'label'
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
				
								$wh = ['collection_id'=> $input['collection_id'] ];
									
                                $cc = $this->mdata->update_all($wh,$input,'sys_collection_data');
	
								if($cc > 0)
								{
								   $data = [
									   'success' =>true,
									   'message'=>'update collection success'
								   ];
								   http_response_code('200');
	
							   }
							   else
							   {
									$data = [
										'success' =>false,
										'message'=> "update collection failed"
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
		$da = $this->mdata->delete_all('sys_collection_data',['collection_id'=>$id]);

        if($da > 0)
        {
            $data = [
                'success' =>true,                
                'message'=>'delete collection success',
            ];
            http_response_code('200');
        }
        else
        {
            $data = [
                'success' =>false,                
                'message'=>'delete collection invalid data',
            ];
            http_response_code('400');
        }

		

		echo json_encode($data);
	}



}
