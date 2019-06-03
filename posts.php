<?php include_once "header.php"; ?>

<?php include_once "leftCol.php"; ?>

	<?php
	//error_reporting(1);

	if($_POST != NULL){	
		$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
		if($conexao -> connect_error){
			echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
		} 		
		
		if (isset($_POST['like'])){
			$post_id = $_POST['post_id'];
			$sql = "UPDATE Post set qty_like = qty_like + 1 where post_id = $post_id";			
			$sucesso = $conexao->query($sql);
		} else if (isset($_POST['comment'])){
			$post_id = $_POST['post_id'];
			header('location:comments.php?post_id=' . $post_id );			
		} else if (isset($_POST['request'])){
			$user_id = $_GET["user_id"];
			$user_id_sec = $_SESSION["user_id"];
			$sql = "INSERT INTO friend (requester_id, requested_id, accepted) values ($user_id_sec, $user_id,0)";			
			$sucesso = $conexao->query($sql);	
			echo "<script>alert('Pedido enviado com sucesso.')</script>";			
		}
	}
?>
    
    <!-- Middle Column -->
	
	<div class="w3-col m9"> 
	
	<?php
	$user_id_sec = $_SESSION["user_id"];
	$user_id = $_GET["user_id"];
	if($user_id_sec != $user_id){
		$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
		if($conexao -> connect_error){
			echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
		} 
		
		$sql = "SELECT 1 from friend f
				WHERE (f.requested_id = $user_id_sec AND f.requester_id = $user_id)
				OR (f.requester_id = $user_id_sec AND f.requested_id = $user_id)
					";		
				
		$sucesso = $conexao->query($sql);
		
		if(mysqli_num_rows  ($sucesso) > 0){
			
		} else {
			echo '
			<form method="POST">
				<input type="submit" class="mt-1 w3-button w3-theme" name="request" class="btn btn-dark" value="Adicionar">
			</form>
			';
		}		
	}

	?>	
	
     <h1 style="text-align:center;">Mural de posts </h1>
	<hr>
      <?php
			
				$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
				if($conexao -> connect_error){
					echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
				} 	
			
				$user_id = $_GET['user_id'];
				
				$sql = "SELECT p.*, u.name FROM post p
				JOIN tbluser u
				ON p.user_id = u.user_id
				WHERE p.user_id = $user_id
				ORDER BY p.post_id desc
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
								<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="like" class="btn btn-dark" value="Like">								
								<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="comment" class="btn btn-dark" value="Comment">
								</form>
							</div>
							';
							
						}						
					}	
				} else {
					echo "<script>alert('Falha na conexão ao ler os posts.')</script>";
				}		
			?>		
      
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
