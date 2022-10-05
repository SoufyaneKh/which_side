<?php
$msg="";
    if(isset($_POST['btn_which'])&&$_POST['btn_which']=="Which_side_today"){
        $date_file = fopen("date.txt", "r") or die("Unable to open this file!");
        $old_d= fgets($date_file);
        fclose($date_file);

        if(isset($old_d)&& $old_d!=""){
            $msg .=" Today is : ".date("Y-m-d");
            $side_file = fopen("side.txt", "r") or die("Unable to open this file!");
            $myside= fgets($side_file);
            fclose($side_file);
            if($old_d == date("Ymd")){//old date != today
                $msg .= "<br> Side of today is :" .$myside;
            }else{//
                // echo "update";
                if($myside =="droite"){
                    $myside =" gauche"; 
                }else{
                    $myside ="droite";
                }
                $msg .= " .Side of today is :<span>" .$myside."</span>";

                $fileside = fopen("side.txt", "w") or die("Unable to open file!");
                fwrite($fileside, $myside);
                fclose($fileside );
                $old_d =date("Ymd");
                $myfile = fopen("date.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $old_d);
                fclose($myfile);
            }
        }else{
            $old_d =date("Ymd");
            $filedate = fopen("date.txt", "w") or die("Unable to open file!");
            fwrite($filedate, $old_d);
            fclose($filedate);
            $old_side ="droite";
            $fileside = fopen("side.txt", "w") or die("Unable to open file!");
            fwrite($fileside, $old_side);
            fclose($fileside);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Which side today</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="btn">
            <form action="index.php" method="post">
                <input class="btn-which" type="submit" name="btn_which" value="Which_side_today">
            </form>
        </div>
            <?php 
            if(isset($myside)){

            ?>
        <div class="info">
            <audio controls autoplay>
                <source src="<?php echo $myside?>.ogg" type="audio/ogg">
                <source src="<?php echo $myside?>.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

            <?php echo "<p>".$msg."</p>";?>

        </div>
        <div class="image">
            <img src="<?php echo $myside?>.png" alt="">
        </div>
            <?php }?>
    </div>
</body>
</html>