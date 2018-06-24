<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert($userid, $title, $content) {
        $this->db->insert("article", 
        	Array(
        	"userid" =>  $userid,
        	"title" => $title,
        	"content" => $content,
            "view" => 0 
        ));
        return $this->db->insert_id();
    }

    function get($articleid) {
        $this->db->select("article.*,user.userid,user.username");
        $this->db->from('article');
        $this->db->join('user', 'article.userid = user.userid', 'left');
        $this->db->where(Array("articleid" => $articleid));
        $query = $this->db->get();

        //查無此文章
        if ($query->num_rows() <= 0) {
            return null;
        }

        return $query->row();
    }

    function updateView($articleid, $view) {
        $data = array(
            'view' => $view,
        );

        $this->db->where('articleid', $articleid);
        $this->db->update('article', $data);
    }

    function countArticlesByUser($userid) {
        $this->db->select("count(articleid) as total");
        $this->db->from('article');
        $this->db->where(Array("userid" => $userid));
        $query = $this->db->get();

        if ($query->num_rows() <= 0) {
            return null;
        }
        return $query->row()->total;
    }

    function getArticlesByUser($userid, $offset = 0, $pageSize = 20) {
        $this->db->select("article.*,user.userid,user.username");
        $this->db->from('article');
        $this->db->join('user', 'article.userid = user.userid', 'left');
        $this->db->where(Array("article.userid" => $userid));
        $this->db->limit($pageSize,$offset);
        $this->db->order_by("articleid","desc");
        $query = $this->db->get();

        return $query->result();
    }

    function updateArticle($articleid, $title, $content) {
        $data = array(
            'title' => $title,
            'content' => $content
        );

        $this->db->where('articleid', $articleid);
        $this->db->update('article', $data);
    }

    function del($articleid) {
        $this->db->delete('article', array('articleid' => $articleid));
    }

    function getHotArticles($count = 5) {
        //依瀏覽數由大到小排序，抓前5筆
        $this->db->select("article.*,user.userid,user.username");
        $this->db->from('article');
        $this->db->join('user', 'article.userid = user.userid', 'left');
        $this->db->limit($count, 0);
        $this->db->order_by("view","desc");
        $query = $this->db->get();

        return $query->result();
    }

    function getHotAuthors($count = 5) {
        //依作者分組，取各組(作者)最大view的文章多到少排序，抓前五筆
        $this->db->select("user.*,max(view) as view");
        $this->db->from('article');
        $this->db->join('user', 'article.userid = user.userid', 'left');
        $this->db->limit($count, 0);
        $this->db->group_by("userid");
        $this->db->order_by("view desc");
        $query = $this->db->get();

        return $query->result();
    }
}
?>