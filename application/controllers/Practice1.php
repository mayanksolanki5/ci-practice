<?php

class Practice1 extends MY_controller{
    // public function mail()
    // {
        // $this->load->model("Login_model");
    
        // // $var = $this->Login_model->excelexport();
        // $this->load->library('excel');
    
        // $object = new PHPExcel();
        // $object->setActiveSheetIndex(0);
    
        // $table_columns = array("ID", "Article Title", "Article Body");
    
        // $column = 0;
    
        // foreach($table_columns as $field) {
        //     $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
        //     $column++;
        // }
    
        // $articles = $this->Login_model->excelexport();
    
        // $excel_row = 2;
    
        // foreach($articles as $row) {
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->article_title);
        //     $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->article_body);
        //     $excel_row++;
        // }

        // // $file_name = time().".xlsx";
        // $file_name = "abcd.xlsx";
        // $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        // ob_end_clean();
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename='.$file_name);
        // $object_writer->save('php://output');


        // $config = Array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'smtp.googlemail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => '180320107106.ce.mayank@gmail.com', // change it to yours
        //     'smtp_pass' => '****', // change it to yours
        //     'smtp_crypto' => 'ssl',
        //     'mailtype' => 'text',
        //     'charset' => 'iso-8859-1',
        //     'wordwrap' => TRUE
        //   );

        // // $message = "\n\t\t\tRegistration Details" . "\n\n\t\t\t\t\tThank You For Register Your Self!";
        // $message = "Thank You For Register Your Self!";
        
        // $this->load->library('email', $config);
        // $this->email->set_newline("\r\n");
        // $this->email->from('180320107106.ce.mayank@gmail.com'); // change it to yours
        // $this->email->to('mayanksolanki5401@gmail.com');// change it to yours
        // $this->email->subject('Learning');
        // $this->email->message($object_writer);
        // $this->email->attach("http://project.local/practice/exportexcel");

        // if ($this->email->send()) {

        //     // $this->session->set_flashdata('success', 'Record added Successfully!');
        //     $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
        //     redirect(base_url().'/admin/welcome');    

        // } else {
        //     show_error($this->email->print_debugger());
        // }
    // }


    public function mail()
    {
        $data['filetype'] = $this->input->post('filetype');
        $data['email'] = $this->input->post('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => '180320107106.ce.mayank@gmail.com', // change it to yours
            'smtp_pass' => '****', // change it to yours
            'smtp_crypto' => 'ssl',
            'mailtype' => 'text',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
          );

        // $message = "\n\t\t\tRegistration Details" . "\n\n\t\t\t\t\tThank You For Register Your Self!";
        $message = "Thank You For Register Your Self!";
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('180320107106.ce.mayank@gmail.com'); // change it to yours
        $this->email->to($data['email']);// change it to yours
        $this->email->subject('Learning');
        $this->email->message($message);

        if($data['filetype'] == 'csv'){
            $this->email->attach("D:\NewFolder\csvfile.csv");

            if ($this->email->send()) {
                
                // $this->session->set_flashdata('success', 'Record added Successfully!');
                $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
                redirect(base_url().'/admin/welcome');    
                
            } else {
                show_error($this->email->print_debugger());
            }
            
        }
        elseif($data['filetype'] == 'xlsx'){
            $this->email->attach("D:\NewFolder\xlfile.xlsx");

            if ($this->email->send()) {

                // $this->session->set_flashdata('success', 'Record added Successfully!');
                $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
                redirect(base_url().'/admin/welcome');    
    
            } else {
                show_error($this->email->print_debugger());
            }
    
        }

    }
}

?>