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
        <h2>Liens</h2>
        <div id="parser">
            <?php
            ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0');
            $id = null;
            $acc_id = null;
            $username = "";

            if(!isset($_GET['id']))
                $id = null;
            else
                $id = $_GET['id'];
            if(!isset($_GET['acc_id']))
                $acc_id = 2;
            else
                $acc_id = $_GET['acc_id'];

            switch ($acc_id) {
                case 0:
                    $username = "OTF1";
                    break;
                case 1:
                    $username = "OTF2";
                    break;
				case 2:
                    $username = "Mazulis";
                    break;
            }

            $content = file_get_contents('https://uptobox.com/users/'. $username . '/' . $id);

            $startTag = '<table class="files">';
            $endTag = '</table>';

            $start = explode($startTag, $content);
            $end = explode($endTag , $start[1]);

            echo $startTag . $end[0] . $endTag;
            ?>
        </div>
    </body>
</html>