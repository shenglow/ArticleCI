<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->load->model("ArticleModel");
		$hotArticles = $this->ArticleModel->getHotArticles();
		$hotUsers = $this->ArticleModel->getHotAuthors();

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);

		$content = $this->load->view('home',Array(
			"hotArticles" => $hotArticles,
			"hotUsers" => $hotUsers
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統首頁',
			"navbar" => $navbar,
			"content" => $content
		));

		
	}
}