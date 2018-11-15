<div id="infos_system" class=divaucentre style="display:none;border-radius:5px;width:800;height:600px">
	<div style=background:linear-gradient(180deg,#999,#000);;padding:5px;color:white>
		 Informations system
		<img src=<?php echo $_POST['root']?>/system/images/x.png onclick="$('#infos_system').fadeOut()" style=position:absolute;right:5px;top:5px;width:15px;cursor:pointer />
	</div>
	<div style="padding:10px">
		  Systeme:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('a')); ?>" class="value" /><br/>
		  Systeme d'exploitaion:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('s')); ?>" class="value" /><br/>
		  Adresse IP:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('n')); ?>" class="value" /><br/>
		  Release name:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('r')); ?>" class="value" /><br/>
		  Version information:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('v')); ?>" class="value" /><br/>
		  Machine type:<br/>
		 <input type="text" value="<?php echo gethostbyname(php_uname('m')); ?>" class="value" /><br/>
		 Date:<br/>
		 <input type="text" value="<?php echo date("d/m/Y") ?>" class="value" /><br/>
		 Heure:<br/>
		 <input type="text" value="<?php echo date("H:i:s") ?>" class="value" /><br/>
	</div>
</div>