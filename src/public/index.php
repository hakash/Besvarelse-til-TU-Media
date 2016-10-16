<?php
class Application {

	function render($content){
		header("Content-type: application/json; encoding:utf8");

		echo $content;
	}

	function getArticlesFromDB(){
		$pdo = new PDO('mysql:host=db;dbname=tumedia','tu','123abc');

		$sql = 'SELECT articles.*, auths.name FROM articles LEFT JOIN (SELECT concat(first_name, \' \', last_name) as name, author_id from authors) as auths ON articles.author_id = auths.author_id;';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll();
		return $results;
	}


	function convertArticlesToJSON($results){
		$articles = array();
		foreach($results as $result){
			$article = new stdClass();

			// Do a foreach to futureproof against changes in the dbschema
			foreach($result as $key => $value){
				
				// Check if $key is a string to make sure we only handle each array element once
				if(!is_string($key)){
					continue;
				} 
				
				// If $value is not a string, we do not need to utf8_encode() it
				if(!is_string($value)){
					$article->$key = $value;
				}
				else {
					$article->$key = utf8_encode($value);
				}
			}
			$articles[] = $article;
		}

		$json = json_encode($articles);
		return $json;
	}
}

$app = new Application();
$app->render( $app->convertArticlesToJSON( $app->getArticlesFromDB() ));