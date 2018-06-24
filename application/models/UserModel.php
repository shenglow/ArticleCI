<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    //檢查帳號是否存在
    function checkUserExist($userid) {
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("userid", $userid);
        $query = $this->db->get();

        return $query->num_rows() > 0 ;
    }

    function insert($userid, $password, $username, $email) {
        $this->db->insert("user", 
        	Array(
        	"userid" =>  $userid,
        	"password" => $password,
            "username" => $username,
        	"email" => $email
        ));
    }

    public function getUser($userid, $password) {
        $this->db->select("*");
        $query = $this->db->get_where("user",Array("userid" => $userid, "password" => $password));

        //有找到符合的資料，回傳資料
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function getUserByAccount($userid) {
        $this->db->select("*");
        $query = $this->db->get_where("user",Array("userid" => $userid));

        //查無此人
        if ($query->num_rows() <= 0) {
            return null;
        }

        return $query->row();
    }
}
?>