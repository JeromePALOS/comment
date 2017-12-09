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
		if (isset($_POST['creer-un-sujet'])){
			try {
					// Connexion à MongoDB
					$conn = new Mongo('localhost');
					// Connexion à la base de données "test"
					$db = $conn->commentaires;

					// Création d'une nouvel objet de la collection "products"
					$collection = $db->sujet;
					
					//DAte
					date_default_timezone_set('UTC');
					$date= date('d m Y H:i');
					
					// Hydratation de l'objet
					$com = array(
									'name' => $_POST['name'],
									'date' => $date,
									'message' => $_POST['message'],
									'sujet' => $_POST['sujet'],
									'parent' => 0
									);

					// insertion dans la base
					$collection->insert( $com );

					echo 'Commentaire poste le : ' . $date;

					// arrêt de la connexion
					$conn->close();
					
					//Affiche();

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
						Creer un Sujet
					</div>
					<div class='comment-content'>
						<div>
							<label>Sujet : </label><input type='text' name='sujet'>
						</div>
						<div>
							<label>Votre Nom : </label><input type='text' name='name'> 
						</div>
						<div>
							<textarea placeholder='Message' name='message'></textarea>
						</div>
					</div>
					<div class='comment-footer'>
						<input type='submit' value='Creer un Sujet' id='creer-un-sujet' name='creer-un-sujet'>
					</div>
				</form>
			</section>";
		}
		
		
		?>	
		<a href="index.php"> Retour </a>
		

		
	</body>
</html>