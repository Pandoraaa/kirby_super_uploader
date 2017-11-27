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
    header('Location: index.php');
}

