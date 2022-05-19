<?php

class Users extends MY_controller{
    public function index()
    {
        $this->load->view('users/articleList');
    }
}

?>