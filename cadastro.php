<?php include_once "header.php"; ?>

<?php include_once "leftCol.php"; ?>

<?php
	//error_reporting(1);

	$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
	if($conexao -> connect_error){
		echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
	} 		
	
	if($_POST != NULL){	
				
		$user_id = $_SESSION["user_id"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$img = $_POST["img"];
		$sql = "UPDATE TblUser set name = '$name', email = '$email', img = '$img' where user_id = $user_id";			
		
		$sucesso = $conexao->query($sql);

		if($sucesso){
			$_SESSION["name"]=$name;
			$_SESSION["img"]=$img;
			echo "<script>alert('Atualizado com sucesso!')</script>";
			header('location:cadastro.php');	
		} else {
			echo "<script>alert('Falha na alteração dos dados')</script>";
		}	
		
	}  else {
		
		$user_id = $_SESSION["user_id"];
		$sql = "SELECT * from TblUser where user_id = $user_id";
		$sucesso = $conexao->query($sql);
	
		if($sucesso){
			$row = $sucesso->fetch_assoc();
			$name = $row["name"];
			$email = $row["email"];
			$img = $row["img"];
		} else {
			echo "<script>alert('Falha na leitura dos registros cadastrados')</script>";
		}
	}
?>
	
    <!-- Middle Column -->
    <div class="w3-col m9">
    
      <div class="col-lg-12">
		<h1 style="text-align:center;" class="mb-3">Editar Profile</h1>
		<hr>
		<form method="POST">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $name ?>" required>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="E-mail" required>
					</div>					
				</div>
			</div>			
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<input type="text" class="form-control" name="img" value="<?php echo $img ?>" placeholder="Picture URL" required>
					</div>					
				</div>			
			</div>
			<div class="row" style="text-align:center;">
				<div class="col-12">
					<input type="submit" class="btn btn-dark" value="Save">
				</div>
			</div>
			<hr>
		</form>
        
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
