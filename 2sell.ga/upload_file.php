<?php
　if ($_FILES["file"]["error"] > 0){
　　echo "Error: " . $_FILES["file"]["error"];
　}else{
　　echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
　　echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
　　echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
　　echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
　　move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);　//移動檔案


$f_name = "upload/test-32.jpg";
//取得原始檔資訊,並且呼叫圖檔
$gs = GetImageSize("$f_name");

if ($gs[2] == 1){$img1= ImageCreateFromGIF("$f_name");}
else if($gs[2] == 2){$img1= ImageCreateFromJPEG("$f_name");}
else if($gs[2] == 3){$img1= ImageCreateFromPNG("$f_name");}

//開新圖範圍,並且置入縮小後的影像
$img2 = ImageCreatetruecolor(400, 200);
ImageCopyResized($img2, $img1, 0, 0, 0, 0, 400, 200, $gs[0], $gs[1]);

// 覆蓋原始圖檔並且釋放記憶體
if($gs[2] == 1){ImageGIF($img2,$f_name);}
else if($gs[2] == 2){ImageJPEG($img2,$f_name,90);}
else if($gs[2] == 3){ImagePNG($img2,$f_name);}

ImageDestroy($img1);
ImageDestroy($img2);
　}

?>
