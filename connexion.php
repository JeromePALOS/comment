<?php 

try {
		$conn = new Mongo('localhost');
		$db = $conn->commentaires;
		$collection = $db->login;
		
		$cursor = $collection->find();

		foreach ($cursor as $obj){
			
			if($obj['password']==$_POST['pass'] && $obj['login']==$_POST['log']){
				echo 'Identifiant valide';
			}else{
				echo 'Mauvais identifiant.   Pour les tests c\'est login : admin et password = admin'; 
			}
			
		}

		
		
		

		// arrêt de la connexion
		$conn->close();

}
catch ( MongoConnectionException $e ){
		echo $e->getMessage();
}
catch ( MongoException $e ){
		echo $e->getMessage();
}







?>