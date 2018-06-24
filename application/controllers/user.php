<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	public function signup() {
		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入註冊畫面
		$content = $this->load->view('signup',array(
			"userid" => '',
			"username" => '',
			"email" => ''
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 會員註冊',
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function signuping() {
		$userid = trim($this->input->post("userid"));
		$password = trim($this->input->post("password"));
		$passwordrt = trim($this->input->post("re-password"));
		$username = trim($this->input->post("username"));
		$email = trim($this->input->post("email"));

		$errorMessage = '';
		//檢查必填欄位
		if ($userid == "" || $password == "" || $passwordrt == "" || $username == "") {
			$errorMessage .= '帳號、密碼、姓名為必填欄位!<br>';
		}

		//檢查密碼是否一致
		if ($password != $passwordrt) {
			$errorMessage .= '密碼不一致!<br>';
		}

		$this->load->model("UserModel");
		//檢查帳號是否存在
		if ($this->UserModel->checkUserExist($userid)) {
			$errorMessage .= '此帳號已經被使用!<br>';
		}

		if (!empty($errorMessage)) {
			//載入導覽列樣板
			$navbar = $this->load->view('templates/navbar',array(),true);

			//載入註冊畫面
			$content = $this->load->view('signup',array(
				"userid" => htmlspecialchars($userid),
				"username" => htmlspecialchars($username),
				"email" => htmlspecialchars($email)
			),true);

			//載入主樣板
			$this->load->view('templates/main', array(
				"title" => '發文系統 - 會員註冊',
				"errorMessage" => $errorMessage,
				"navbar" => $navbar,
				"content" => $content
			));
			return false;
		}

		//建立新帳號
		$this->UserModel->insert($userid, $password, $username, $email);

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入登入畫面
		$content = $this->load->view('login',array(
			"userid" => htmlspecialchars($userid)
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 會員登入',
			"Message" => '註冊成功.' ,
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function login() {
		//已經登入的話直接回首頁
		if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
			redirect(base_url("/"));
			return true;
		}
		
		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入登入畫面
		$content = $this->load->view('login',array(
			"userid" => ''
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 會員登入',
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function logining() {
		//已經登入的話直接回首頁
		if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
			redirect(base_url("/"));
			return true;
		}
		$userid = trim($this->input->post("userid"));
		$password = trim($this->input->post("password"));
		$this->load->model("UserModel");
		$user = $this->UserModel->getUser($userid,$password);
		if ($user == null) {
			//載入導覽列樣板
			$navbar = $this->load->view('templates/navbar',array(),true);
			//載入登入畫面
			$content = $this->load->view('login',array(
				"userid" => htmlspecialchars($userid)
			),true);

			//載入主樣板
			$this->load->view('templates/main', array(
				"title" => '發文系統 - 會員登入',
				"errorMessage" => '帳號或密碼錯誤!',
				"navbar" => $navbar,
				"content" => $content
			));
			return true;
		}

		//記錄登入者，轉回首頁
		$_SESSION["user"] = $user;
		redirect(base_url("/"));
	}

	public function logout() {
		//刪除登入者資料，轉回登入頁
		session_start();
		session_destroy();
		redirect(base_url("/user/login"));
	}
}