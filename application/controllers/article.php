<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {
	public function author($userid = null, $offset = 0)
	{
		//沒傳入作者或查無此作者
		if ($userid == null) {
			show_404("Author not found !");
			return true;
		}

		$this->load->model("UserModel");
		$user = $this->UserModel->getUserByAccount($userid);
		if ($user == null) {
			show_404("Author not found !");
			return true;
		}

		$pageSize = 20;
		$this->load->model("ArticleModel");

		//載入分頁class
		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url('/article/author/'.$userid.'/');
		$config['total_rows'] = $this->ArticleModel->countArticlesByUser($user->userid);
		$config['per_page'] = $pageSize;
		$this->pagination->initialize($config);

		//抓此作者所有文章
		$results = $this->ArticleModel->getArticlesByUser($user->userid, $offset, $pageSize);

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入文章列表畫面
		$content = $this->load->view('article_author',array(
			"results" => $results,
			"user" => $user,
			"pageLinks" => $this->pagination->create_links()
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - '.$user->username.' 的文章列表',
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function post() {
		//尚未登入，轉回登入頁
		if (!isset($_SESSION["user"])) {
			redirect(base_url("/user/login"));
			return true;
		}

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入發文畫面
		$content = $this->load->view('article_post',array(
			"title" => '',
			"content" => ''
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 發表文章',
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function posting() {
		//尚未登入，轉回登入頁
		if (!isset($_SESSION["user"])) {
			redirect(base_url("/user/login"));
			return true;
		}

		$title = trim($this->input->post("title"));
		$content = trim($this->input->post("content"));
		
		if ($title == "" || $content == "" ) {
			//載入導覽列樣板
			$navbar = $this->load->view('templates/navbar',array(),true);
			//載入發文畫面
			$content = $this->load->view('article_post',array(
				"title" => htmlspecialchars($title),
				"content" => htmlspecialchars($content)
			),true);

			//載入主樣板
			$this->load->view('templates/main', array(
				"title" => '發文系統 - 發表文章',
				"errorMessage" => '標題、內容為必填欄位!',
				"navbar" => $navbar,
				"content" => $content
			));
			return false;
		}

		//發文後轉向自己的文章列表
		$this->load->model("ArticleModel");
		$insertID = $this->ArticleModel->insert($_SESSION["user"]->userid,$title,$content);
		redirect(base_url("article/author/".$_SESSION["user"]->userid));
	}

	public function edit($articleid = null) {
		//尚未登入，轉回登入頁
		if (!isset($_SESSION["user"])) {
			redirect(base_url("/user/login"));
			return true;
		}

		if ($articleid == null) {
			show_404("Article not found !");
			return true;
		}

		$this->load->model("ArticleModel");
		$article = $this->ArticleModel->get($articleid);

		//不是作者,轉回首頁
		if ($article->userid != $_SESSION["user"]->userid) {
			show_404("Article not found !");
			redirect(base_url("/"));
			return true;
		}

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入修改文章畫面
		$content = $this->load->view('article_edit',array(
			"article" => $article
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 修改文章',
			"navbar" => $navbar,
			"content" => $content
		));
	}

	public function editing() {
		$articleid = trim($this->input->post("articleid"));
		$title = trim($this->input->post("title"));
		$content = trim($this->input->post("content"));

		//尚未登入，轉回登入頁
		if (!isset($_SESSION["user"])) {
			redirect(base_url("/user/login")); 
			return true;
		}		

		if ($articleid == null) {
			show_404("Article not found !");
			return true;
		}

		$this->load->model("ArticleModel");
		$article = $this->ArticleModel->get($articleid);  

		//不是作者,轉回首頁
		if ($article->userid != $_SESSION["user"]->userid) {
			show_404("Article not found !");
			redirect(base_url("/")); 
			return true;
		}

		//更新後，轉回文章瀏覽頁面
		$this->ArticleModel->updateArticle($articleid, $title, $content);
		redirect(base_url("article/view/".$articleid));
	}

	public function del($articleid = null) {
		//尚未登入，轉回登入頁
		if (!isset($_SESSION["user"])) {
			redirect(base_url("/user/login"));
			return true;
		}

		if ($articleid == null) {
			show_404("Article not found !");
			return true;
		}

		$this->load->model("ArticleModel");
		$article = $this->ArticleModel->get($articleid);

		//不是作者,轉回首頁
		if ($article->userid != $_SESSION["user"]->userid) {
			show_404("Article not found !");
			redirect(base_url("/"));
			return true;
		}

		//刪除後，轉回文章列表頁面
		$this->ArticleModel->del($articleid);
		redirect(base_url("article/author/".$_SESSION["user"]->userid));
	}

	public function view($articleid = null) {
		//沒傳入文章編號或查無此文章
		if ($articleid == null) {
			show_404("Article not found !");
			return true;
		}

		$this->load->model("ArticleModel");
		$article = $this->ArticleModel->get($articleid); 
		if ($article == null) {
			show_404("Article not found !");
			return true;	
		}

		//更新文章瀏覽數
		$this->ArticleModel->updateView($articleid,$article->view +1);

		//載入導覽列樣板
		$navbar = $this->load->view('templates/navbar',array(),true);
		//載入文章畫面
		$content = $this->load->view('article_view',array(
			"article" => $article
		),true);

		//載入主樣板
		$this->load->view('templates/main', array(
			"title" => '發文系統 - 瀏覽文章',
			"navbar" => $navbar,
			"content" => $content
		));
	}
}