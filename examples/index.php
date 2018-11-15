<!DOCTYPE html>
<html>
	<head>
		<title>   Jmind 1.0.0 | Examples</title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="public/css/main.css"/>
		<link rel=stylesheet href="public/css/lib/jquery-ui.css"/>
	</head>
	<body>

		<h1>Jmind version 1.0.0 </h1>
		<h2>Create your web application fast and easily</h2>
		<ul>
			<li>Developper: Imran YAZIDI</li>
			<li>Creation date: 10.10.2016</li>
			<li>Last update: 07.09.2018</li>
		</ul>
		<nav>
			<h2>jMind 1.0.0</h2>
			<i>Fast & easy programming</i>
			<ul>
				<li><a href="#">jMind</a></li>
				<li><a href="#jform">jForm</a></li>
				<li><a href="#jtable">jTable</a></li>
				<li><a href="#jview">jView</a></li>
				<li><a href="#jgraph">jGraph</a></li>
				<li><a href="#jvk">jvk</a></li>
				<li><a href="#jlogin">jLogin</a></li>
			</ul>
		
		</nav>
		<h2>What's Jmind?</h2>
		<p>
		jMind is a Javascript/PHP framework, created by Imran YAZIDI in 2016 in order to making fast and easy, the creation
		of web application.
		jMind is created with javascript and php languages and it also use jquery and undersoce library..<br/>
		jMind is composed by the following modules:
		<ul>
 				<li>jForm: Generate form to add or update data</li>
				<li>jTable: Show data in table wtih delete,select and update actions</li>
				<li>jView: Show details of one element on two columns</li>
				<li>jGraph: Show data in chart</li>
				<li>jvk: Visual keyboard</li>
				<li>jLogin: Authentication tool</li>
			</ul>
		</p>
		<h2>How it works</h2>
		<p>
		To setup jMind in your web application you have to extract the zip file of framework in your application directory
		and configure the config file exist in the root of jmind framework.
		Open jMind directory and go to examples folder, you will found there one file named examples.sql copy the code inside ,
		create databe in mysql server and paste teh code of examples.sql to test working.
		</p>
		<h2>Structure</h2>
		<img src="public/images/structure.png" style="width:700px;height:450px;border: 1px solid gray;"/>
		<h2>Examples</h2>
		<h3 id="jform">jForm:Users sample form</h3>
		<p>
		In this example we use a smallest code to show a user form to add a new user.
		</p>
		<h4>Code:</h4>
		<pre>
			var dir="../lib/jMind"; 
		
			var data={table:'users'}; 
 			var options={dir:dir,selector:'#user-add',action:'add'}; 
			jForm(data,options); 
		</pre>
		
		<h4>Result:</h4>
		<div id="user-add" class="result"></div>
		
		
		
		
		
		<h3>Users advanced form</h3>
		<p>
		 in this example we show a user form wtih following settings:
		 <ul>
			<li>Hiding a first field because it is auto increment in database</li>
			<li>Showing a list of countries in select box and getting data from database</li>
			<li>Calling a picture explorer to uplod and chooses pictures</li>
			<li>Using a jquery datepicker</li>
			<li>Changing a fileds title</li>
		 </ul>
		
		</p>
		<h4>Code:</h4>
		<pre>
			var data={table:'users'};
			var listBox=[{item:4,table:{name:'countries',key:0,cols:[1]}}];
			var labels=['','nom','Téléphone','Photo','Pays','Date de naissance'];
			var options={dir:dir,selector:'#user-advanced-add',action:'add',listBox:listBox,hiddenCols:[0],datepicker:[5,6],jPhotos:[3],labels:labels};
			jForm(data,options);
		</pre>
		
		<h4>Result:</h4>
		<div id="user-advanced-add" class="result"></div>
		
		
		
		
		
		
		<h3 id="jtable">jTAble: Users sample list</h3>
		<h4>Code:</h4>
		<pre>
			var dir="../lib/jMind";
		
			var data={table:'users'};
  			options={dir:dir,selector:'#users-list',action:false};
			jTable(data,options);
		</pre>
		
		<h4>Result:</h4>
		<div id="users-list" class="result"></div>
		
		
		
		<h3>Users advanced list</h3>
		<p>
		In this exmaple we show a list of users with delete,update,quick update and select actions.
		<br/>
		QuickUpdate option allow users to update data after double-click on the text. We can also do calculate if we begin
		text updated with = symbol. for example =4+5 give 9.
		</p>
		<h4>Code:</h4>
		<pre>
			var selector="#users-advanced-list";
			var data={table:'users'};
			var action={delete:true,update:true,select:true,quickupdate:true};
			var formOptions={dir:dir,selector:selector,action:'update',labels:labels,hiddenCols:[0],listBox:listBox,jPhotos:[3],datepicker:[5,6]};
			options={dir:dir,selector:selector,action:action,formOptions:formOptions,labels:labels};
			jTable(data,options);
		</pre>
		
		<h4>Result:</h4>
		<div id="users-advanced-list" class="result"></div>
		
		
		
		
		
		
		
		
		<h3 id="jview">jView: User view</h3>
		<p>
		In this exmaple we show infomrations of one user
		</p>
		<h4>Code:</h4>
		<pre>
			var data={table:'users',condition:{iduser:2}};
			options={dir:dir,selector:'#user-view'};
			jDetails(data,options);
		</pre>
		
		<h4>Result:</h4>
		<div id="user-view" class="result"></div>
		
		
		
		
		<h3>jView with jTable</h3>
		<p>
		In this exmaple we select one element from jTable data and show details in jDetails list
		</p>
		<h4>Code:</h4>
		<pre>
			var selector="#jtbl";
			var data={table:'users'};
			var action={delete:false,update:false,select:true};
 			options={dir:dir,selector:selector,action:action};
			jTable(data,options,function(){
				$('#jtbl tr').on('click',function(){
					var id=jTableGetID('#jtbl');
					var data={table:'users',condition:{iduser:id}};
					options={dir:dir,selector:'#jvw'};
					jDetails(data,options);
				});
			});
	
		</pre>
		
		<h4>Result:</h4>
		<div class="result">
		
			<div style="display:table">
				<div style="display:table-cell">
					<div id="jtbl"></div>
				</div>
				<div style="display:table-cell">
					<div id="jvw"></div>
				</div>
			</div>
		
		</div>
		
		
		
		
		<h3 id="jvk">jvk: Visual keyborad</h3>
		<p>
		In this exmaple we show visual keyboard when we focus input with jvk class
		</p>
		<h4>Code:</h4>
		<pre>
			jvk(dir); 
		</pre>
		
		<h4>Result:</h4>
		<div id="user-view" class="result">
			<input type="text" class="jvk"/>
		</div>
		
		
		
		<h3 id="jgraph">jGraph: Chart view</h3>
		<p>
		In this exmaple we present data in chart view. we have to work with view in database not table
		in this case we present number of users by date.
		we use the next sql<br/>
		
		</p>
		<h4>Code SQL:</h4>
		<pre>
			CREATE VIEW `statistic` AS 
			select `users`.`registerdate` AS `registerdate`,count(0) AS `users`
			from `users` group by `users`.`birthdate`
		</pre>
		
		<h4>Code JS:</h4>
		<pre>
			var data={table:'statistic'};
			options={dir:dir,selector:'#chart',title:'number of users by date'};
			jGraph(data,options);
		</pre>
		
		<h4>Result:</h4>
		<div id="chart" class="result"></div>
		
		
		
		
		
		
		<h3 id="jlogin">jLogin: authentication tool</h3>
		<p>
		In this exmaple we use jLogin tool to manage login operation? Here we use two code on for login page
		and one for secure page.
		</p>
		<h4>Code login page:</h4>
		<pre>
 			$(function(){
				jLogin(dir);
			});
		</pre>
		
		
		<h4>Code secure page:</h4>
		<pre>
 			$(function(){
				jLogin(dir,2);
			});
		</pre>
		
		
		<h4>Result:</h4>
		<div id="user-view" class="result">
			<a href="app/login.php" target="_blank">Click here to access to small application</a>
		</div>
		
		
		
		
	
	<footer>
		JMind 1.0.0 - 2018 for more informations about this framework contact us at : yazidi.imran@gmail.com
	</footer>
	
	<script src="public/js/lib/jquery-1.10.2.js"></script>
	<script src="public/js/lib/jquery-ui.js"></script>
	<script src="public/js/lib/underscore.js"></script>

	<script src="../js/lang/FR.js"></script>
	<script src="../js/_jMind.js"></script>
	<script src="../js/_jDetails.js"></script>
	<script src="../js/_jForm.js"></script>
	<script src="../js/_jGraph.js"></script>
	<script src="../js/_jvk.js"></script>
	<script src="../js/_jPhoto.js"></script>
 	<script src="../js/_jTable.js"></script>
 	<script src="../js/_jView.js"></script>
	 
	<script src="public/js/main.js"></script>
	</body>
</html>