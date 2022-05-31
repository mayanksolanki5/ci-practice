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


    public function exportexcel() {
        $this->load->model("Login_model");
    
        // $var = $this->Login_model->excelexport();
        $this->load->library('excel');
    
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
    
        $table_columns = array("ID", "Article Title", "Article Body");
    
        $column = 0;
    
        foreach($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
    
        $articles = $this->Login_model->excelexport();
    
        $excel_row = 2;
    
        foreach($articles as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->article_title);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->article_body);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->user_id);
            // $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->sendermobile);
            $excel_row++;
        }
        // date_default_timezone_set("Asia/Jakarta");
        // $this_date = date("Y-m-d");
        // $filename='pb_turnamen_data-'.$this_date.'.xls'; //save our workbook as this file name
        // header('Content-Type: application/vnd.ms-excel; charset=UTF-8'); //mime type
        // header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        // header('Cache-Control: max-age=0'); //no cache
    
        // $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        // ob_end_clean();
        // $objWriter->save('php://output');

        $file_name = time().".xlsx";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        $object_writer->save('php://output');
    }
     
}

?>