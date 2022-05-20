<?php include('header.php') ?>



<div class="container">
    <h2>Admin Registration Form</h2>

    <?php echo form_open('admin/register'); ?>

        <div class="form-group">
            <label for="username" class="col-sm-2 col-form-label">Username</label>        
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Username', 'name' => 'username', 'value' => set_value('username')]); ?>
            <?php echo form_error('username') ?>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 col-form-label">Email</label>        
            <?php echo form_input(['class' => 'form-control', 'type' => 'email', 'placeholder' => 'email', 'name' => 'email', 'value' => set_value('email')]); ?>
            <?php echo form_error('email') ?>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <?php echo form_password(['class' => 'form-control', 'placeholder' => 'Password', 'name' => 'password', 'value' => set_value('password')]); ?>
            <?php echo form_error('password') ?>
        </div>

        <div class="form-group">
            <label for="firstname" class="col-sm-2 col-form-label">FirstName</label>
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'First Name', 'name' => 'firstname', 'value' => set_value('firstname')]); ?>
            <?php echo form_error('firstname') ?>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Last Name', 'name' => 'lastname', 'value' => set_value('lastname')]); ?>
            <?php echo form_error('lastname') ?>
        </div>

        <div class="form-group">
            <?php echo form_submit(['class' => 'btn btn-primary my-2', 'value' => "Register"]); ?>
            <?php echo form_reset(['class' => 'btn btn-secondary my-2', 'value' => "reset"]); ?>
            <?php echo anchor('admin/index', 'Already have an account?', 'class="btn btn-info"'); ?>
        </div>

</div>




<?php include('footer.php') ?>