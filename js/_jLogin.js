function jLogin(dir,page){
	
	if(page==1 || page===undefined){
		$.post(dir+"/includes/loginForm.php",{
			root : dir
				
		},function(data){
		 
			
			$("body").append(data);
			/*
			 * login
			 */
			$('#formLogin').on('submit',function(){
				$('#login_msg').html(j_connecting).css('color','orange');
				$.post(dir+"/do/jLogin_do.php",{
					action: 'login',
					user: 		$('#user').val(),
					pwd: 		$('#pwd').val(),
					captcha: 	$('#captcha').val()
				},function(data){
					$('#login_msg').html(data.msg).css('color',data.result);
					self.location.href=data.url;

				},'json');

				return false;
			});
			
			$('#btnlogin').on('click',function(){
				$('#formLogin').submit();
			});
			 
			
			
		});
	
	}else if(page==2){
		$.post(dir+"/includes/logoffPwdUpdate.php",{
			root : dir
		},function(data){
				$("body").append(data);
		});
	}
}


function logoff(dir){
	 
		if(!confirm(j_logoffConfirm))
			return;
			
		 
		$.post(dir+"/do/jLogin_do.php",{
			action: 'logout' 
		},function(data){
 			if(data.error==1)
				self.location.href='login.php';
		},'json');
	 
}

function update_password(dir){

	var oldpwd=$('#pwdchange .oldpwd').val();
	var newpwd=$('#pwdchange .newpwd').val();
	var confpwd=$('#pwdchange .confpwd').val();
	
	if(oldpwd=="" || newpwd=="" || confpwd==""){
		$('#pwdchange .msgbox').addClass('error').fadeIn().html("Please fill al fileds !").delay(2000).fadeOut(1000);

 	}else if(newpwd!=confpwd){
		$('#pwdchange .msgbox').addClass('error').fadeIn().html("Password error !").delay(2000).fadeOut(1000);

 	}else{
		
		$.post(dir+"/do/jLogin_do.php",{
			action: 'changepwd',
 			oldpwd: oldpwd,
			newpwd: newpwd
		},function(data){
 			$('#pwdchange .msgbox').addClass('success').fadeIn().html(data.msg).delay(2000).fadeOut(1000);
		},"json");
		
	}
}





