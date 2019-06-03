<?php include_once "header.php"; ?>

    <?php include_once "leftCol.php"; ?>
	
	

		<h1 style="text-align:center;">Buscar Usuários</h1>
		<hr>
        <!-- Middle Column -->
        <div class="w3-col m9">

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h6 class="w3-opacity">Pesquisar pessoas</h6>
							<form method='POST'>
								<input type="text" class="mt-2 form-control" name="name" placeholder="Nome">
								<select name="tipo" class="mt-2 form-control">
									<option value="todos" selected='true'>Todos os usuários</option>
									<option value="amigos">Apenas amigos</option>									
								</select>
								<input type="submit" class="mt-1 w3-button w3-theme" name="search" class="btn btn-dark" value="Buscar">
							</form>
                        </div>
                    </div>
                </div>
            </div>
			
			<?php
			if($_POST != NULL){	
				$conexao = new mysqli("localhost", "redesocial", "rede1234","redesocial");
				if($conexao -> connect_error){
					echo "Erro ao conectar: " . $conexao -> connect_error . "<br>";
				} 	
				$name = $_POST["name"];
				$tipo = $_POST["tipo"];
				
				if($tipo == "todos"){
					$sql = "SELECT DISTINCT t.user_id,t.name,img FROM tblUser t
					WHERE t.name like '%$name%'";
				} else {
					$sql = "SELECT DISTINCT t.user_id,t.name,img FROM tblUser t
					WHERE t.user_ID = (SELECT DISTINCT requested_ID from friend where requester_id = $user_id
                                      UNION
                                      SELECT DISTINCT requester_ID from friend where requested_ID = $user_id)
						";		
				}	
				
				$sucesso = $conexao->query($sql);
				
				if($sucesso){
					if(mysqli_num_rows  ($sucesso) > 0){
						while ($row = mysqli_fetch_array($sucesso)) {
							$user_id = $row["user_id"];
							$name = $row["name"];
							$img = $row["img"];
							echo '
							<div class="w3-container w3-card w3-white w3-round w3-margin">
								<br>								
								<a href="posts.php?user_id='.$user_id.'&namefriend='.$name.'&img='.$img.'"><img style="height:100px; width:100px;" src="' . $img . '"></a>
								<h4>' . $name . '</h4>
								<hr class="w3-clear">		
							</div>
							';
						}						
					}	
				} else {
					echo "<script>alert('Falha na conexão ao ler os posts.')</script>";
				}	
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