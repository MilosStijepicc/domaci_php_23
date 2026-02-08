<?php

    if(!isset($_FILES['profileImage'])){
        die("Niste proslijedili profilnu sliku!");
    }

    $allowedExtensions = ["jpeg", "jpg", "png", "gif"];

    $imageType = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);

    if(!in_array($imageType, $allowedExtensions)){
        die("Format slike nije dobar, mora biti: ".implode(',', $allowedExtensions));
    }

    $imageSize = $_FILES['profileImage']['size'];

    $maxFileSize = 2 * 1024 * 1024;

    if($imageSize > $maxFileSize){
        die("Slika je prevelika!");
    }else{
        echo "Slika je uploadovana uspjesno!";
    }

    list($width, $height) = getimagesize($_FILES['profileImage']['tmp_name']);

    if($width > 1920 && $height > 1024){
        die("Maksimalna sirina slike moze biti 1920px, a maksimalna visina 1024px!");
    }

    $imageName = time().".".$imageType;

    $finalPath = "./uploads/$imageName";

    if(!is_dir("./uploads")){
        mkdir('./uploads', 0755, true);
    }

    $tmpFileName = $_FILES['profileImage']['tmp_name'];

    $imageUploaded = move_uploaded_file($tmpFileName, $finalPath);

    if($imageUploaded){
        echo "Uspjesno ste dodali sliku!";
    }
    else{
        die("Neuspjesno dodavanje slike!");
    }

?>