<?php include('header.php'); ?>

<div class="container">
    <?php $success = $this->session->userdata('success');
        if($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
</div>
<?php // echo extension_loaded('mcrypt') ? 'Yup' : 'Nope'; ?>
<div class="container my-3">
    <div class="container d-flex justify-content-between bg-dark center my-3 py-2">
        <div></div>
        <div><h4 style="color:white">Articles Table</h4></div>
        <div>        
            <a class="btn btn-sm btn-primary" href="<?php echo base_url().'/Admin/addArticle'; ?>">Add Article</a>
            <a class="btn btn-sm btn-primary" href="<?php echo base_url().'/Admin/pdf'; ?>">Download PDF</a>
            <a class="btn btn-sm btn-primary" href="<?php echo base_url().'/Practice/exportCSV'; ?>">Export CSV</a>
            <a class="btn btn-sm btn-primary" href="<?php echo base_url().'/Practice/exportexcel'; ?>">Export XL</a>
            <a class="btn btn-sm btn-primary" href="<?php echo base_url().'/Practice/mail'; ?>">Mail</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Mail Option
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <?php echo form_open('practice1/mail', 'class="email" id="myform"'); ?>

                        <div class="form-group">
                            <?php echo form_label('Email', 'email'); ?>                     
                            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Enter Email', 'name' => 'email']); ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array('name' => 'filetype', 'id' => 'csv', 'value' => 'csv', 'checked' => FALSE, 'style' => 'margin:10px');
                                echo form_radio($data);
                                echo form_label('CSV', 'csv');
                            ?>

                            <?php
                                $data = array('name' => 'filetype', 'id' => 'xlsx', 'value' => 'xlsx', 'checked' => FALSE, 'style' => 'margin:10px');
                                echo form_radio($data);
                                echo form_label('XLSX', 'xlsx');
                            ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div class="form-group">
                            <?php echo form_submit(['class' => 'btn btn-primary my-2', 'value' => "Submit"]); ?>
                        </div>
                        <!-- <button type="button" class="btn btn-primary">Send Mail</button> -->
                    </div>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
        </div>
    </div>
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="<?php echo base_url('members/import'); ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
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
                    <tr id="<?php echo $article->id ?>">
                        <td><?php echo $article->id ?></td>
                        <td><?php echo $article->article_title ?></td>
                        <td><a href="<?php echo base_url().'/Admin/edit/'.$article->id ?>" class="btn btn-secondary">Edit</a></td>
                        <!-- <td><a href="<?php echo base_url().'/Admin/delete/'.$article->id ?>" class="btn btn-danger">Delete</a></td> -->
                        <td><a class="btn btn-danger remove">Delete</a></td>
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

<script>
     $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
       swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
             url: '/Admin/delete/'+id,
             type: 'DELETE',
             error: function() {
                alert('Something is wrong');
             },
             success: function(data) {
                  $("#"+id).remove();
                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
             }
          });
        } else {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
     
    });
</script>

<script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
        }else{
            element.style.display = "none";
        }
    }
</script>



<?php include('footer.php'); ?>