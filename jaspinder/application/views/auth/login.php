<!DOCTYPE html>
<html lang="en">
	
	<?php $this->load->view("web/partials/header_login");?>

<body class="signin">

<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-5 col-md-offset-3">
                
                <?php echo form_open("auth/login",array('id'=>'loginForm'));?>
                    <h4 class="nomargin">Sign In</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
					<?php $identity['class'] = "form-control uname";$identity['placeholder'] = "Username";?>
					<?php $password['class'] = "form-control pword";$password['placeholder'] = "Password";?>
                    <?php echo form_input($identity);?>
                    <?php echo form_password($password);?>
                    <div class="clearfix mt5"><a href="<?php echo site_url('auth/forgot_password');?>"><small>Forgot Your Password?</small></a></div>
					<div class="clearfix mt5">
						<label class="inline">
							<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
							<span class="lbl" id="remember_me_span"> Remember Me</span>
						</label>
					</div>
                    <button name="submit_btn" type="submit" id="submit_btn" class="btn btn-success btn-block">Sign In</button>
                    
                <?php echo form_close();?>
            </div>
            
        </div>
        
        <div class="signup-footer col-md-5 col-sm-offset-3">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved.
            </div>
        </div>
        
    </div>
  
</section>
<?php $this->load->view("web/partials/footer_login"); ?>
<script type="text/javascript">

	$(document).ready(function() {
		
		$("#loginForm").validate({
			rules: {
				identity: {
					required: true,
					minlength: 4
				},
				password: {
					required: true,
					minlength: 8
				}  
			},
			messages: {
				identity: {
					required: "This is required",
					minlength: "I'd imagine your username is longer than that"
				},
				password: {
					required: "Please provide a password",
					minlength: "Password should be more than 8 characters"
				}
			}   
		});
	});
</script>
</body>
</html>