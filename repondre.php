<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires</title>
		<meta charset="UTF-8">
		
		
		<link rel="stylesheet" type="text/css" href="styles/css.css">
			<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
			<script>tinymce.init({ selector:'textarea' });</script>
	</head>
	<body>
		<?php
		if (isset($_POST['Repondre'])){
			try {
					$conn = new Mongo('localhost');
					$db = $conn->commentaires;
					$collection = $db->sujet;
					
					//DAte
					date_default_timezone_set('UTC');
					$date= date('d m Y H:i');
					
					// Hydratation de l'objet
					$com = array(
									'name' => $_POST['name'],
									'date' => $date,
									'message' => $_POST['message'],
									'sujet' => $_GET['sujet'],
									'parent' => $_GET['parent']
									);

					$collection->insert( $com );
					echo 'Commentaire poste le : ' . $date;
					
					// arrêt de la connexion
					$conn->close();
			}
			catch ( MongoConnectionException $e ){
					echo $e->getMessage();
			}
			catch ( MongoException $e ){
					echo $e->getMessage();
			}
		}else{
			echo"<section class='comment create-sujet'>
				<form method='post' action='#'>
					<div class='comment-header'>
						Repondre
					</div>
					<div class='comment-content'>
						<div>
							Sujet : ".$_GET['sujet']." ".$_GET['_id']."
						</div>
						<div>
							<label>Votre Nom : </label><input type='text' name='name' placeholder='login' id='name'><span id='info'></span><input type='button' value='Ou se connecter' id='co'> <div id='aff' style='display:none;'><input type='password' id='password' placeholder='admin'><input type='button' value='Connexion' id='connexion'></div> 
						</div>
						<div>
							<textarea placeholder='Message' name='message'></textarea>
						</div>
					</div>
					<div class='comment-footer'>
						<input type='submit' value='Repondre' id='Repondre' name='Repondre'>
					</div>
				</form>
			</section>";
		}
		
		
		?>	
		<a href="index.php"> Retour </a>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		
		
		<script>
			//affiche barre de co
			var btn = document.getElementById("co"); 
			btn.addEventListener("click", affco, false); 
			
			function affco(){
				aff = document.getElementById("aff"); 
				aff.style.display = 'block';
				btn.style.display ='none';

			}

			
			
			//connexion ajax
			$(document).ready(function(){				
				$("#connexion").click(function() {
					var log = document.getElementById('name').value;
					var pass = document.getElementById('password').value;				
					$.post("connexion.php",
						{
						log: log,
						pass : pass
						},
						function(data,status){
							if(data == 'Identifiant valide'){
								aff.style.display = 'none';
							}
							$('#info').html(data);
						}
					);
				 });

			});

		</script>
		
	</body>
</html>