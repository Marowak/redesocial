<?php

	error_reporting(1);

	if($_POST != NULL){	
		$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
		if($conexao -> connect_error){
			echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
		} 		
		
		if (isset($_POST['cadastrar'])) {
			
			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$senha = $_POST["senha"];
			$confsenha = $_POST["confsenha"];
			
			if($senha == $confsenha){
				$sql = "INSERT INTO Tbluser (name,email,psword, img) values ('$nome','$email','$senha','http://winkeyecare.com/wp-content/uploads/2013/03/Empty-Profile-Picture-450x450.jpg');";
				
				$sucesso = $conexao->query($sql);
							
				if($sucesso){
					session_start();
					$last_id = $conexao->insert_id;
					$_SESSION["user_id"]=$last_id;
					$_SESSION["name"]=$nome;
					$_SESSION["img"]='http://winkeyecare.com/wp-content/uploads/2013/03/Empty-Profile-Picture-450x450.jpg';
					header('location:index.php');		
				} else {
					echo "<script>alert('Falha na conexão ao cadastrar.')</script>";
				}
				
			} else {
				echo "<script>alert('Senha informada e confirmada estão diferentes.')</script>";
			}
			
		
		} else {
			$email = $_POST["emailLogin"];
			$senha = $_POST["senhaLogin"];
			$sql = "SELECT user_id,name,img FROM TblUser where psword = '$senha' and email = '$email'";
			
			$sucesso = $conexao->query($sql);
		
			if($sucesso){
				if(mysqli_num_rows  ($sucesso) > 0){
					$row = $sucesso->fetch_assoc();
					session_start();
					$_SESSION["user_id"]=$row["user_id"];	
					$_SESSION["name"]=$row["name"];	
					$_SESSION["img"]=$row["img"];	
					header('location:index.php');
				}
				
				echo "<script>alert('E-mail ou senha incorretos.')</script>";
			} else {
				echo "<script>alert('Falha na conexão.')</script>";
			}
			
		}
		
	}
	
?>

<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Rede Social</title>

  <link href="imports/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">

</head>

<body>

  <!-- Navegação -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">YouSocial</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        
      </div>
    </div>
  </nav>

  <div class="container">

    <div class="row mt-5">
	
      
      <div class="col-lg-7">
		<h1 style="text-align:center;" class="mb-3">Abra uma conta</h1>
		<hr>
		<form method='POST'>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<input type="text" class="form-control" name="nome" placeholder="Nome" required>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="E-mail" required>
					</div>					
				</div>
			</div>			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<input type="password" class="form-control" name="senha" placeholder="Senha" required>
					</div>					
				</div>	
				<div class="col-6">
					<div class="form-group">
						<input type="password" class="form-control" name="confsenha" placeholder="Confirmar Senha" required>
					</div>					
				</div>			
			</div>
			<div class="row" style="text-align:center;">
				<div class="col-12">
					<input type="submit" name="cadastrar" class="btn btn-dark" value="Cadastrar">
				</div>
			</div>
			<hr>
		</form>
        
	  </div>
	  <div class="col-md-1">
	  </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
		<h1 style="text-align:center;" class="mb-3">Acesse Sua Conta</h1>
		<hr>
		<form method='POST'>
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<input type="text" class="form-control" name="emailLogin" placeholder="E-mail" required>
					</div>
				</div>			
			</div>			
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<input type="password" class="form-control" name="senhaLogin" placeholder="Senha" required>
					</div>					
				</div>						
			</div>			
			<div class="row" style="text-align:center;">
				<div class="col-12">
					<input type="submit" name="Login" class="btn btn-dark" value="Login">					
				</div>
			</div>	
			<div class="row" style="text-align:center;">
				<div class="col-12">
					<a href="#" style="font-size:12px;">Esqueci minha senha</a>
				</div>
			</div>			
			<hr>
		</form>
      </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 mt-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; YouSocial 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="imports/jquery/jquery.min.js"></script>
  <script src="imports/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
