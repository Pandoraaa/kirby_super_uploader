<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<title>✨ Kirby Super Uploader ✨</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<body>
<h1 class="text-center">✨ Kirby Super Uploader ✨</h1>
<div class="row">
<div class="col-md-4 col-md-offset-4">
	<form action="upload.php" method="post" enctype="multipart/form-data">
        <fieldset>
        <legend>✨ Ajoutez vos fichiers ✨</legend>
        <div class="form-group">
            <label for="file">Ajoutez vos fichiers (taille max. 1Mo):</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
            <input type="file" name="files[]" id="file" multiple/>
        </div>
        <input type="submit" value="Envoyer" class="btn btn-primary"/>
        </fieldset>
	</form>
</div>
</div>
<?php

$dir ="uploads";
$scan = array_diff(scandir($dir), array('..','.'));


if(is_array($scan)){
echo "<div class='container'>";
    foreach($scan as $image){
    echo
    "<div class='col-md-3'>".
        "<div class='panel panel-default'>".
            "<div class='thumbnail'>".
                "<img src='uploads/$image' style='width: 100%'>".
                "</div>".
            "<div class='panel-body'>".
                "<p>Nom : $image</p>".
                "<a href='delete.php?file=$image' class='btn btn-danger'>Supprimer</a>".
                "</div>".
            "</div>".
        "</div>";
    }
    echo "</div> ";
}
?>
</body>
</html>
