<?php include('header.php') ?>



<div class="container">
    <h2>Admin Login</h2>
    
    <div class="container" id="sessionMSG">
        <?php $success = $this->session->userdata('success');
            if($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php $failure = $this->session->userdata('failure'); ?> 
        <?php if($failure): ?>
            <div class="alert alert-success"><?php echo $failure; ?></div>
        <?php endif; ?>
    </div>

    <?php echo form_open('admin/index'); ?>

        <div class="form-group">
            <label for="username" class="col-sm-2 col-form-label">Username</label>        
            <?php echo form_input(['class' => 'form-control', 'placeholder' => 'Username', 'name' => 'username', 'value' => set_value('username')]); ?>
            <!-- <input type="email" class="form-control" id="email" name="email" placeholder="Email">         -->
            <?php echo form_error('username') ?>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <?php echo form_password(['class' => 'form-control', 'placeholder' => 'Password', 'name' => 'password', 'value' => set_value('password')]); ?>
            <!-- <input type="password" class="form-control" id="password" name="password" placeholder="Password"> -->
            <?php echo form_error('password') ?>
        </div>

        <div class="form-group">
            <?php echo form_submit(['class' => 'btn btn-primary my-2', 'value' => "Login"]); ?>
            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            <?php echo form_reset(['class' => 'btn btn-secondary my-2', 'value' => "reset"]); ?>
            <?php echo anchor('index.php/admin/register', 'SignUp', 'class="btn btn-info"'); ?>
        </div>

</div>

<script> 
    setTimeout(function() {
        $('#sessionMSG').hide('fast');
    }, 5000);
</script>


<?php include('footer.php') ?>