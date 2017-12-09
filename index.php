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
	
	<a href='create.php'> Creer un sujet </a>
	<?php
			function aff_com($sujet, $name, $date, $message, $id, $niv){
				echo "
					<!--Commentaire-->
					<section class='comment' style='margin-left:". $niv."px;'>
						<div class='comment-header'>
							<div style='float:left;'>Sujet : ".$sujet."</div>	<div style='text-align:right;'>".$date."</div>
							<div>".$name."</div>
							
						</div>
						
						<div class='comment-content'>
							<div>
								".$message."
							</div>
						</div>
						
						<div class='comment-footer'>
							<a href='repondre.php?sujet=".$sujet ."&parent=". $id."'>Repondre</a>
						</div>
					</section>";	
			}
		
			try {
				$conn = new Mongo('localhost');
				$db = $conn->commentaires;
				$collection = $db->sujet;

				

					$cursor = $collection->find();
					$i=0;
					foreach ($cursor as $obj){
						
						aff_com($obj['sujet'], $obj['name'], $obj['date'], $obj['message'], (string) $obj['_id'], $i);
						$i=$i+15;
							
					}
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

		?>

		

		
	</body>
</html>