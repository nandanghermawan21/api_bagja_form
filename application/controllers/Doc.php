<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Doc extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$d = $this->mdata->view_all('csm_organitation');		

		if(count($d) > 0)
		{		
			foreach($d as $row)
			{
				$ab []=  $row->id;
			}
		}
		else
		{
			$ab = [0,1,2,3];
		}

		$da = [
			"openapi"=> '3.0.0',
			"info"=> [
				'title'=> 'Mockup Api Survey',
				'version'=> 1,
			],
			'servers'=> [
				['url'=> base_url() ]
			],
			'paths'=> [
				'/auth/login'=>[
					'post'=>[
						'tags'=>['auth'],
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'username' => [
												'type'=>'string',
												'required'=>1,
											],
											'password' => [
												'type'=>'string',
												'required'=>1,
											]
										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Success login'
							],
							'400'=> [
								'description'=>'Bad Request, invalid data user'
							],
						]


					]

				],
				'/organitation-show'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['organitation'],
						'operationId'=>'Get all organitation',
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id organitation',
								'in'=>'query',
								'required'=> false,
								'schema' => [
									'type' => 'integer',	
									'default'=> null							
									]			
							]
							
						],						
						'responses'=>[
							'200'=> [
								'description'=>'Get Success'
							],

						],
					]

				],
				'/organitation-create'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['organitation'],
						'operationId'=>'Create organitation',
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'name' => [
												'type'=>'string',
												'required'=>1,
											],
											'code' => [
												'type'=>'string',
												'required'=>1,
											]
										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/organitation-update'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['organitation'],
						'operationId'=>'Update organitation',						
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'id' => [
												'type'=>'integer',
												'required'=>1,
											],
											'name' => [
												'type'=>'string',
												'required'=>1,
											],
											'code' => [
												'type'=>'string',
												'required'=>1,
											]
										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/organitation-delete'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['organitation'],
						'operationId'=>'Delete organitation',						
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id Organitation',
								'in'=>'query',
								'required'=> true,
								'schema' => [
									'type' => 'integer',										
									]			
							]
							
						],	
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/level'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['level'],
						'operationId'=>'Get all Level',
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id Level',
								'in'=>'query',
								'required'=> false,
								'schema' => [
									'type' => 'integer',	
									'default'=> null							
									]			
							]
							
						],						
						'responses'=>[
							'200'=> [
								'description'=>'Get Success'
							],

						],
					]

				],
				'/level/create'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['level'],
						'operationId'=>'Create Level',
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'id' => [
												'type'=>'integer',
												'enum' => $ab,	
												'required'=>true,
											],
											'child_id' => [
												'type'=>'integer',
												'required'=>true,
											]
										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/level/update'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['level'],
						'operationId'=>'Update Level',						
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'id' => [
												'type'=>'integer',
												'required'=>1,
											],
											'name' => [
												'type'=>'string',
												'required'=>1,
											],
											'code' => [
												'type'=>'string',
												'required'=>1,
											]
										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/leveldelete'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['level'],
						'operationId'=>'Delete Level',						
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id Level',
								'in'=>'query',
								'required'=> true,
								'schema' => [
									'type' => 'integer',										
									]			
							]
							
						],	
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/tree'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['Organitation tree'],
						'operationId'=>'get organitation tree',
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id parent',
								'in'=>'query',
								'required'=> true,
								'schema' => [
									'type' => 'integer',										
									]			
							]
							
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/user/create'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['user'],
						'operationId'=>'Create User',
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'username' => [
												'type'=>'string',
												'required'=>1,
											],
											'password' => [
												'type'=>'string',
												'required'=>1,
											],
											'nama' => [
												'type'=>'string',
												'required'=>1,
											],
											'alamat' => [
												'type'=>'string',
												'required'=>1,
											],
											'nohp' => [
												'type'=>'string',
												'required'=>1,
											],
											'email' => [
												'type'=>'string',
												'required'=>1,
											],
											'organitation_id' => [
												'type'=>'string',
												'enum' => $ab,											
												'required'=>1,
											],				
											'parent_user_id' => [
												'type'=>'integer',
												'required'=>1,
											]

										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/user'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['user'],
						'operationId'=>'Get User with parameter id or All',	
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id user',
								'in'=>'query',
								'required'=> false,
								'schema' => [
									'type' => 'integer',	
									'default'=> null							
									]			
							]
							
						],		
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],				
				'/user/update'=>[
					'post'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['user'],
						'operationId'=>'Update User',
						'requestBody'=> [
							'content'=>[
								'application/x-www-form-urlencoded'=>[
									'schema'=> [
										'properties'=>[
											'id' => [
												'type'=>'integer',
												'required'=>1,
											],
											'username' => [
												'type'=>'string',
												'required'=>1,
											],
											'password' => [
												'type'=>'string',
												'required'=>1,
											],
											'nama' => [
												'type'=>'string',
												'required'=>1,
											],
											'alamat' => [
												'type'=>'string',
												'required'=>1,
											],
											'nohp' => [
												'type'=>'string',
												'required'=>1,
											],
											'email' => [
												'type'=>'string',
												'required'=>1,
											],
											'organitation_id' => [
												'type'=>'integer',
												'required'=>1,
											],
											'parent_user_id' => [
												'type'=>'integer',
												'required'=>1,
											]

										],
										'type'=>'object'

									],
								]
							]
						],
						'responses'=>[
							'200'=> [
								'description'=>'Create Success'
							],

						],
					]

				],
				'/user/delete'=>[
					'get'=>[
						'security'=> [
							["bearerAuth"=>[]]
						],
						'tags'=>['user'],
						'operationId'=>'Delete User',	
						'parameters'=> [
							[
								'name' => 'id',							
								'description'=> 'id User',
								'in'=>'query',
								'required'=> true,
								'schema' => [
									'type' => 'integer',										
									]			
							]
							
						],	
						'responses'=>[
							'200'=> [
								'description'=>'Delete Success'
							],

						],
					]

				],
			],
			'components'=>[
				'securitySchemes'=>[
						'bearerAuth'=> [
							'type'=>'http',
							'scheme'=>'Bearer',
							'bearerFormat'=>'JWT',
						]
				]
			]
		];

		echo json_encode($da);
	}

	public function api()
	{
		$this->load->view('doc');
	}

}
