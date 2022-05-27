<?php

class Login_model extends CI_Model{

    public function isValidate($username, $password)
    {
        $q = $this->db->where(['username' => $username, 'password' => $password])
                 ->get('users');

        if($q->num_rows()){
            return $q->row()->id;
        }
        else{
            return false;
        }

    }


    public function articleList()
    {
        $user_id = $this->session->userdata('id'); 

        $q = $this->db->where('user_id', $user_id);
        $q = $this->db->get('articles');

        return $q->result();

        // $q = $this->db->select('article_title')->from('articles')->where('id', $id)->get();
        // print_r($q->result());
        // exit;
    }


    public function create($formArr)
    {
        $this->db->insert('users', $formArr);
    }


    public function addArticle($formArr)
    {
        $this->db->insert('articles', $formArr);
    }

    // for importing csv file 
    public function insertCSV($formArr = array())
    {
        $this->db->insert('articles', $formArr);
    }


    public function deleteArticle($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('articles');
    }


    public function getUser($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('articles')->row_array();
    }

    public function updateArticle($id, $formArr)
    {
        $this->db->where('id', $id);
        $this->db->update('articles', $formArr);
    }

}


?>