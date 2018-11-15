<?php 
 session_start();
 require_once("../lang/lang.php");
?>
<div id="logoff-bar" style="position:fixed;top:3px;right:0;margin:auto;z-index:1000;text-align:right;padding-right:6px" >
   
  			<div style="color:white;font-size:14px"> 
	  		Hello <?php echo $_SESSION['auth']['user']?>
			| <a href="#"    onclick="$('#pwdchange').fadeIn()">
	  			Update password
	  		</a>
			| <a href=# onclick="logoff('<?php echo $_POST['root']?>')" >Logoff</a>
	  		</div>
  		 
  
</div>

<div id="pwdchange" style="text-align: left;display:none;position:fixed;top:0;right:0;bottom:0;left:0;width:400px;height:350px;background:#eee; border:1px solid gray;margin:auto;z-index:1000;">
		<div style="padding:5px;color:white;background:#000">
			<i class="fa fa-lock" aria-hidden="true"></i> <?php echo $j_pwdchange ?>
		</div>
		<div style="padding:10px">
			<div class="msgbox"></div>
			<form id="pwdchange">
	 		 	<?php echo $j_oldpwd ?><br/>
			 	<input type="password" class="oldpwd" /><br/>
			 	<?php echo $j_newpwd ?><br/>
			 	<input type="password" class="newpwd" /><br/>
			 	<?php echo $j_confirmpwd ?><br/>
			 	<input type="password" class="confpwd" /><br/><br/>
			 	<input type="button" value="<?php echo $j_close ?>" onclick="$('#pwdchange').hide()" />
				<input type="button" value="<?php echo $j_change ?>" id="btnchangepwd" onclick="update_password('<?php echo $_POST['root']?>')" />
			 </form>
		</div>
</div>


