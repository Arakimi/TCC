	<!-- POSTAGEM -->
	<script type="text/javascript">
	   $(function(){
	        $('#recadopara').change(function(){
		        if($('#recadopara').val()=='selecionar'){
		        	$('#marcrecadosamigos').fadeIn();
		        }else{
		       	 $('#marcrecadosamigos').fadeOut();
		        };
		    });
		});
	</script>
	<!-- PADRAO-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
	<!-- CHAT -->
	<script type="text/javascript">
			$.noConflict();
	</script>
	<script type="text/javascript" src="js/functionsChat.js"></script>
	<script type="text/javascript" src="js/jcrop.js"></script>
	</body>
</html>