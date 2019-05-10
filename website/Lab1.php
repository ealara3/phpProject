<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 3/3/2019
 * Time: 10:38 PM
 */

#if($_SERVER['REQUEST_METHOD'] === 'POST') {
    #foreach($_POST['music'] as $song){
     #   echo $song." ".$_GET['add'];
       # $song.remove();
      #  echo "HELLO";
    #}
#}

$rUser = file('user.txt');

$Mmusic = $rUser[0].'Mmusic.txt';
$ztunes = $rUser[0].'ztunes.txt';
$playlist = $rUser[0].'playlist.txt';
$mymusic = $rUser[0].'mymusic.txt';
function buy($storeName, $file, $SelList){
    global $mymusic;
    $AllList = file($mymusic);
    $song = fopen($mymusic,'w');

    $options = '';
    foreach($AllList as $i){
        $options .= $i;
    }
    foreach ($SelList as $selectedSong) {
        $file = str_replace($selectedSong, '', $file);      #remove the option with the name
        #$options .= '<option value="'.$selectedSong.'">'.$selectedSong.'</option>';
        $options .= $selectedSong;
        #$song = str_replace('', ($selectedSong.'\n'),$song);

    }
    file_put_contents($storeName,$file);
    file_put_contents($mymusic, ($song));
    fwrite($song,($options));
    fclose($song);

}
function delete($fileName, $options){
    $file = file_get_contents($fileName);
    foreach($_POST[$options] as $song){
        $file = str_replace($song,'',$file);

    }
    file_put_contents($fileName,$file);
}

if(isset($_POST['Madd']) && $_POST['Madd']=='Add this zMazon') {                #add to my music from zmazon
    $file = file_get_contents($Mmusic);
    buy($Mmusic, $file, $_POST['Mmusic']);                      #call the method buy that remove the item

}
if(isset($_POST['Tadd']) && $_POST['Tadd']== 'Add this ztunes'){                #add to my music from ztunes
    $file = file_get_contents($ztunes);
    buy($ztunes, $file, $_POST['Tmusic']);
}
if(isset($_POST['rename']) && $_POST['rename'] == 'rename' ){                    #rename
    $reName = $_POST['change'];
    $file = file_get_contents($mymusic);
    foreach($_POST['Mymusic'] as $song){
        $file = str_replace($song,($reName."\n"),$file);
    }
    file_put_contents($mymusic,($file));

}if(isset($_POST['delete']) && $_POST['delete'] == 'delete'){

    delete($mymusic, 'Mymusic');

}if(isset($_POST['addtoList']) && $_POST['addtoList'] == 'addtoList' ){         #add to the playlist from the mylist
    $file = file($playlist);
    $fileList = fopen($playlist,'w');
    $options = '';
    foreach($file as $i){
        $options.=$i;
    }
    foreach ($_POST['Mymusic'] as $song) {
        $options .= $song;

    }

    fwrite($fileList,$options);
    fclose($fileList);

}if(isset($_POST['deleteFromList']) && $_POST['deleteFromList']=='deleteFromList'){
    delete($playlist, 'playlist');
}
if(isset($_POST['getUser']) && $_POST['getUser'] == 'getUser'){
    global $userName;
    $userName = $_POST['users'];
    echo $userName;


    #echo $userName;
}

    #$valSel = array();
    /*foreach ($_POST['Mmusic'] as $selectedSong) {
        $file = str_replace($selectedSong, '', $file);      #remove the option with the name

    }
    file_put_contents('Mmusic.txt',$file);*/

    #$file = fopen('Mmusic.txt','r');                           #read
    # $actuFile = fopen('Mmusic.txt', 'r');         #re-write
    #while(!feof($file)) {                                      #used to traverse the file
     #   $line = fgets($file);
        #echo $line;

       # }
        #if(!in_array($line, $valSel)){
         #  $newOptions .= '<option value="'.$line.'">'.$line.'</option>';
        #    echo $newOptions;
       # }
        #$isSelected = false;
    #}
    #$file.readline();
    #fwrite($file, "helloMusic");
    #fclose($file);




?>

