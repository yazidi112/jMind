$(function(){

 	/*
		set jMind directory
	*/
	
	var dir="../../";
	
	/*
		load logoff, password update icon
	*/
	
	jLogin(dir,2);
	
	
	/*
		load picture explorer
	*/
	
	jPhoto(dir);
	 
	/*
	 * Add a new post
	 */

	 
	$('#menu-post-new').on('click',function(){
		var data={table:'posts'};
   		var options={dir:dir,selector:'#content',action:'add', hiddenCols:[0],datepicker:[3] };
		jForm(data,options);
	});
	
	
	 
	
	
	
	
	/*
	 Show list of users
	*/
	
	
	$('#menu-post-list').on('click',function(){
		var data={table:'posts'};
		var action={delete:true,update:true,select:true,quickUpdate:true};
		var formOptions={dir:dir,selector:selector,action:'update', hiddenCols:[0], jPhotos:[3],datepicker:[5,6]};
		options={dir:dir,selector:'#content',action:action,formOptions:formOptions};
		jTable(data,options);
	});
	
	
	 
	 
	 
	/*
	 Show details of one user
	*/
	
	var data={table:'users',condition:{iduser:2}};
	options={dir:dir,selector:'#user-view'};
	jDetails(data,options);
	
	/*
		jtable with jview
	*/
	
	var selector="#jtbl";
	var data={table:'users'};
	var action={delete:true,update:true,select:true,quickupdate:true};
	var formOptions={dir:dir,selector:selector,action:'update', hiddenCols:[0], jPhotos:[3],datepicker:[5,6]};
	options={dir:dir,selector:selector,action:action,formOptions:formOptions };
	jTable(data,options,function(){
		$('#jtbl tr').on('click',function(){
			var id=jTableGetID('#jtbl');
 			var data={table:'users',condition:{iduser:id}};
			options={dir:dir,selector:'#jvw'};
			jDetails(data,options);
		});
	});
	
	
			
			
	/*
	 Chart
	*/
	
	
	
	
	$('#menu-dashboard').on('click',function(){
		var data={table:'statistic'};
		options={dir:dir,selector:'#content',title:'number of users by date'};
		jGraph(data,options);
	});
	
	$('#menu-dashboard').click();
	
});


