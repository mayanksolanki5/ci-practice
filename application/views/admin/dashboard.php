<?php include('header.php'); ?>

<div class="container">
    <?php $success = $this->session->userdata('success');
        if($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
</div>

<div class="container my-3">
    <div class="container d-flex justify-content-between bg-dark center my-3 py-2">
        <div></div>
        <h4 style="color:white">Articles Table</h4>
        <a class="btn brn-sm btn-primary" href="<?php echo base_url().'/Admin/addArticle'; ?>">Add Article</a>
    </div>
    <!-- <a class="btn btn-danger" href="<?php echo base_url().'/Admin/sendMail'; ?>">Send Mail</a> -->

    <div>
        <table class="table table-striped" id="article-table">
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
                        <td><a href="<?php echo base_url().'/Admin/edit/'.$article->id ?>" class="btn btn-secondary">Edit</a></td>
                        <td><a href="<?php echo base_url().'/Admin/delete/'.$article->id ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                        <?php // else: ?>
                            <!-- <tr>
                                <td colspan="4">No Data Available</td>
                            </tr> -->
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    // $(document).ready(function() {
        $('#article-table').DataTable();
    // });
</script>

<?php include('footer.php'); ?>