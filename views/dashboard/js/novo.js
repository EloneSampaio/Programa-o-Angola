$(document).ready(function(){
	
	// VIEW USERS on load of the page
	$('#loaderImage').show();
	showUsers();

        open();
	// clicking the 'VIEW USERS' button
	$('#viewUsers').click(function(){
		// show a loader img
		$('#loaderImage').show();
		
		showUsers();
	});
	
	// clicking the '+ NEW USER' button
	$('#addUser').click(function(){
		showCreateUserForm();
	});





	// clicking the EDIT button
	$(document).on('click', '#altera', function(){ 
	
		var id = $(this).attr('rel');
		console.log(id);
		
		// show a loader image
		$('#loaderImage').show();

		// read and show the records after 1 second
		// we use setTimeout just to show the image loading effect when you have a very fast server
		// otherwise, you can just do: $('#pageContent').load('update_form.php?user_id=" + user_id + "', function(){ $('#loaderImage').hide(); });
		setTimeout("$('#pageContent').load('http://www.teste.dev/categoria/form_editar?id_categoria=" + id + "', function(){ $('#loaderImage').hide(); });",1000);
		
	});	
	
	
	// when clicking the DELETE button
    $(document).on('click', '#delete', function(){ 
        if(confirm('Pretendes Apagar este Item?')){
		
            // get the id
			var id = $(this).attr('rel');
                       
			
			// trigger the delete file
			$.post("http://www.teste.dev/categoria/apagar_categoria", {'id_categoria':id })
				.done(function(data) {
					// you can see your console to verify if record was deleted
					console.log(data);
					
					$('#loaderImage').show();
					
					// reload the list
					showUsers();
					
				});

        }
    });
	
	
    // CREATE FORM IS SUBMITTED
     $(document).on('submit', '#addUserForm', function() {

                var  url=$(this).attr('action');  
                var  data = $(this).serialize();
		// show a loader img
		$('#loaderImage').show();
		
		// post the data from the form
		$.post(url, data)
			.done(function(data) {
				// 'data' is the text returned, you can do any conditions based on that
				showUsers();
			});
	 			
        return false;
    });
	
    // UPDATE FORM IS SUBMITTED
     $(document).on('submit', '#updateUserForm', function() {

		// show a loader img
		$('#loaderImage').show();
		
		// post the data from the form
		$.post("update.php", $(this).serialize())
			.done(function(data) {
				// 'data' is the text returned, you can do any conditions based on that
				showUsers();
			});
	 			
        return false;
    });
	
});

// READ USERS
function showUsers(){
	// read and show the records after at least a second
	// we use setTimeout just to show the image loading effect when you have a very fast server
	// otherwise, you can just do: $('#pageContent').load('read.php', function(){ $('#loaderImage').hide(); });
	// THIS also hides the loader image
	setTimeout("$('#pageContent').load('http://aulas.dev/views/dashboard/st.phtml', function(){ $('#loaderImage').hide(); });", 1000);
}

// CREATE USER FORM
function showCreateUserForm(){
	// show a loader image
	$('#loaderImage').show();
	
	// read and show the records after 1 second
	// we use setTimeout just to show the image loading effect when you have a very fast server
	// otherwise, you can just do: $('#pageContent').load('read.php');
	setTimeout("$('#pageContent').load('http://www.teste.dev/categoria/form', function(){ $('#loaderImage').hide(); });",1000);
}


function open(){
    
    	
	$(document).on('click', '#clic', function(){ 
            var id = $(this).attr('rel');
        console.log(id);
	
		var link="http://aulas.dev/"+id;
		
		// show a loader image
		$('#loaderImage').show();

		// read and show the records after 1 second
		// we use setTimeout just to show the image loading effect when you have a very fast server
		// otherwise, you can just do: $('#pageContent').load('update_form.php?user_id=" + user_id + "', function(){ $('#loaderImage').hide(); });
		setTimeout("$('#pageContent').load('"+link+"', function(){ $('#loaderImage').hide(); });",1000);
		
	});
    
}