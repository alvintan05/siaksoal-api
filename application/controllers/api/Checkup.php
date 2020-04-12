<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Checkup extends REST_Controller {


    public function index_get()
    {
        $retr = array(
        	'status' => 'ACTIVE',
        	'verion' => '1.0'
        );

        $this->response($retr, 200);
    }

}
