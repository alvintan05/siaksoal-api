<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class UserService extends REST_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user', 'mu');
	}


	public function index_get()
	{
		$responseCode = "X5";
		$responseDesc = "Failed to load data";
		$responseData = null;

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function getUserInfo_get($userId)
	{
		$data = $this->mu->getUser($userId);

		$responseCode = "200";
		$responseDesc = "Success get user";
		$responseData = $data;

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function createUser_post()
	{

		$post = $this->post();

		$this->form_validation->set_data($post);
		$this->form_validation->set_rules('userName', 'User Name', 'required|is_unique[user.userName]');
		$this->form_validation->set_rules('userEmail','Email','required|is_unique[user.userEmail]');
		$this->form_validation->set_rules('userNumber','Number','required');
		$this->form_validation->set_rules('userAddress','Address','required');
		$this->form_validation->set_rules('userPassword','Password','required');

		$responseData = null;
		if ($this->form_validation->run() == TRUE) {

			$insertData = array(
				'userName' => $this->post('userName'),
				'userEmail' => $this->post('userEmail'),
				'userNumber' => $this->post('userNumber'),
				'userAddress' => $this->post('userAddress'),
				'userPicture' => $this->post('userPicture'),
				'userPassword' => md5($this->post('userPassword'))
			);

			$query = $this->mu->insertUser($insertData);

			if ($query) {
				$responseCode = "00";
				$responseDesc = "Success to create user";
			}
			else{	
				$responseCode = "01";
				$responseDesc = "Failed to create user";
			}

		}
		else{
			$responseCode = "401";
			$responseDesc = $this->form_validation->error_array();
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function updatePassword_put($userId='')
	{
		$post = $this->put();

		$this->form_validation->set_data($post);
		$this->form_validation->set_rules('userPassword','Password','required');

		$responseData = null;
		if ($this->form_validation->run() == TRUE) {

			$updateData = array(
				'userPassword' => md5($this->put('userPassword'))
			);

			$query = $this->mu->update_user($userId, $updateData);

			if ($query) {
				$responseCode = "00";
				$responseDesc = "Success to update password";
			}
			else{
				$responseCode = "01";
				$responseDesc = "Failed to update password";
			}

		}
		else{
			$responseCode = "401";
			$responseDesc = $this->form_validation->error_array();
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}


	public function updateUserInfo_put($userId)
	{

		$post = $this->put();

		$this->form_validation->set_data($post);
		$stateEmail = $this->handleUniqueEmail($post['userEmail'], $post['oldUserEmail']);
		$stateName = $this->handleUniqueName($post['userName'], $post['oldUserName']);

		$this->form_validation->set_rules('userName','Username','required'.$stateEmail);
		$this->form_validation->set_rules('userEmail','Email','required'.$stateName);
		$this->form_validation->set_rules('userNumber','Number','required');
		$this->form_validation->set_rules('userAddress','Address','required');
		$this->form_validation->set_rules('userPicture','Picture','required');

		$responseData = null;
		if ($this->form_validation->run() == TRUE) {

			$updateData = array(
				'userName' => $this->put('userName'),
				'userEmail' => $this->put('userEmail'),
				'userNumber' => $this->put('userNumber'),
				'userAddress' => $this->put('userAddress'),
				'userPicture' => $this->put('userPicture')
			);

			$query = $this->mu->updateUser($userId, $updateData);

			if ($query) {
				$responseCode = "00";
				$responseDesc = "Success to update user";
			}
			else{
				$responseCode = "01";
				$responseDesc = "Failed to update user";
			}

		}
		else{
			$responseCode = "401";
			$responseDesc = $this->form_validation->error_array();
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);
	}

	public function deleteUserInfo_delete($userId)
	{

		$query = $this->mu->deleteUser($userId);

		if ($query) {
			$responseCode = "00";
			$responseDesc = "Success to delete user";
			$responseData = null;
		}

		else{
			$responseCode = "01";
			$responseDesc = "Failed to delete user";
			$responseData = null;
		}
		

		$response = resultJson( $responseCode, $responseDesc, $responseData);

		$this->response($response, 200);

	}


	public function handleUniqueEmail($newEmail='', $oldEmail ="")
	{
		$retr = '';
		if ($oldEmail != $newEmail) {
			return $retr = '|is_unique[user.userEmail]';
		}

		return $retr;
	}

	public function handleUniqueName($newName='', $oldName ="")
	{
		$retr = '';
		if ($oldName != $newName) {
			return $retr = '|is_unique[user.userName]';
		}

		return $retr;
	}





}
