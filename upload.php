<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <title>✨ Error :( ✨</title>
    <link type="text/css" rel="stylesheet" href="style.css"/>
</head>
<?php

if (!empty($_FILES['files']['name'][0])){

    $files = $_FILES['files'];

    $uploaded = array();
    $failed = array();

    $allowed = array('jpg', 'png', 'gif');

    foreach ($files['name'] as $position =>$file_name){
        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext, $allowed)){

            if($file_error === 0){

                if($file_size <=1000000){

                    $file_name_new = uniqid('image', false). '.'.$file_ext;
                    $file_destination = 'uploads/'. $file_name_new;

                    if(move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$position] = $file_destination;
                    } else {
                        $failed[$position] = "[{$file_name}] n'a pas réussi à être envoyé";
                    }

                } else {
                    $failed[$position] = "[{$file_name}] est trop volumineux.";
                }

            } else {
                $failed[$position] = "[{$file_name}] a rencontré une erreur code {$file_error}.";
            }

        } else {
            $failed[$position]="[{$file_name}] l'extension de fichier '{$file_ext}' n'est pas permise.";
        }
    }
    if(!empty($uploaded)){
        print_r($uploaded);
        header('Location: index.php');
    }
    elseif(!empty($failed)){
        print_r($failed);
        echo
            "<h2 class='text-center'>Nooooooon ça ne marche pas!</h2>".
            "</br>".
            "<img src='https://media.giphy.com/media/7k61yuvynPn5m/giphy.gif' class='col-md-4 col-md-offset-4'>".
            "</br>".
            "<a href='index.php' class='btn btn-primary text-center'>Revenir à l'accueil</a>";
    }


}

