<?php

if(isset($_POST)):
$json = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
$skin = '';
$champ = '';
$c = 0;
$s = 0;

$jsdea = json_decode($json,true);
foreach ($jsdea['catalog'] as $jsde){
	
if ($jsde['Item']['inventory_type'] == "CHAMPION_SKIN" && $jsde['Item']['is_owned'] == 1):
 $skin = $skin. '|'.$jsde['Item']['id'].'='.$jsde['Item']['name'];
 $s++;
 endif;
 if ($jsde['Item']['inventory_type'] == "CHAMPION" && $jsde['Item']['is_owned'] == 1):
	$champ = $champ.'|'.$jsde['Item']['id'].'-'.$jsde['Item']['name'];
	$c++;
	endif;
}

$skin = ltrim($skin,'|');
$champ = ltrim($champ,'|');
$champ = str_replace('champions_','',$champ);
endif;
?>

Champions : <?=$c;?><br> <textarea rows="4" cols="50">
<?=$champ?>
</textarea>
<br>
Skins : <?=$s;?><br><textarea rows="4" cols="50">
<?=$skin?>
</textarea>
<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>

</body>
</html>
