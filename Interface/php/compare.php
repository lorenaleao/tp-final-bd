<?php
ini_set('display_errors', 1);
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../imdb.db');
    }
}

#if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$db = new MyDB();

	#$filmeUm = $_POST['filme1'];
	#$filmeDois = $_POST['filme2'];
	$filmeUm = 'O Auto da Compadecida';
	$filmeDois = 'Avengers: Endgame';

	echo "Filme 1: ".$filmeUm."\nFilme 2: ".$filmeDois."\n";	
	$result = $db->query("SELECT * FROM akas WHERE title = '$filmeUm'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$id1 = $row['title_id'];
	} else {
		$id1 = "Nome Inválido";
	}
	$result = $db->query("SELECT rating FROM ratings WHERE title_id = '$id1'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$rate1 = $row['rating'];
	} else {
		$rate1 = -2;
	}
	if($id1 == "Nome Inválido"){
		$rate1 = -1;
	}

	$result = $db->query("SELECT * FROM akas WHERE title = '$filmeDois'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$id2 = $row['title_id'];
	} else {
		$id2 = "Nome Inválido";
	}
	$result = $db->query("SELECT rating FROM ratings WHERE title_id = '$id2'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$rate2 = $row['rating'];
	} else {
		$rate2 = -2;
	}
	if($id1 == "Nome Inválido"){
		$rate2 = -1;
	}

	header("Location: ../compare.html?r1=".$rate1."&r2=".$rate2);


#}


#var_dump($result->fetchArray());

?>
