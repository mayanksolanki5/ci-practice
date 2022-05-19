<?php include('header.php'); ?>

<div class="container">
    <?php $success = $this->session->userdata('success');
        if($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
</div>

<div class="container">
    <a class="btn btn-info" href="<?php echo base_url().'/Admin/addArticle'; ?>">Add Article</a>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php if(count($articles)): ?>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?php echo $article->id ?></td>
                        <td><?php echo $article->article_title ?></td>
                        <td><a href="<?php echo base_url().'/Admin/edit/'.$article->id ?>" class="btn btn-primary">Edit</a></td>
                        <td><a href="<?php echo base_url().'/Admin/delete/'.$article->id ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No Data Available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>