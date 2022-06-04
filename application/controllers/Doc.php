<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Doc extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		/**
		 * @OA\Info(title="Mockup Api Survey", version="0.1")				 
		 * @OA\SecurityScheme(
		*      securityScheme="bearerAuth",
		*      in="header",
		*      name="bearerAuth",
		*      type="http",
		*      scheme="bearer",
		*      bearerFormat="JWT",
		* ),
		 */
		$this->load->view('doc');

		/**
		 * @OA\Schema(schema="required",
		 *  @OA\Property(property="status", default=false,type="boolean"),
		 *   @OA\Property(property="message", default="field required",type="string"),
		 * )
		 */



	}

}
