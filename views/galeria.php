<?php
require_once "cabecalho.php";
?>
<script>
	$(document).ready( function() {
		$(".gallery").flipping_gallery();
		
		$(".next").click(function() {
		$(".gallery").flipForward();
		return false;
		});
		$(".prev").click(function() {
		$(".gallery").flipBackward();
		return false;
		});
	});
		
	</script>

		
<div class="content">
			<div class="container">
			
		<div class="gallery" style="margin-left:130px">
		<a href="#" data-caption="">
		<img src="../academia-imagem/imagem4.jpg" border="2"></a>
		<a href="#" data-caption="">
		<img src="../academia-imagem/imagem4.jpg" border="2"></a>
		<a href="#" data-caption="">
		<img src="../academia-imagem/imagem4.jpg" border="2"></a>
		<a href="#" data-caption="">
		
				
			
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><div class="row justify-content-center align-items-center"><div class="navigation">
		<a href="#" class="btn prev btn-primary">Previous</a>
		<a href="#" class="btn next btn-primary">Next</a>
		
		</div>
		</div>
	
	</div>
</div>
</body>
</html>
