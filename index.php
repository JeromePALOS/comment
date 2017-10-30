<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires</title>
		<meta charset="UTF-8">
		
		
		<style>
			.comment-header{
				background-color: #ddd;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 10px;
			}
			
			section{
				border: 1px solid black;
			}
			
			.comment-footer{
				text-align:right;
				padding-right: 10px;
			}
			
			.comment-content{
				padding: 5px 5px 5px 10px;
			}
			
		
		</style>
	</head>
	<body>
	
	
		<section>
			<div class="comment-header">
				<div>Nom Prenom</div>
				<div>18 juillet 2017</div>
			</div>
			
			<div class="comment-content">
				<div>
					Messages
				</div>
			</div>
			
			<div class="comment-footer">
				<a href="repondre.php">Repondre</a>
			</div>
		</section>
		
		<?php
			try {
					// Connexion à MongoDB
					$conn = new Mongo('localhost');

					// Connexion à la base de données "test"
					$db = $conn->Commentaires;

					// Création d'une nouvel objet de la collection "products"
					$collection = $db->sujet;

					// Hydratation de l'objet
					$product = array(
									'name' => 'Televisions',
									'date' => 'Televisions',
									'message' => 'Televisions'
									);

					// insertion dans la base
					$collection->insert( $sujet );

					echo 'Product insere avec ID: ' . $sujet['_id'] . "\n";

					// arrêt de la connexion
					$conn->close();

			}
			catch ( MongoConnectionException $e )
			{
					echo $e->getMessage();
			}
			catch ( MongoException $e )
			{
					echo $e->getMessage();
			}
		?>
		
	</body>
</html>