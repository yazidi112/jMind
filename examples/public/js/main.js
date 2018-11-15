$(function(){

	var dir="../";
	
	
	/*
		load picture explorer
	*/
	
	jPhoto(dir);
	
	 
	/*
	 * Add a new user
	 */

	
	
	var data={table:'users'};
	var options={dir:dir,selector:'#user-add',action:'add'};
	jForm(data,options);
	
	
	/*
	 * Addvanced add a new user
	 */

	var data={table:'users'};
	var listBox=[{item:4,table:{name:'countries',key:0,cols:[1]}}];
	var labels=['','nom','Téléphone','Photo','Pays','Date de naissance'];
	var options={dir:dir,selector:'#user-advanced-add',action:'add',listBox:listBox,hiddenCols:[0],datepicker:[5,6],jPhotos:[3],labels:labels};
	jForm(data,options);
	
	
	/*
	 Show list of users
	*/
	
	var data={table:'users'};
	options={dir:dir,selector:'#users-list',action:false};
	jTable(data,options);
	
	/*
	 Advanced list of users
	*/
	
	var selector="#users-advanced-list";
	var data={table:'users'};
	var action={delete:true,update:true,select:true,quickUpdate:true};
	var formOptions={dir:dir,selector:selector,action:'update',labels:labels,hiddenCols:[0],listBox:listBox,jPhotos:[3],datepicker:[5,6]};
	options={dir:dir,selector:selector,action:action,formOptions:formOptions,labels:labels};
	jTable(data,options);
	 
	 
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
	var formOptions={dir:dir,selector:selector,action:'update',labels:labels,hiddenCols:[0],listBox:listBox,jPhotos:[3],datepicker:[5,6]};
	options={dir:dir,selector:selector,action:action,formOptions:formOptions,labels:labels};
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
	
	var data={table:'statistic'};
	options={dir:dir,selector:'#chart',title:'number of users by date'};
	jGraph(data,options);
	
	
	/*
	 Visual keyboard
	*/
	
	jvk(dir);
	
	
});


