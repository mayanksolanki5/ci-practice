<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
 <head> 
   <meta charset="utf-8"> 
   <title>Export MySQL data to CSV file in CodeIgniter 3</title>
 </head>
 <body>
   <!-- Export Data --> 
   <a href='<?= base_url() ?>/Practice/exportCSV'>Export</a><br><br>

   <!-- User Records --> 
   <table border='1' style='border-collapse: collapse;'> 
     <thead> 
      <tr> 
       <th>id</th> 
       <th>Article_title</th> 
       <th>article_body</th> 
      </tr> 
     </thead> 
     <tbody> 
     <?php foreach($articles as $article): ?>
            <tr>
                <td><?php echo $article->id; ?></td>
                <td><?php echo $article->article_title; ?></td>
                <td><?php echo $article->article_body; ?></td>
            </tr>
        <?php endforeach; ?> 
     </tbody> 
    </table>
  </body>
</html>