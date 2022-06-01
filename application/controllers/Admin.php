<?php

class Admin extends MY_controller{

    // public function __construct()
    // {
    //     parent::__construct();   
    //     if(!$this->session->userdata('id'))
    //         return redirect('admin/index');
    // }

    public function index()
    {
        if($this->session->userdata('id'))
            return redirect('admin/welcome');

        $this->form_validation->set_rules('username', 'User Name', 'required|alpha');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[12]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">**', '</div>');

        if($this->form_validation->run()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $this->load->model('Login_model');

            $id = $this->Login_model->isValidate($username, $password);

            if($id){
                // $this->load->library('session');
                $this->session->set_userdata('id', $id);

                return redirect('admin/welcome');
            }
            else{
                $this->session->set_flashdata('failure', 'Record Not Matched! Please Try Agian.');
                redirect(base_url().'/admin/index');
                // echo 'Details Not Matched';
            }
        }
        else{
            $this->load->view('admin/login');
            // echo validation_errors();
        }
    }
    

    public function welcome()
    {
        if(!$this->session->userdata('id'))
            return redirect('admin/index');

        $this->load->model('Login_model');
        $articles = $this->Login_model->articleList();

        $this->load->view('admin/dashboard', ['articles' => $articles]);
    }


    public function register()
    {
        $this->form_validation->set_rules('username', 'User Name', 'required|alpha|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[20]');
        $this->form_validation->set_rules('lastname', 'Last name', 'required|max_length[20]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">**', '</div>');

        if($this->form_validation->run()){
            
            $this->load->model('Login_model');
            
            $formArr = array();
            $formArr['username'] = $this->input->post('username');
            $formArr['email'] = $this->input->post('email');
            $formArr['password'] = $this->input->post('password');
            $formArr['firstname'] = $this->input->post('firstname');
            $formArr['lastname'] = $this->input->post('lastname');
            // $data = $this->input->post();
            // $this->Login_model->create($data);
            $this->Login_model->create($formArr);


            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');

            $message = "\n\t\t\tRegistration Details" . "\n\nUser Name : " . $username . "\n\nEmail : " . $email . "\n\nPassword : " . $password . "\n\nFirst Name : " . $firstname . "\n\nLast Name : " . $lastname . "\n\n\t\t\t\t\tThank You For Register Your Self!";

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
            $this->email->to($email);// change it to yours
            $this->email->subject('Registration Successful');
            $this->email->message($message);
    
            if ($this->email->send()) {
    
                $this->session->set_flashdata('success', 'Record added Successfully!');
                // $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
                redirect(base_url().'/admin/index');    

            } else {
                show_error($this->email->print_debugger());
            }

        }
        else{
            $this->load->view('admin/register');
        }

    }

    public function addArticle()
    {
        if(!$this->session->userdata('id'))
        return redirect('admin/index');

        $this->form_validation->set_rules('article_title', 'Article Title', 'required');
        $this->form_validation->set_rules('article_body', 'Article Body', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">**', '</div>');

        if($this->form_validation->run()){
            $this->load->model('Login_model');

            $formArr = array();
            $formArr['article_title'] = $this->input->post('article_title');
            $formArr['article_body'] = $this->input->post('article_body');        
            $formArr['user_id'] = $this->session->userdata('id');
            
            $this->Login_model->addArticle($formArr);

            $this->session->set_flashdata('success', 'Record added Successfully!');

            redirect(base_url().'/admin/welcome');

        }
        else{
            $this->load->view('admin/addArticle');
        }
    }

    public function delete($id)
    {
        if(!$this->session->userdata('id'))
        return redirect('admin/index');

        $this->load->model('Login_model');

        $this->Login_model->deleteArticle($id);
        
        $this->session->set_flashdata('success', 'Record Deleted Successfully!');

        redirect(base_url().'/admin/welcome');
        
    }

    public function edit($id)
    {
        if(!$this->session->userdata('id'))
        return redirect('admin/index');

        $this->load->model('Login_model');
        $article = $this->Login_model->getUser($id);

        $data = array();
        $data['article'] = $article;

        $this->form_validation->set_rules('article_title', 'Article Title', 'required');
        $this->form_validation->set_rules('article_body', 'Article Body', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">**', '</div>');

        if($this->form_validation->run() == false){
            $this->load->view('admin/editArticle', $data);
        }else{
            $formArr = array();
            $formArr['article_title'] = $this->input->post('article_title');
            $formArr['article_body'] = $this->input->post('article_body');
            $this->Login_model->updateArticle($id, $formArr);

            $this->session->set_flashdata('success', 'Record updated Successfully!');
            redirect(base_url().'/admin/welcome');
        }
    }

    
    public function logout()
    {
        if(!$this->session->userdata('id'))
        return redirect('admin/index');

        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        return redirect(base_url().'/admin/index');   
    }


    // public function sendMail()
    // {
    //     $config = Array(
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'smtp.mailtrap.io',
    //         'smtp_port' => 2525,
    //         'smtp_user' => 'e55bc5fbbd3e66',
    //         'smtp_pass' => 'fe6f0cabdbcbf9',
    //         'crlf' => "\r\n",
    //         'newline' => "\r\n"
    //     );
          
    //     // $config = Array(
    //     //     'protocol' => 'smtp',
    //     //     'smtp_host' => 'smtp.gmail.com',
    //     //     'smtp_port' => 465,
    //     //     'smtp_user' => '180320107106.ce.mayank@gmail.com', // change it to yours
    //     //     'smtp_pass' => '****', // change it to yours
    //     //     'smtp_crypto' => 'ssl',
    //     //     'mailtype' => 'text',
    //     //     'charset' => 'iso-8859-1',
    //     //     'wordwrap' => TRUE
    //     //   );
        
    //     $message = 'Thank you for Register Your Self in our website!';
    //     $this->load->library('email', $config);
    //     $this->email->set_newline("\r\n");
    //     $this->email->from('180320107106.ce.mayank@gmail.com'); // change it to yours
    //     $this->email->to('mayanksolanki5401@gmail.com');// change it to yours
    //     $this->email->subject('Registraion');
    //     $this->email->message($message);

    //     if ($this->email->send()) {

    //         $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
    //         redirect(base_url().'/admin/welcome');

    //     } else {
    //         show_error($this->email->print_debugger());
    //     }
        
    // }
    


    function pdf(){
        $this->load->library('pdf');

        $this->load->model('Login_model');
        $articles['articles'] = $this->Login_model->articleList();

        $html = $this->load->view('GeneratePdfView', $articles, true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }
    
}

?>