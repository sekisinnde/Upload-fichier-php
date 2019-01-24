<?php
   
   require 'includes/connect_db.php';

   //var_dump($_FILES);
   if (!empty($_FILES)) {
   	$file_name = $_FILES['fichier']['name'];
   	//$file_type = $_FILES['fichier']['type'];
   	$file_extension = strrchr($file_name, "." );
   	
   	//$file_tmp_name = $_FILES['fichier'][' tmp_name'];
   	$file_dest ='files/' .$file_name;

   	//echo "Nom: ".$file_name. '</br>' ;
   	//echo "Extension: ".$file_extension;
   	$extensions_authorisees  = array('.pdf' ,'.PDF' );

   	if (in_array($file_extension, $extensions_authorisees)) {

   	 //   if (move_uploaded_file($file_tmp_name, $file_dest)) {
   	     	$req = $db->prepare('INSERT INTO files(name,file_url) VALUES(?,?)');
   	     	$req->execute(array($file_name, $file_dest));

   	     	echo "fichier envoyé avec succés"; 
   	     }else{
   	     	echo "une erreur est servenu lors de l'envoi du fichier ";
   	     }
   	     	

   	     	
   		
   	}else{
   		echo "seuls fichier pdf sont authorisés";
   	}
   //}


?>

<!DOCTYPE >
<html>
<head>
	<title>Upload de fichier PDF </title>
	<meta charset="utf-8" />
</head>
<body>
<h1>Upload un fichier PDF</h1>

<form method="POST" enctype="multipart/form-data">

    <input type="file" name="fichier"/> </br>
    <input type="submit" value="Envoyer le fichier"/>
	
</form>
<h1>Fichier PDF enregistrés</h1>
<?php
$req = $db->query('SELECT name,file_url FROM files');

while($data = $req->fetch()){
	echo $data['name'].' : '.'<a href="'.$data['file_url'].'">Télécharger '.$data['name'].'</a></br>';
}


?>

</body>
</html>
