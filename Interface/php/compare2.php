<!DOCTYPE html>
<html>
<head>

	<title>Into Movies - Compare</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
	
	<div id="area-cabecalho">
		
		<div id="area-logo">
			<h1>Into<span class="branco">Movies</span></h1>
		</div>
		<div id="area-menu">
			<a href="../index.html">Home</a>
			<a href="../quemsomos.html">Quem Somos?</a>
			<a href="../modelos.html">Banco de Dados</a>
			<a href="../compare.html">Compare Filmes</a>
			<a href="">Pesquise</a>
		</div>

	</div>

	<div id="area-principal">

		<div id="area-principal">

			<!-- abertura postagem -->
			<div class="postagem">
				<h2>Compare Filmes</h2>
				<p>
					Digite abaixo o nome de dois filmes e descubra qual tem o melhor ranking de acordo com o IMDb.
				</p> <br>

				<form action="compare2.php" method="post">
					<p>Filme 1:
					<input type="text" name="filme1" value="<?php echo $_POST['filme1']; ?>"><br></p>
					<p>Filme 2:
					<input type="text" name="filme2" value="<?php echo $_POST['filme2']; ?>"><br></p>

					<input type="submit" value="Comparar">
				</form>

				<br><br>		
				

				<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('../imdb.db');
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$db = new MyDB();


	$filmeUm = $_POST['filme1'];
	$filmeDois = $_POST['filme2'];

	
	$result = $db->query("SELECT * FROM akas WHERE title = '$filmeUm'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$id1 = $row['title_id'];
	} else {
		$id1 = "Nome Inválido";
	}

	if($id1 == "Nome Inválido"){
		echo "Nome Inválido para o filme 1<br>";
	} else{
		$result = $db->query("SELECT rating FROM ratings WHERE title_id = '$id1'");
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
			$rate1 = $row['rating'];
		} else {
			echo "Não há avaliação para o filme 1<br>";
		}
	}	

	$result = $db->query("SELECT * FROM akas WHERE title = '$filmeDois'");
	if($row = $result->fetchArray(SQLITE3_ASSOC)){
		$id2 = $row['title_id'];
	} else {
		$id2 = "Nome Inválido";
	}
	if($id2 == "Nome Inválido"){
		echo "Nome Inválido para o filme 2";
	} else {
		$result = $db->query("SELECT rating FROM ratings WHERE title_id = '$id2'");
		if($row = $result->fetchArray(SQLITE3_ASSOC)){
			$rate2 = $row['rating'];
		} else {
			echo "Não há avaliação para o filme 2";
		}
	}
	
	if($rate1 > -1 && $rate2 > -1){
		if($rate1 > $rate2){
			echo "O filme $filmeUm é melhor avaliado com nota $rate1.<br>
					$filmeDois recebeu a nota $rate2.<br>";
		}
		else if($rate1 < $rate2){
			echo "O filme $filmeDois é melhor avaliado com nota $rate2.<br>
					$filmeUm recebeu a nota $rate1.<br>";
		}
		else{
			echo "Houve um empate!<br>Ambos os filmes tem nota $rate1.";
		}
	}
}

?>
				
			</div><!--// fechamento postagem -->

		</div>

</body>
</html>
