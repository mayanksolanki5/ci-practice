<?php

class Admin extends MY_controller{


    public function index()
    {
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
        $this->load->model('Login_model');
        $articles = $this->Login_model->articleList();

        $this->load->view('admin/dashboard', ['articles' => $articles]);
    }


    public function register()
    {
        $this->form_validation->set_rules('username', 'User Name', 'required|alpha|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[20]');
        $this->form_validation->set_rules('lastname', 'Last name', 'required|max_length[20]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">**', '</div>');

        if($this->form_validation->run()){
            
            $this->load->model('Login_model');
            
            $formArr = array();
            $formArr['username'] = $this->input->post('username');
            $formArr['password'] = $this->input->post('password');
            $formArr['firstname'] = $this->input->post('firstname');
            $formArr['lastname'] = $this->input->post('lastname');
            
            $this->Login_model->create($formArr);

            $this->session->set_flashdata('success', 'Record added Successfully!');

            redirect(base_url().'/admin/index');


        }
        else{
            $this->load->view('admin/register');
        }

    }

    public function addArticle()
    {
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
        $this->load->model('Login_model');

        $this->Login_model->deleteArticle($id);
        
        $this->session->set_flashdata('success', 'Record Deleted Successfully!');

        redirect(base_url().'/admin/welcome');
        
    }

    public function edit($id)
    {
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
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect(base_url().'/admin/index');   
    }
}

?>