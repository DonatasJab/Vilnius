$('document').ready(function() {
	$('#select_all').on('click', function(e) {
		if($(this).is(':checked',true)) {
			$(".checkbox").prop('checked', true);  
		} else {  
			$(".checkbox").prop('checked', false);  
		}		
	});

	$('#delete').on('click', function(e) { 
		var people = [];  
		$(".checkbox:checked").each(function() {  
			people.push($(this).data('id'));
		});	
		if(people.length <=0)  {  
			alert("Jūs nepasirinkot ką norit ištrinti.");  
		}  
		else { 	
			var message = "Ar jūs tikrai norit pašalinti "+(people.length>1?"šituos":"šitą")+ (people.length>1?" įrašus?":" įrašą?");  
			var checked = confirm(message);  
			if(checked == true) {			
				var selected_values = people.join(","); 
				$.ajax({ 
					type: "POST",  
					url: "delete.php",  
					cache:false,  
					data: 'id='+selected_values,  
					success: function(response) {	
						var ids = response.split(",");
						for (var i=0; i<ids.length; i++ ) {						
							$("#"+ids[i]).remove();
						}
						location.reload();										
					}   
				});				
			}  
		}  
	});
});