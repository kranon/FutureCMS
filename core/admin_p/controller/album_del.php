<?php
// Удаление альбома
include "../../config.php";
// Рекурсивное удаление каталога (со всеми файлами внутри)
function RemoveDir($path){
        if(file_exists($path) && is_dir($path)){
            $dirHandle = opendir($path);
            while (false !== ($file = readdir($dirHandle))){
                if ($file!='.' && $file!='..'){// исключаем папки с назварием '.' и '..'
                    $tmpPath = $path.'/'.$file;
                    //chmod($tmpPath, 0777);

                    if (is_dir($tmpPath)){  // если папка
                        RemoveDir($tmpPath);
                    }
                    else{
                        if(file_exists($tmpPath)){
                            unlink($tmpPath);// удаляем файл
                        }
                    }
                }
            }
            closedir($dirHandle);
            // удаляем текущую папку
            if(file_exists($path)){
                rmdir($path);
            }
        }
        else{
            echo "Удаляемой папки не существует или это файл!";
        }
    }

$id = intval($_GET['id']);
$sql = "SELECT `link` FROM `gallery` WHERE `id` = $id";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$link = $row['link'];
}

if ($link){
    $DeletedFolder = $_SERVER['DOCUMENT_ROOT'].'/gallery_img/'.$link;
    RemoveDir($DeletedFolder);
}

if ($id > 0){
	$db->AlbumDel($id);
}

echo '1';
?>
