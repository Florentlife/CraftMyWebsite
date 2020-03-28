<?php
require('UUIDHelper.class.php');

/* 
 * ex: src='include/SkinApi/skin.php?p=Steve&type=body&size=5
 * 
 * type: optionnel, default: body
 * size: optionnel, default: 3
 * 
 */

if(isset($_GET['p']))
{
    $pseudo = $_GET['p'];
    $size = 128;
    $type = isset($_GET['type']) ? $_GET['type'] : 'body';
    
    $api = new UUIDHelper($pseudo);
    $file = './cache/'.$pseudo.'_'.$type.'_size_'.$size.'.png';
    if(!file_exists("./cache/"))
    {
        mkdir("./cache/", 0777, true);
    }
    
    if($api->isApiEnable() && !CheckCache($file))
    {
        $url = @imagecreatefrompng($api->url);
        if($type == 'body') 
        {
            /**
            * @author Mapcrafter <mapcrafter.org>
            * @link https://github.com/mapcrafter/mapcrafter-playermarkers/blob/c583dd9157a041a3c9ec5c68244f73b8d01ac37a/playermarkers/player.php#L8-L19
			* (body only)
            */ 
			$size = $size/16;
            $img = imagecreatetruecolor(16, 32);
            imagealphablending($img, false);
            imagesavealpha($img, true);
            imagefill($img, 0, 0, imagecolorallocatealpha($img, 255, 0, 255, 127));
            imagecopy($img, $url, 4, 0, 8, 8, 8, 8);                      //Head
            imagecopy($img, $url, 4, 8, 20, 20, 8, 12);                   //Body
            imagecopy($img, $url, 0, 8, 44, 20, 4, 12);                   //Arm-L
            imagecopyresampled($img, $url, 12, 8, 47, 20, 4, 12, -4, 12); //Arm-R
            imagecopy($img, $url, 4, 20, 4, 20, 4, 12);                   //Leg-L
            imagecopyresampled($img, $url, 8, 20, 7, 20, 4, 12, -4, 12);  //Leg-R
            imagealphablending($img, true);
            imagecopy($img, $url,   4, 0, 40, 8, 8, 8);                   //Hat
            $img_big = imagecreatetruecolor(16*$size, 32*$size);
            imagealphablending($img_big, false);
            imagesavealpha($img_big, true);
            imagecopyresampled($img_big, $img, 0, 0, 0, 0, 16*$size, 32*$size, 16, 32);
            imagepng($img_big, $file);
            header('Location:'.$file);
            die();
        } else  if($type == 'head') {
            $img = imagecreatetruecolor($size, $size);
            imagealphablending($img_big, false);
            imagesavealpha($img_big, true);
            imagecopyresampled($img, $url, 0, 0, 8, 8, $size, $size, 8, 8);
            imagepng($img, $file);
            header('Location:'.$file);
            die();
        }
    } else if(file_exists($file)){
        header('Location:'.$file);
        die();
    } else {
		header('Location:./_default_'.$type.'_size_128.png');
        die();
	}
}

function CheckCache($file) 
{

    return file_exists($file) && filemtime($file) > time() - 86400;
}

?>
