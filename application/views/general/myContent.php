
<!-- <div>
<img src="<?php echo base_url(); ?>/images/pri4.gif" width="1100px" height="280px;"/> 
 <p style="text-align:center;padding-top:30px;font-size:32pt;font-weight:bolder;color:#006666">PRICOL FUEL & LUBE SERVICES </p>
<p  style="text-align:center;font-size:15pt;font-weight:bold;color:#006666">
PERIANAICKENPALAYAM
</p>
<p style="text-align:center;padding-top:30px;font-size:22pt;font-weight:bolder;">ABC FUEL & LUBE SERVICES </p>
<p  style="text-align:center;font-size:15pt;font-weight:bold;">
A DEMO SOFTWARE FOR CUSTOMER RELATIONSHIP MANAGEMENT
</p> 

</div>

<div id="login-form" style="height:200px;width:350px;border:3px solid black ;border-color:#006666;border-radius:20px;margin-top:30px;margin-left:280px;">
<p style="color:#000000;text-align:center;font-size:18pt;font-weight:bolder;">Login Form</p>
<?php echo form_open('logincheck/login'); ?>
		<table id="login_form" style="font-weight:bolder;font-size:12pt;">
        	<tr style="color:#003300"><td>Username:</td><td><input type="text" name="email" id="email" style="width:150px;color:#4c0000;padding:0 0 0 5px;"/></td></tr>
            <tr style="color:#003300"><td>Password:</td><td><input type="password" name="pwd" id="pwd" style='width:150px;color:#4c0000;'/></td></tr>
       		<tr style=""><td colspan="2" align="center"><?php if(isset($err)) { echo $err; } ?>
        	<input type="image" style="width:100px;height:40px" name="submit" id="submit" src="<?php echo base_url(); ?>/images/login_green2.png" />
        	</td></tr>
    </table>
	<?php echo "</form>"; ?>

</div>
 -->
 <script type="text/javascript">
    $(document).ready(function() {
        $('body').css('background-image', 'url(<?php echo base_url(); ?>/images/homepage3.jpg)');
        $('body').css('background-size', '100% 100%');
    });
</script>
 <div id="login-form" style="height:200px;width:300px;margin-top:25%;margin-left:60%;">
 <!-- <span style="color:#000000;text-align:center;font-size:18pt;font-weight:bolder;margin:0px;line-height:0;padding:5px 0;">Sign in</span><br>
 <span style="color:#000000;text-align:center;font-size:18pt;font-weight:bolder;line-height:0.5em;">.........................</span>
  -->
 <?php echo form_open('logincheck/login'); ?>
		<table id="login_form" style="font-weight:bolder;font-size:12pt;width:90%;height:100%;">
		<tr style="color:#003300"><td colspan='2' ><img	style="width:90%;line-height:1em;" name="submit" id="submit" src="<?php echo base_url(); ?>/images/signin2.jpg" /></td></tr>
        	<tr style="color:#003300;"><td>Username:</td><td><input type="text" name="email" id="email" style="width:150px;color:#4c0000;padding:0 0 0 5px;"/></td></tr>
            <tr style="color:#003300"><td>Password:</td><td><input type="password" name="pwd" id="pwd" style='width:150px;color:#4c0000;'/></td></tr>
       		<tr style=""><td colspan="2" align="right"><?php if(isset($err)) { echo $err; echo "<br/>";} ?>
        	<!-- <input type="image" style="width:100px;height:40px" name="submit" id="submit" src="<?php echo base_url(); ?>/images/login_green2.png" /> -->
        	<input name="submit" id="submit" type='submit' class='login_btn' value='SIGN IN' />
        	</td></tr>
    </table>
	<?php echo "</form>"; ?>
</div>