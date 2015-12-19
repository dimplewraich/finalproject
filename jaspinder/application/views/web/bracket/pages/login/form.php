<?php echo form_open("auth/login",array('id'=>'loginForm'));?>
	<!--<h4 class="nomargin">Sign In</h4>
	<p class="mt5 mb20">Login to access your account.</p>
	-->
	<div style='width: 74px; height: 50px; margin: 0px auto; padding-bottom: 66px;'>
	     <img src='<?php echo base_url(); ?>/assets/images/logo.png' >
	</div>
	<?php echo form_input('identity', $identity, 'id="identity" class="form-control uname" placeholder="Username"');?>
	<?php echo form_password('password', $password, 'id="password" class="form-control pword" placeholder="Password"');?>
	<!--<div class="clearfix mt5"><a href="<?php echo site_url('auth/forgot_password');?>"><small>Forgot Your Password?</small></a></div>
	-->
	<div class="clearfix mt5">
		<label class="inline">
			<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
			<span class="lbl" id="remember_me_span"> Remember Me</span>
		</label>
	</div>
	<button name="submit_btn" type="submit" id="submit_btn" class="btn btn-success btn-block">Sign In</button>
	
<?php echo form_close();?>