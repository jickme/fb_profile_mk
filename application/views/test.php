<script type="text/javascript">
$(document).ready(function (e){
	
	$("#upload_file").on('submit',(function(e){
		e.preventDefault();
		$.ajax({
			url: "",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
			success: function(data){
				console.log(data);
			},
			error: function(){
				console.log('Loi');
			} 	        
		});

	}));
});
</script>