<?php

class Practice2 extends MY_controller{
    public function cronjob()
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

    
        $this->load->dbutil(); 
        $this->load->helper('file'); 
        
        $this->load->helper('download');
        $delimiter = ","; 
        $newline = "\r\n";
        $filename = "csvFile.csv";  
        
        $user_id = $this->session->userdata('id'); 
        $result = $this->db->query("SELECT * from  articles
        where created_at >= DATE_SUB(NOW(),INTERVAL 1 HOUR)");

        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        if ( ! write_file('./files/csvFile.csv', $data))
        {
            $this->session->set_flashdata('failure', 'File not saved!');            
            echo "file not created";
            // redirect(base_url().'/admin/welcome');    
        }
        else 
        {
            $this->email->attach("./files/csvfile.csv");
            if ($this->email->send()) {
                // $this->session->set_flashdata('success', 'Record added Successfully!');
                $this->session->set_flashdata('success', 'Mail Sent Successfully!');            
                echo "sent";
                // redirect(base_url().'/admin/welcome');    
            
            } else {
                show_error($this->email->print_debugger());
            }    
        }

    }
    public function cronjobb()
    {
        $user_id = $this->session->userdata('id'); 
        $result = $this->db->query("SELECT * from  articles
        where created_at >= DATE_SUB(NOW(),INTERVAL 2 HOUR) AND user_id =  $user_id ")->result_array();
        
        foreach ($result as $article) {
            print_r($article);
        }
    }
}

?>