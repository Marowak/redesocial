<?php include_once "header.php"; ?>

<?php include_once "leftCol.php"; ?>
    
	<?php

	error_reporting(1);

	if($_POST != NULL){	
		$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
		if($conexao -> connect_error){
			echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
		} 		
		
		
		if (isset($_POST['comentario'])) {
			$user_id = $_SESSION["user_id"];
			$post_id = $_GET['post_id'];
			$texto = $_POST['texto'];
			$sql = "INSERT INTO Reply (post_id, user_id, text, qty_like) values ($post_id,$user_id, '$texto',0 )";			
			
			$sucesso = $conexao->query($sql);
	
			if($sucesso){
				header('location:comments.php?post_id='.$post_id);	
			} else {
				echo "<script>alert('Falha na publicação do comentário')</script>";
			}	
		
		} else if (isset($_POST['likec'])){
			$post_id = $_POST['post_id'];
			$sql = "UPDATE Post set qty_like = qty_like + 1 where post_id = $post_id";			
			$sucesso = $conexao->query($sql);
		} else if (isset($_POST['liker'])){
			$reply_id = $_POST['reply_id'];
			$sql = "UPDATE reply set qty_like = qty_like + 1 where reply_id = $reply_id";			
			$sucesso = $conexao->query($sql);		
		}
	}
?>
	
    <!-- Middle Column -->
    <div class="w3-col m9"> 
	<h1 style="text-align:center;">Comentário</h1>
	<hr>
     
      <?php
			
				$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
				if($conexao -> connect_error){
					echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
				} 	
				
				$post_id = $_GET['post_id'];
				
				$sql = "SELECT p.*, u.name FROM post p
				JOIN tbluser u
				ON p.user_id = u.user_id
				WHERE post_id = $post_id
				";
				
				$sucesso = $conexao->query($sql);			
				
				
				if($sucesso){
					if(mysqli_num_rows  ($sucesso) > 0){
						while ($row = mysqli_fetch_array($sucesso)) {
							$post_id = $row["post_id"];
							$name = $row["name"];
							$texto = $row["texto"];
							$qty_like = $row["qty_like"];
							echo '
							 <div class="w3-container w3-card w3-white w3-round w3-margin">
								<br>								
								<span class="w3-right w3-opacity">Likes: ' .  $qty_like .  '</span>
								<h4>' . $name . '</h4>
								<hr class="w3-clear">
								<p>' . $texto . '</p>		
								<form method="POST">
								<input type="hidden" class="mb-1 mt-1 w3-button w3-theme" name="post_id" class="btn btn-dark" value="' . $post_id. '">								
								<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="likec" class="btn btn-dark" value="Like">		
								</form>
							</div>
							';
						}						
					}	
				} else {
					echo "<script>alert('Falha na conexão ao ler o post.')</script>";
				}
				
				echo '<br> <hr>';
				echo 'Comentários';
				
				$sql = "SELECT r.*,u.name FROM reply r
						JOIN tbluser u
						ON r.user_id = u.user_id
						where post_id = $post_id
						order by reply_id desc
				";
				
				$sucesso = $conexao->query($sql);			
								
				if($sucesso){
					if(mysqli_num_rows  ($sucesso) > 0){
						while ($row = mysqli_fetch_array($sucesso)) {
							$reply_id = $row["reply_id"];
							$name = $row["name"];
							$texto = $row["text"];
							$qty_like = $row["qty_like"];
							echo '
							 <div class="w3-container w3-card w3-white w3-round w3-margin">
								<br>								
								<span class="w3-right w3-opacity">Likes: ' .  $qty_like .  '</span>
								<h4>' . $name . '</h4>
								<hr class="w3-clear">
								<p>' . $texto . '</p>		
								<form method="POST">
								<input type="hidden" class="mb-1 mt-1 w3-button w3-theme" name="reply_id" class="btn btn-dark" value="' . $reply_id. '">								
								<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="liker" class="btn btn-dark" value="Like">		
								</form>
							</div>
							';
						}						
					}	
				} else {
					echo "<script>alert('Falha na conexão ao ler os comentários.')</script>";
				}
				
			?>		
			
			<div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h6 class="w3-opacity">Faça seu comentário</h6>
							<form method='POST'>
								<input type="text" class="form-control" name="texto" placeholder="">
								<input type="submit" class="mt-1 w3-button w3-theme" name="comentario" class="btn btn-dark" value="Comentar">
							</form>
                        </div>
                    </div>
                </div>
            </div>
      
    <!-- End Middle Column -->
    </div>    
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<?php include_once "footer.php"; ?>
 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
