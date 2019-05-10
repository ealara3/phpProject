<?php

/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 2/25/2019
 * Time: 9:14 PM
 */
/* The lists of the zTunes and Zmazon */


static $ztunes = array('Tsong1' => 'Tsong1','Tsong2' => 'Tsong2','Tsong2' => 'Tsong2','Tsong3' => 'Tsong3','Tsong4' => 'Tsong4');

static $zmazon = array('Msong1' => 'Msong1','Msong2' => 'Msong2','Msong2' => 'Msong2','Msong3' => 'Msong3','Msong4' => 'Msong4');

function Ztunes_options(){
    global $ztunes;
    $str = '';
    foreach($ztunes as $i => $j){
        $str .= '<option value="'.$j.'">'.$i.' </option>'; /* create a string of the options */
    }
    return $str;
}

function Zmazon_options(){
    global $zmazon;
    $str = '';
    foreach($zmazon as $i => $j){
        $str .= '<option value="'.$j.'">'.$i.' </option>'; /* create a string of the options */
    }
    return $str;

}


/*remove and add the songs to my list */
if(isset($_POST['addition']) && $_POST['addition']=="Add"){                              /*check if something was selected*/
    echo"Song:";
    foreach($_POST['selected'] as $song){
        echo $song;
        unset($ztunes[$song]);                              /* remove the song from the array */

       # $ztunes = array_values($ztunes);
       # $ztunes = array_diff($ztunes, [$song]);
    }

   /* All_music(); */
}

?>
<!DOCTYPE html>
<html>
    <head>
        <p style="color:black;text-align:center"><font size="7">zMusic</font></p>    <!--This is for the title -->
    </head>
<body style="background-color:steelblue;"> </body>                                  <!--This is for the color of the background-->

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">                    <!-- this is to tell about which file -->
    <select multiple="mul" name="selected[]" >
        <?php
        echo Ztunes_options();
        ?>
        <input type="submit" value="Add" name="addition"/>
    </select>
</form>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">                    <!-- this is to tell about which file -->
        <select multiple="mul" name="selected[]" >
            <?php
            echo Zmazon_options();
            ?>
            <input type="submit" value="Add" name="addition"/>
        </select>
    </form>

</html>
