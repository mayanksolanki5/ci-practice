<?php include('header.php') ?>



<div class="container">
    <h2>Update Article</h2>

    <?php echo form_open('admin/edit/'.$article['id']); ?>

        <div class="form-group">
            <label for="article_title" class="col-sm-2 col-form-label">Article Title</label>        
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Article Title', 'name' => 'article_title', 'value' => set_value('article_title', $article['article_title'])]); ?>
            <?php echo form_error('article_title') ?>
        </div>

        <div class="form-group">
            <label for="article_body" class="col-sm-2 col-form-label">Article Body</label>
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Article Body', 'name' => 'article_body', 'value' => set_value('article_body', $article['article_body'])]); ?>
            <?php echo form_error('article_body') ?>
        </div>

        <div class="form-group">
            <?php echo form_submit(['class' => 'btn btn-primary my-2', 'value' => "Update"]); ?>
            <?php // echo form_reset(['class' => 'btn btn-secondary my-2', 'value' => "reset"]); ?>
            <a class="btn btn-info" href="<?php echo base_url().'/admin/welcome'; ?>">Back</a>
        </div>

</div>




<?php include('footer.php') ?>