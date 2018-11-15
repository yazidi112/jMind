<?php
	session_start();
?>
<!DOCTYPE>
<html>
<head>
	<title>   Jmind 1.0.0 | Examples dashboeard</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="public/css/main.css"/>
	<link rel=stylesheet href="public/css/lib/jquery-ui.css"/>
   <style>
   		body{
   			 background: linear-gradient(180deg,#ddd,#fff);
   			 direction:rtl;
   		}
   </style>

 
</head>
<body>
	<nav>
		<h2>jMind 1.0.0</h2>
		<i>Web App Example</i>
		<ul>
			<li><a href="#" id="menu-dashboard">Dashboard</a></li>
			<li><a href="#">Posts</a>
				<ul>
					<li><a href="#" id="menu-post-new">New post</a></li>
					<li><a href="#" id="menu-post-list">List posts</a></li>
				</ul>
			</li>
			<li><a href="#">Users</a>
				<ul>
					<li><a href="#" id="menu-user-new">New user</a></li>
					<li><a href="#" id="menu-user-list">List users</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<header>
	
	</header>
	<section class="bloc">
		This app is just example of using jmind framework. It use the majority of jmind elements
	</section>
	<section>
		<div id="content" class="bloc"></div>
	</section>
	<footer>
	
	</footer>
	<script src="public/js/lib/jquery-1.10.2.js"></script>
	<script src="public/js/lib/jquery-ui.js"></script>
	<script src="public/js/lib/underscore.js"></script>
 	<script src="../../js/lang/FR.js"></script>
	<script src="../../js/_jLogin.js"></script>
	<script src="../../js/_jDetails.js"></script>
	<script src="../../js/_jForm.js"></script>
	<script src="../../js/_jGraph.js"></script>
	<script src="../../js/_jvk.js"></script>
	<script src="../../js/_jPhoto.js"></script>
 	<script src="../../js/_jTable.js"></script>
 	<script src="../../js/_jView.js"></script>
	<script src="public/js/main.js"></script>
	 
</body>
</html>



