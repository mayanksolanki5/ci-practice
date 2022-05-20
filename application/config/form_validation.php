<?php

$config  = [
    'add_form_rule' => [
        [
            'field' => 'article_title',
            'label' => 'Article Title',
            'rules' => 'required'
        ],
        [
            'field' => 'article_body',
            'label' => 'Article Body',
            'rules' => 'required'
        ],
    ],
];

            // In Controller 

// if($this->form_validation->run('add_form_rule')){
//     // condition
// }else{
//     // redirect to that existing page
// }

?>