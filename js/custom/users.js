function user_form(){
	var u_name=document.getElementById("u_name").value;
	var username=document.getElementById("username").value;
	var passwd=document.getElementById("passwd").value;
	var cpasswd=document.getElementById("cpasswd").value;
	var ph_num=document.getElementById("ph_num").value;
	var userrole=document.getElementById("userrole").value;
	if(u_name=="")
		{
		alert("Please Enter Name of User");
		}else if(username.trim()==""){
		alert("Please Enter Username");
		}
		else if(passwd.trim()=="")
	   {
		   alert("Please Enter Password");
		}
	   else if(cpasswd.trim()=="")
	   {
		   alert("Please Enter Confirm Password");
		}
	   else if(isNaN(ph_num.trim())&&(ph_num.trim()!=''))
	   {
		   alert("Please Check Phone Number");
		}
	   else if(passwd.trim()!=cpasswd.trim())
	   {
		   alert("Passwords do not match");
		}
	    else
		{
		document.forms['userform'].submit();
		
		}
}
function check_username(){
	var username=document.getElementById("username").value;
	$.get(site_url + "/users/check_username/"+username,function(data) {

		if(data=='E'|| username==''){
			document.getElementById('correct').style.display='none';
			document.getElementById('incorrect').style.display='';
			document.getElementById("button").style.display='none';
		}
		else{
			document.getElementById('incorrect').style.display='none';
			document.getElementById('correct').style.display='';	
			document.getElementById("button").style.display='';
		}

	});
}

function check_passwd(){
	var passwd=document.getElementById("passwd").value;
	var cpasswd=document.getElementById("cpasswd").value;
	
	if(passwd==cpasswd){
		document.getElementById("passwd_match").innerHTML="Passwords Match";
	}
	else{
		document.getElementById("passwd_match").innerHTML="Passwords do not Match";
		}
}

function updateuser(user_id)
{
	
	updatepop=window.open("","","menubar=no, location=no, status=no, titlebar=yes, width=600, height=520,toolbar=no,addressbar=yes");
	var generatedContent="<html><head><title>Update Customer Info</title><link rel='stylesheet' media='screen,projection' type='text/css' href='../../css/mystyle.css' /></head>"+
	 "<body background='' bgcolor=''><div style='height:auto; background:#cccccc;margin:20px 0px 0px 40px;width:80%;border:0px solid black ;border-radius:0px;'><p style='height:10px;padding:0px 0px 0px 20px;' align='center'><span style='font-weight:bolder;font-size:13pt;'>User Information </span></p>"+
"<hr width='100%'>"+
"<div id='myuser' style='margin:20px 20px 20px 40px;'><p>Please wait while Loading....</p></div><div style='margin-left:100px;margin-bottom:30px'><input style='margin-right:25px;' class='button' type=\"button\" id='update' value='Update' onclick='opener.updateuserFinish()'/><input class='button' type=\"button\" id='close' value='Close' onclick='javascript:self.close()'/></div></body</html>";
	 updatepop.document.write(generatedContent);   
	 $.get(site_url + "/users/fetch_user_info/"+user_id,function(data){	
		 updatepop.document.getElementById('myuser').innerHTML=data;
		}); 
}

function updateuserFinish(){
	var u_name=updatepop.document.getElementById("u_name").value;		
	var username=updatepop.document.getElementById("username").value;
	var passwd=updatepop.document.getElementById("passwd").value;
	var cpasswd=updatepop.document.getElementById("cpasswd").value;
	var ph_num=updatepop.document.getElementById("ph_num").value;
	var userrole=updatepop.document.getElementById("userrole").value;
	if(passwd!=cpasswd){
		alert("Passwords do not match");
		return false;
	}
	
	var collect={};
	collect["u_name"]=u_name;
	collect["username"]=username;
	collect["passwd"]=passwd;
	collect["ph_num"]=ph_num;
	collect["userrole"]=userrole;
	
	   $.post(site_url+"/logincheck/updateuser",collect,function(data){
		 
		   updatepop.document.getElementById('myuser').innerHTML=data;
		   updatepop.document.getElementById('update').style.display="none";
		   updatepop.document.getElementById('close').style.marginLeft="80px";
		   window.location.reload();	
	    });
	}

String.prototype.trim = function()
{return ((this.replace(/^[\s\xA0]+/, "")).replace(/[\s\xA0]+$/, ""));};

String.prototype.startsWith = function(str)
{return (this.match(str)==str);};

String.prototype.endsWith = function(str)
{return (this.match(str+"$")==str);};

function searchbyname()
{
	var user=document.getElementById('user').value;
	filterTableByname(user);
}
function filterTableByname(str){
	
	str.trim();
	 var rowid, colid, rowc,vbid;
	  rcount=document.getElementById("hrowcount");
	  rowc=rcount.value;
	  
	  for(var i=1;i<=rowc;i++){
	    rowid="row"+i;
	    colid="name"+i;
	    var lstr=(str.toString()).toLowerCase();
	    displayRowStartsWith(rowid,colid,lstr);
	  }
	}
function displayRowStartsWith(rowid,colid,str){
	var row = document.getElementById(rowid);
      var searchcol= document.getElementById(colid);
     var colstr=searchcol.value;
     var lcolstr=(colstr.toString()).toLowerCase();
      if (lcolstr.startsWith(str))
    	  row.style.display = '';
      else
          row.style.display = 'none';
}