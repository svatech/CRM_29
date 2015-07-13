<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<?php $this->load->view("template/includes/scripts"); ?>
<?php $this->load->view("template/includes/styles"); ?>
<title><?php echo $titleText?></title>
<link rel="shortcut icon" href="../../images/project-icon.ico">
</head>
<body >
  <?php if($this->session->userdata('admin_logged_in')){?>
  <div id="sidebar" >
    <div id="sidebar-wrapper">
      <div id="profile-links"><center>
       <img src="<?php echo base_url(); ?>/images/peri_1.gif" width="95%" height="50px;"/> 
      <!-- <p style="font-size:18pt;height:10px;">PRICOL </p><p style="font-size:10pt;height:8px;">FUEL & LUBE SERVICES</p><p style="font-size:10pt">PERIANAICKENPALAYAM</p> -->
          </center>
          <!--"><center>
          <p style="font-size:18pt;height:10px;">ABC </p><p style="font-size:10pt;height:8px;">FUEL & LUBE SERVICES</p><p style="font-size:10pt">CHENNAI</p>
          </center> 
           -->
      </div>
     
     <!-- <ul id="display"  style="width:auto;background:none;margin-bottom:30px;margin-top:0px;">
 	 		 <div class="clock " style="width:150px; margin:0 auto; padding:10px; border:0px solid #333; color:Black;font-weight:bold;font-size:12pt;" >
 	 <li id="Date" style="margin-left:50px;display:block; width:100px;font-size:1.7em;color:#FFFFFF; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
		<li id="hours" style="margin-left:20px;display:inline-block;  float:left; font-size:1.7em;color:#FFFFFF; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
		<li id="point" style="float:left;display:inline-block; font-size:1.7em; color:#FFFFFF; -moz-animation:mymove 2s ease infinite;  -webkit-animation:mymove 1s ease infinite;  padding-right:5px; padding-left:5px;">:</li>
		<li id="min" style="display:inline-block;  float:left; color:#FFFFFF;font-size:1.7em; text-align:center; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
		<li id="point" style="float:left; display:inline-block;font-size:1.7em; color:#FFFFFF;  -moz-animation:mymove 2s ease infinite;  -webkit-animation:mymove 1s ease infinite;  padding-right:5px;padding-left:5px;">:</li>
		<li id="sec" style="display:inline-block;  float:left; color:#FFFFFF;font-size:1.7em; text-align:center; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
	</ul>
	 -->
	 <center>
	  <ul id="display"  style="width:auto;background:none;margin-bottom:40px;margin-top:10px;">
 	 <!--  <div class="clock " style="width:150px; margin:0 auto; padding:10px; border:0px solid #333; color:Black;font-weight:bold;font-size:12pt;" >  -->
 	 <li id="Date" style="display:block; width:160px;font-size:1.4em;color:#FFFFFF; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
		<li id="hours" style="margin-left:20px;display:inline-block;  float:left; font-size:1.5em;color:#FFFFFF; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
		<li id="point" style="float:left;display:inline-block; font-size:1.5em; color:#FFFFFF; -moz-animation:mymove 2s ease infinite;  -webkit-animation:mymove 1s ease infinite;  padding-right:5px; padding-left:5px;">:</li>
		<li id="min" style="display:inline-block;  float:left; color:#FFFFFF;font-size:1.5em; text-align:center; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif;"></li>
		<li id="point" style="float:left; display:inline-block;font-size:1.5em; color:#FFFFFF;  -moz-animation:mymove 2s ease infinite;  -webkit-animation:mymove 1s ease infinite;  padding-right:5px;padding-left:5px;">:</li>
		<li id="sec" style="display:inline-block;  float:left; color:#FFFFFF;font-size:1.5em; text-align:center; font-family:'BebasNeueRegular', Arial, Helvetica, sans-serif; "></li>
	</ul>
	</center>
      <ul id="main-nav"><?php echo $sideLinks?></ul>     
    </div>
     
  </div>
  <?php }?>
  <div id="main-content"  >
   <?php if($this->session->userdata('admin_logged_in')){?>
		 <div id='title_row' style="height:auto;overflow:hidden;background:#006666;width:100%;min-width:800px;min-height:60px;border:0px solid black ;border-radius:10px;">
			<div style='width:58%;float:left;font-size:20pt;color:white;padding-left:20px;height:60px;line-height:60px;font-family:"League Gothic"'><?php echo $titleText?></div>
			<div style='width:38%;float:right;text-align:right;padding-right:5px;height:60px;line-height:60px;'>
				<span class='login_name' style='margin:0px;'>Hi, <?php echo $this->session->userdata('fullname');?></span>
				<span class='logout_box' style='margin:0px;'>
				 <a href="<?php echo site_url("logincheck/logout"); ?>" style="margin-top:2px;" ><img src="<?php echo base_url(); ?>/images/logout_e2.png" width="20px" height="18px;"/></a>
				 </span>
			</div>
		 </div>
		 <?php }?> 
  	<?php echo $bodyContent?>  		
  </div> 
</body>
</html>