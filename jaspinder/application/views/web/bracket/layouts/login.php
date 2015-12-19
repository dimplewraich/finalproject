<!DOCTYPE html>
<html lang="en">
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico" type="image/x-icon">	

<?php $this->load->view("web/{$default_theme}/partials/header_login");?>

<style>
.signinpanel {
    padding: 3px 83px 83px !important;
}
.signinpanel form{
  background:white;
  border:none;
}
.signup-footer{
 color:white;
}
</style>


<body class="signin" style="background:url(<?php echo base_url(); ?>/assets/images/login-bg.jpg);background-size:100%;">

<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-6 col-md-offset-3">
                
				<?php $this->load->view("web/{$default_theme}/pages/{$page}"); ?>
                
            </div>
            
        </div>
        
        <div class="signup-footer col-md-6 col-sm-offset-3">
            <div class="pull-left">
                &copy; 2015. All Rights Reserved.
            </div>
        </div>
        
    </div>
  
</section>
<?php $this->load->view("web/{$default_theme}/partials/footer_login"); ?>
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