<?php
if(isset($_GET['namefriend'])){	
	$name = $_GET["namefriend"];
	$img = $_GET["img"];
} else {
	
	$name = $_SESSION["name"];
	$img = $_SESSION["img"];
}
?>

<?php
	error_reporting(1);

	if($_POST != NULL){	
		$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
		if($conexao -> connect_error){
			echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
		} 		
		
		if (isset($_POST['accept'])) {
			
			$user_id = $_SESSION["user_id"];
			$user_id_requester = $_POST["user_id"];
			$sql = "UPDATE friend set accepted = 1 where requester_id = $user_id_requester AND requested_id = $user_id";			
			
			$sucesso = $conexao->query($sql);
	
			if($sucesso){
				echo "<script>alert('Amizade aceita!')</script>";
			} else {
				echo "<script>alert('Falha ao aceitar solicitação de amizade.')</script>";
			}	
		
		} else if (isset($_POST['reject'])){
			$user_id = $_SESSION["user_id"];
			$user_id_requester = $_POST["user_id"];
			$sql = "DELETE FROM friend where requester_id = $user_id_requester AND requested_id = $user_id";	
			$sucesso = $conexao->query($sql);			
			if($sucesso){
				echo "<script>alert('Amizade rejeitada!')</script>";
			} else {
				echo "<script>alert('Falha ao rejeitar solicitação de amizade.')</script>";
			}	
		}
	}
?>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center"><?php echo $name ?></h4>
         <p class="w3-center"><img src="<?php echo $img ?>" class="w3-circle" style="height:106px;width:106px" alt=""></p>
        </div>
      </div>
      <br>
	  
	  <?php
			
				$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
				if($conexao -> connect_error){
					echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
				} 	
				$user_id = $_SESSION["user_id"];
				
				$sql = "select u.user_id,u.name,u.img from friend f
				JOIN TblUser u
				ON f.requester_id = u.user_id
				WHERE f.requested_id = $user_id
				AND accepted = 0
					";		
				
				$sucesso = $conexao->query($sql);
				
				if($sucesso){
					if(mysqli_num_rows  ($sucesso) > 0){
						while ($row = mysqli_fetch_array($sucesso)) {
							$name = $row["name"];
							$img = $row["img"];
							$user_id = $row["user_id"];
							echo '
							<div class="w3-container w3-card w3-white w3-round w3-margin">
								<br>								
								<a href="posts.php?user_id='.$user_id.'&namefriend='.$name.'&img='.$img.'"><img style="height:100px; width:100px;" src="' . $img . '"></a>
								<h4>' . $name . '</h4>
								<hr class="w3-clear">	
								<form method="POST">
									<input type="hidden" class="mb-1 mt-1 w3-button w3-theme" name="user_id" class="btn btn-dark" value="' . $user_id. '">								
									<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="accept" class="btn btn-dark" value="Aceitar">								
									<input type="submit" class="mb-1 mt-1 w3-button w3-theme" name="reject" class="btn btn-dark" value="Rejeitar">
								<form>
							</div>
							';							
							
						}						
					}	
				} else {
					echo "<script>alert('Falha na conexão ao ler solicitações de amizade.')</script>";
				}		
			?>		
      
   
    
    <!-- End Left Column -->
    </div>