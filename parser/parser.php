<?php
include "./parser_functions.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Otaku Family - Liens</title>
        <link rel="stylesheet" type="text/css" href="/uploads/ressources/parser.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i">
        <link rel="shortcut icon" href="/uploads/ressources/favicon.ico">
    </head>
    <body>
        <?php

        $acc_id = $_GET['acc_id'];    
        $uptoboxPath = $_GET['uptobox_path'];
        $recursive =false;
        if(isset($_GET['recursive'])){
            if($_GET['recursive'] == "true"){
                $recursive=true;
            }
        }
        $directLinks=false;
        if(isset($_GET['direct'])){
            if($_GET['direct'] == "true"){
                $directLinks=true;
            }
        }
        $files = listFiles($acc_id,$uptoboxPath,$recursive,$directLinks);
        ?>
        <h2>Liens</h2>
        <p id="dossier">
         Dossier : <?=$uptoboxPath?>
         </p>
        <div id="parser">
            <table>
                <thead>
                    <tr>
                        <th>Nom du fichier / Téléchargement direct</th>
                        <th>Taille du fichier</th>
                        <th>Page uptobox</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td>
                            <?php 
                            if($directLinks){ ?>
                                <a href="<?=$file["dlLink"]?>"><?=$file["file_name"]?></a>
                            <?php }else{ ?>
                                <?=$file["file_name"]?>
                            <?php } ?>
                            </td>
                        <td><?=formatFileSizeToMo($file["file_size"])?> Mo</td>
                        <td><a href="https://uptobox.com/<?=$file["file_code"]?>">https://uptobox.com/<?=$file["file_code"]?></a></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </body>
</html>