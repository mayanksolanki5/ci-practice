<?php

class Practice extends MY_controller{
    // public function index()
    // {
    //     $this->load->model('Login_model');
    //     $articles['articles'] = $this->Login_model->articleList();

    //     $this->load->view('articleView', $articles);
    // }

    public function exportCSV() {
        $this->load->helper('csv');
        $export_arr = array();

        $this->load->model('Login_model');
        $articles = $this->Login_model->articleList();
     
        $title = array("Id", "article_title", "article_body");
        array_push($export_arr, $title);
        if (!empty($articles)) {
            foreach ($articles as $article) {
                array_push($export_arr, array($article->id, $article->article_title, $article->article_body));
            }
        }
        convert_to_csv($export_arr, 'articles-  ' . date('F d Y') . '.csv', ',');
    }
     
}

?>