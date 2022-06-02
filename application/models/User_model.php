<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @OA\Schema(schema="UserModel")
 */

class User_model extends CI_Model {

	private $tableName = "usm_users";

	/**
     * @OA\Property()
     * @var integer
     */

	public $id;

	/**
     * @OA\Property()
     * @var string
     */

	public $username;


	/**
     * @OA\Property()
     * @var string
     */

	public $nama;


	/**
     * @OA\Property()
     * @var string
     */

	public $alamat;

	/**
     * @OA\Property()
     * @var string
     */

	public $nohp;


	/**
     * @OA\Property()
     * @var string
     */

	public $email;



}
