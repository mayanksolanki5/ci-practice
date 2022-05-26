<?php

class Users extends MY_controller{
    // public function index()
    // {
    //     $this->load->view('users/articleList');
    // }

    public function index()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => 'e55bc5fbbd3e66',
            'smtp_pass' => 'fe6f0cabdbcbf9',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );

        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('180320107106.ce.mayank@gmail.com'); // change it to yours
        $this->email->to("mayanksolanki5401@gmail.com");// change it to yours
        $this->email->subject('Registration Successful');
        $this->email->message("Hello");

        $this->email->send();

        
        // exec('wget http://localhost/codeigniter/project/users/index');
    }
}

?>