<!DOCTYPE html>
<html>
<head>


    <p style="color:black;text-align:center"><font size="7">zMusic</font></p>    <!--This is for the title -->


</head>
<table>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</p>
<body style="background-color:steelblue;"> </body>                                  <!--This is for the color of the background-->
       <p> ZMazon</p>
<?php
    $song = file($Mmusic);
    $options = '';
    foreach($song as $music){
        $options .= '<option value="'.$music.'">'.$music.'</option>';
    }
    $Songs = '<select name = "Mmusic[]" multiple>'.$options.'';
    echo $Songs;
    #$but = '<input type="submit" value="Add this zMazon" name="Madd" id="MaddVal">';
    #echo $but;
?>
<!-- <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST"> -->
<!-- <select name="Mmusic[]" id="zmazon" multiple>
    <option value="zmazon1">zmazon1</option>
    <option value="zmazon2">zmazon2</option>
    <option value="zmazon3">zmazon3</option>
    <option value="zmazon4">zmazon4</option>-->

    <input type="submit" value="Add this zMazon" name="Madd" id="MaddVal"><br/>
        <p>zTunes</p>
    <?php
        $song = file($ztunes);
    $options = '';

    foreach($song as $music){
        $options .= '<option value="'.$music.'">'.$music.'</option>';
    }
    $Songs = '<select name = "Tmusic[]" multiple>'.$options.'';
    echo $Songs;
    #$but = '<input type="submit" value="Add this zMazon" name="Madd" id="MaddVal">';
    #echo $but;
    ?>
    <input type="submit" value="Add this ztunes" name="Tadd" id="TaddVal">
</select>
<br><td></p>
<!--<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">         mylist options-->
<!--select name="Mymusic[]" id="mymusic" multiple> -->
        <p>My Music</p>
    <?php
    $song = file($mymusic);
    $options = '';
    foreach($song as $music){
        $options .= '<option value="'.$music.'">'.$music.'</option>';
    }
    $Songs = '<select name = "Mymusic[]" multiple>'.$options.'';
    echo $Songs;
    #$but = '<input type="submit" value="Add this zMazon" name="Madd" id="MaddVal">';
    #echo $but;
    ?></td>

<td><br><br><br/>
    <input type="text" name="change" id="changeName" >
    <input type="submit" name="rename" value="rename" id="rename" ><br>


</select>
    <!-- <input type="text" id="search"> -->
    <input type="submit" name="delete" value="delete" id="delete"><br>
    <input type="submit" name="addtoList" value="addtoList" id="addtoList">
    </td></tr>
</p>

        <tr><td>PlayList</td> </tr>
        <td>
<?php
    $song = file($playlist);
    $options = '';
    foreach($song as $music){
        $options .= '<option value="'.$music.'">'.$music.'</option>';
    }
    $Songs = '<select name = "playlist[]" multiple>'.$options.'';
    echo $Songs;
    #$but = '<input type="submit" value="Add this zMazon" name="Madd" id="MaddVal">';
    #echo $but;
    ?>


<input type="submit" name="deleteFromList" value="deleteFromList" id="deleteFromList">
            </td>
        </tr>
</form>
</table>
</html>
<!--
<script type="text/javascript">

                                                        //This is jQuery used to remove the options if it is selected
    $(document).ready(function () {
        $('#MaddVal').click(
            function(){
                var x = $("#zmazon option:selected");
                alert(x.text()+" now is in your library");                        //show an alert if the song is adquired
                //x.text('HELLO'); used to change the name
                return !x.remove().appendTo("#mymusic");
            });
        $('#TaddVal').click(function(){
            var x = $('#ztunes option:selected');
            alert(x.text()+ " now is in your library");
            return x.remove().appendTo('#mymusic');
        });
        $('#rename').click(function () {
           var newName = $("#changeName") ;                            //the id of the text box
            var x = $('#mymusic option:selected');
            x.text(newName.val());                                     //.val() used to grab the text
            return !x;
        });
        //var x = document.getElementById("music");
        //var output = x.options[e.selectedIndex].value;
        //document.write(output);
        //$('#addVal').click( function(){  $("#music option[value='music1']").remove();})
    })</script> -->