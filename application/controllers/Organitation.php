<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Organitation extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->_authenticate();
		header('Content-Type: application/json');
    }

	  /**
     * @OA\Get(
     *     path="/organitation",
     *     tags={"organitation"},
	 * 	   description="Get all organitation param id null, get specific with param id",
	 *     @OA\Parameter(
     *       name="id",
	 *       description="id organitation",
     *       in="query",
     *       @OA\Schema(type="integer",default=null)
     *   ),
     *    @OA\Response(response="200", 
	 * 		description="Success",
	 *      @OA\JsonContent(     
     *          @OA\Property(property="message",type="boolean"),
     *          @OA\Property(property="data",type="array",
	 *          @OA\Items(
	 *         @OA\Property(property="id", type="integer", default=1),
     *         @OA\Property(property="name", type="string", default="sample"),
	 *         @OA\Property(property="code", type="string", default="HO"),
	 * 			)),
     *     ),
	 * ),
     *    @OA\Response(response="401", description="Unauthorized"),
	 *   security={{"bearerAuth": {}}},
     * )
     */



	public function index_get()
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
		$this->response($data,200);
	}

}
