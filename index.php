<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires</title>
		<meta charset="UTF-8">
		
		
		<style>
			.comment{
				border: 1px solid black;
				margin-top: 5px;
			}
			
			.comment-header{
				background-color: #ddd;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 10px;
			}
			
			.comment-footer{
				text-align:right;
				padding-right: 10px;
			}
			
			.comment-content{
				padding: 5px 5px 5px 10px;
			}
			
			
			.create-sujet .comment-content label{
				padding-right: 20px;
			}
			.create-sujet .comment-content>div{
				margin-top: 5px;
			}
			.create-sujet .comment-footer input[type="submit"]{
				margin-top: 10px;
			}		
		</style>
	</head>
	<body>
	

		
	
		
		<?php
		if (isset($_POST['creer-un-sujet'])){
			echo $_POST['name'];
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
									'sujet' => $_POST['sujet']
									);

					// insertion dans la base
					$collection->insert( $com );

					echo 'Commentaire poste le : ' . $date;

					// arrêt de la connexion
					$conn->close();
					
					Affiche();

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
		
		
		if (isset($_POST['affiche'])){
			try {
				// Nouvelle connexion MongoDB
				$conn = new Mongo('localhost');
				// Connexion à la  database test
				$db = $conn->commentaires;
				// Choix de la collection
				$collection = $db->sujet;
				// Rapatriement de tous documents de la collection
				$cursor = $collection->find();
	
					// loop over the results
					foreach ($cursor as $obj)
					{
						echo "
							<!--Commentaire-->
							<section class='comment'>
								<div class='comment-header'>
									<div style='float:left;'>".$obj['sujet']."</div>	<div style='text-align:right;'>".$obj['date']."</div>
									<div>".$obj['name']."</div>
									
								</div>
								
								<div class='comment-content'>
									<div>
										".$obj['message']."
									</div>
								</div>
								
								<div class='comment-footer'>
									<a href='repondre.php'>Repondre</a>
								</div>
							</section>";
					}

				// clore la connexion à  MongoDB 
				$conn->close();
			}
			catch ( MongoConnectionException $e )
			{
				// gestion des erreurs lors de la connexion
				echo $e->getMessage();
			}
			catch ( MongoException $e )
			{
				echo $e->getMessage();
			}
		}

		?>
		<form method="post" action="#">
			<input type="submit" value="Afficher les com" name="affiche">
		</form>
		

		
	</body>
</html>