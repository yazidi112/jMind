	<?php
		session_start();
		require_once("../lang/lang.php");
	?>
	<div id="login"  style="text-align:left;font-family:calibri;background:#eee;border:1px solid gray;border-radius:4px;width:320px;height:300px;position:fixed;top:0;bottom:0;right:0;left:0;margin:auto">

			<div style="padding:10px;background:linear-gradient(180deg,#444,#CCC);color:white">
				<i class="fa fa-sign-in"></i> <strong id="window_title"><?php echo $j_login ?></strong>
			</div>

			

			<div  style="margin:auto;;padding:10px;" >
				<div id="login_msg" style="font-size:12px"></div>
				<form id="formLogin">

					<spna><?php echo $j_pseudo ?></spna>
					<input type="text" id="user" placeholder=" " style="text-align:left;display:block;margin-bottom:5px;padding:10px;width:100%" required/>
					


					<spna><?php echo $j_pwd ?></spna>
					<input type="password" id="pwd" placeholder=" " style="text-align:left;display:block;margin-bottom:5px;padding:10px;width:100%"  required/>
					
					<?php
						if(isset($_SESSION['cnx']['c']) && $_SESSION['cnx']['c']>=4):
					?>
					<img id="captcha-img" src="lib/jMind/includes/jLogin/captcha.php" />
					<input type="text" id="captcha" placeholder="Captcha " style="text-align:left;margin-bottom:5px;padding:10px;width: 147px;"  required/>
					<?php
						endif;
					?>

					<input type="submit" value="<?php echo $j_login ?>"  style="padding:10px;width:100%" onclick="return false" id="btnlogin" />


				</form>

				

					<img src=public/images/progress-bar.gif id="login_load" style="display:none;width:200px"/>

				

				<br/> 

			</div>

 		</div>