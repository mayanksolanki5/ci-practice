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
                    // saves at specific folder 
        $object_writer->save((str_replace(__FILE__,'files/'.$file_name.'.xlsx',__FILE__)));
        // $object_writer->save('php://output');
    }


                            // with email library
    public function mail()
    {
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
        $this->email->to('mayanksolanki5401@gmail.com');// change it to yours
        $this->email->subject('Learning');
        $this->email->message($message);
        $this->email->attach("D:\NewFolder\html.png");

        if ($this->email->send()) {

            // $this->session->set_flashdata('success', 'Record added Successfully!');
            $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
            redirect(base_url().'/admin/welcome');    

        } else {
            show_error($this->email->print_debugger());
        }

    }

                                // PHP Mailer
    // public function mail()
    // {
    //     // Load PHPMailer library
    //     $this->load->library('phpmailer_lib');

    //     // PHPMailer object
    //     $mail = $this->phpmailer_lib->load();
        
    //     // SMTP configuration
    //     $mail->isSMTP();
    //     $mail->Host     = 'smtp.googlemail.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = '180320107106.ce.mayank@gmail.com';
    //     $mail->Password = '****';
    //     $mail->SMTPSecure = 'ssl';
    //     $mail->Port     = 465;
        
    //     $mail->setFrom('info@example.com', 'CodexWorld');
    //     $mail->addReplyTo('info@example.com', 'CodexWorld');
        
    //     // Add a recipient
    //     $mail->addAddress('180320107106.ce.mayank@gmail.com');
        
    //     // Add cc or bcc 
    //     $mail->addCC('cc@example.com');
    //     $mail->addBCC('bcc@example.com');
        
    //     // Email subject
    //     $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
    //     // Set email format to HTML
    //     $mail->isHTML(true);
        
    //     // Email body content
    //     $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
    //         <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
    //     $mail->Body = $mailContent;
        
    //     // Send email
    //     if(!$mail->send()){
    //         echo 'Message could not be sent.';
    //         echo 'Mailer Error: ' . $mail->ErrorInfo;
    //     }else{
    //         echo 'Message has been sent';
    //     }
    // }
            
        
    
     
}

?>