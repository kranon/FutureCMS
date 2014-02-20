<?php $group=$_SESSION['group'];?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title;?></title>

    <!-- Le styles -->
    <link href="/core/admin_p/view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/core/admin_p/view/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />

    <link href="/core/admin_p/view/bootstrap/css/docs.css" rel="stylesheet">
    <link href="/core/admin_p/view/bootstrap/css/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->

   <!--  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.io/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png"> -->
    <!-- <link rel="shortcut icon" href="http://twitter.github.io/bootstrap/assets/ico/favicon.png">
 -->

 <style>

  span{
    margin-right: 5px;
  }
  #mess{
    position: fixed;
    left: 50%;
    z-index: 10;
    display:none;
  }
  .container-fluid{
    margin-top: 15px;
  }
  #menu{
    float: left;
    margin-left: -40px;
  }
  #name1{
    margin-left: 80px;
  }
  #name2{
    margin-left: 150px;
  }
  #in_menu{
    margin-left: 90px;
  }
  #link{
    margin-left: 160px;
  }
  #publ{
    margin-left: 5px;
  }
  #menu_del{
    margin-left: 5px;
  }
  #sortable{
    list-style: none;
  }
  .gallery_right{
    position: relative;
    float: right;
    font-size: 12px;
  }
  .gallery_del{
    float: right;
    margin-left: 20px;
    margin-top: -1px;
    margin-right: -13px;
  }
  .line,.album_line{
    border: #C5C5C5 solid 1px;
    margin: 5px;
    padding: 3px;
    padding-left: 40px;
    padding-right: 25px;
    min-width: 290px;
  }
  .line_head{
    border: #C5C5C5 solid 1px;
    margin: 5px;
    margin-left: 30px;
    border-radius: 3px;
    padding: 3px;
    padding-left: 10px;
  }
  .menu_id{
    position: absolute;
    margin-left: -30px;
    margin-top: 7px;
    display: block;
    width: 30px;
  }
  .in_menu{
    margin-left: 11px;
  }
  .publ{
    margin-left: 40px;
  }
  .menu_del{
    margin-left: 50px;
  }
  .ed{
    width: 35px;
  }
  .comment{
        position: relative;
        min-height: 60px;
        width: 100%;
        border: #C5C5C5 solid 1px;
        margin: 5px 0 5px 0;
        border-radius: 5px;
      }
      .comment form{
        width: 100%;
      }
      .com_text{
        position: absolute;
        top:22px;
        left:120px;
        width:100%;
      }
      .com_name_date{
        position: absolute;
        top:3px;
        left:120px;
        font-size: 0.8em;
      }
      .com_ava{
        margin: 5px;
      }
      .com_del{
        position: absolute;
        top:10px;
        right:10px;
      }
      .comm_news_submit{
        position: absolute;
        right:3px;
        top: 80px;
      }

 </style>

  <script type="text/javascript" src="../js/jquery.js"></script>
  <script type="text/javascript" src="view/bootstrap/js/bootstrap.min.js"></script>
  <!--<script type="text/javascript" src="view/bootstrap/js/bootstrap-tab.js"></script>--> 
  
  <script>
      // Выделение активного элемента меню
      $(document).ready(function(){
        $('.nav li').each(function (){
          if (this.getElementsByTagName("a")[0].href == location.href)
            this.className = "active";
        });
      });
    </script>
     
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar">

    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="brand">
              <a href="/" target="_blank">
                <i class="icon-eye-open icon-white"></i> Посмотреть сайт
              </a>            
              <div class="pull-right"><?php echo $logout;?></div>
          </div>
          <!-- <a class="brand" href="/">Посмотреть сайт</a> -->
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?php echo $menu;?>
            </ul>
          </div>
        </div>
      </div>
    </div>


  <div class="container-fluid">

    <div class="row-fluid">
      <div class="span12">
        <div id="mess" class="alert alert-success"></div>
        <div id="show_link" class="muted">
          <b><?php echo $header;?></b>
        </div>
      </div>
    </div>
    <?php
      switch($content){
// pages (all) ------------------------------------------------------------------------------
        case 'pages':?>
          <script type="text/javascript" src="controller/js/ajax_page.js"></script>
          <div class="row-fluid">
            <div class="span12">
              <form method="post" class="form well form-inline" action="controller/page_add.php" name="add_page" id="add_page">
                <fieldset>
                  <div class="span3">
                    <input type="text" name="name" class="in_text" placeholder="Имя страницы">
                  </div>
                  <div class="span2">
                  <label class="checkbox">
                    <input type="checkbox" name="add_in_menu" />&nbsp;Добавить в меню
                  </label>
                </div>
                <div class="span3">
                  <input type="submit" class="btn btn-success" id="add_page_sub" value="Создать страницу"/>
                </div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <form class="form-inline" enctype="multipart/form-data" action="controller/page_pub.php" method="post" name="page_pub" id="page_pub">
                <table class="table table-striped table-bordered">
                  <thead id="head">
                    <th><b>№</b></th>
                    <th><b>Редактирование</b></th>
                    <th><b>Ссылка</b></th>
                    <?php if ($group==1){?>
                    <th><b>В меню</b></th>
                    <th><b>Изменено</b></th>
                    <th><b>Del</b></th>
                    <?php }else{
                      echo '<th><b>Изменено</b></th>';
                    }?>
                  </thead>
                  <tbody id="tbody"></tbody>
                </table>
              </form>
            </div>

            
          </div>
        <?php break;
// news (all) ------------------------------------------------------------------------------
        case 'news':?>
          <script type="text/javascript" src="controller/js/ajax_news.js"></script>
          <div class="row-fluid">
          <div class="span12">
              <form method="post" class="form well form-inline" action="controller/add_news.php" name="add_news" id="add_news">
                <input type="text" name="caption" class="in_text" placeholder="Заголовок новости">
                <input type="submit" class="btn btn-success" id="add_news_sub" value=" Добавить новость ">
              </form>
            </div>
          </div>
          
          <div class="row-fluid">
            <div class="span12">
              <table class="table table-striped table-bordered">
                <thead>
                  <th><b>№</b></th>
                  <th><b>Редактирование</b></th>
                  <th><b>Комментариев</b></th>
                  <th><b>Дата</b></th>
                  <th><b>Удаление</b></th>
                </thead>
                <tbody id="tbody"></tbody>
              </table>
            </div>

            
          </div>
        <?php break;
// menu (admin) ------------------------------------------------------------------------------
        case 'menu':
          if ($group==1){?>
          <script type="text/javascript" src="controller/js/jquery-ui.js"></script>
          <script type="text/javascript" src="controller/js/ajax_menu.js"></script>
          <div class="row-fluid">
            <div class="span12">
            <form method="post" class="form form-inline well" action="controller/menu_add.php" name="add_menu" id="add_menu">
              <fieldset>
                <input type="text" name="name" class="in_text" placeholder="Имя меню">
                <input type="text" name="link" class="in_text" placeholder="Ссылка">
                <input type="text" name="in" placeholder="Вложено в">
                <label class="checkbox">
                  <input type="checkbox" name="publ">&nbsp;&nbsp;Опубликовать&nbsp;
                </label>
                <input type="submit" id="add_menu_sub" class="btn btn-success" value=" Добавить меню "/>
            </fieldset>
            </form>
          </div>
          </div>
          <div class="row-fluid">
            <div class="span12">
              <form class="form-inline" action="controller/menu_set.php" method="post" name="menu_pub" id="menu_pub">
                <div id="tbody_menu"></div>
              </form>
            </div>
          </div>
          
        <?php
        }
        else{
          header('Location: index.php');
          exit;
        }
        break;
// users (admin) ------------------------------------------------------------------------------
        case 'users':
          if ($group==1){?>
          <script type="text/javascript" src="controller/js/ajax_user.js"></script>
          <div class="row-fluid">
            <div class="span8">
              <i class="icon-user"></i> <span id="users_count"></span><br /><br />
              <form class="form-inline" action="controller/user_save.php" method="post" name="user_inf" id="user_inf">
                  <style>
                    .user{
                      position: relative;
                      border:1px solid gray;
                      border-radius: 5px;
                      width: 500px;
                      height: 118px;
                      background-color: #F5F5F5;
                      margin-bottom: 15px;
                    }
                    .user_foto{
                      float:left;
                      margin: 4px 10px 4px 4px;
                    }
                    .user_del_but_kran{
                      border-radius: 10px;
                      background: #F5F5F5;
                      padding-left: 2px;
                      position: relative;
                      top:-88px;
                      right:-10px;
                      float: right;
                      border:1px solid gray;
                      width: 17px;
                      height: 19px;
                    }
                    .user_del_but_kran:hover{
                      background-color: red;
                    }
                  </style>
                  <div id="users">
                  </div>
              </form>
            </div>
            <div class="span4">
              <?php
              $all = '<option value=1>Администратор</option><option value=2>Модератор</option><option value=3 selected>Пользователь</option>';
              include '../classes/auth.class.php';
              $word = $db->WordsTranslate('lang2');
              echo Auth::ShowRegForm($word,'controller/users_add.php');
            ?>
            </div>
          </div>
        <?php
        }
        else{
          echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
        }
        break;
// gallery (admin) ------------------------------------------------------------------------------
        case 'gallery':
          if ($group==1){?>
          <script type="text/javascript" src="controller/js/jquery-ui.js"></script>
          <script type="text/javascript" src="controller/js/ajax_gallery.js"></script>
          <div class="row-fluid">
            <div class="span7">
              <form class="form form-inline" action="controller/album_pub.php" method="post" name="gallery_ed">
                <div id="tbody_gallery"></div>
              </form>
            </div>

            <div class="span4">
              <form class="form well" method="post" action="controller/album_add.php" name="add_album" id="add_album">
                <input type="text" name="name" class="in_text" placeholder="Имя нового альбома">
                <input type="submit" class="btn btn-success" id="add_album_sub" value="Добавить альбом"/>
              </form>
            </div>
          </div>
        <?php
        }
        else{
          echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
        }
        break;
// settings (admin) ------------------------------------------------------------------------------
        case 'settings':if ($group==1){
          $main_page=file_get_contents('../html_templates/main_page_html.php');
          $other_page=file_get_contents('../html_templates/other_page_html.php');
          ?>
          <script type="text/javascript" src="controller/js/ajax_settings.js"></script>
          <script type="text/javascript">
            $(document).ready(function(){
              $('#tabSet').tabs();
              $('#tabSet2').tabs();
            });
          </script>
          <div class="row-fluid">
            <div class="span24">
              <ul id="tabSet">
                <li><a href="#lang1">Язык 1</a></li>
                <li><a href="#lang2">Язык 2</a></li>
              </ul>
              <div id="lang1">
                <b>Сайт:</b>
                <form method="post" action="#" name="edit_settings_lang1" id="edit_settings_lang1" class="form">
                Name:<br />
                <input type="text" name="site_name_lang1" id="site_name_lang1" /><br />
                Header:<br />
                <textarea name="site_header_lang1" rows="4" class="span4" id="site_header_lang1"></textarea><br />
                Footer:<br />
                <textarea name="site_footer_lang1" rows="4" class="span4" id="site_footer_lang1"></textarea><br />
                <br />
                <b>Мета теги:</b><br />
                Title:<br />
                <textarea name="meta_title_lang1" rows="4" class="span4" id="meta_title_lang1"></textarea><br />
                Keywords:<br />
                <textarea name="meta_keywords_lang1" rows="4" class="span4" id="meta_keywords_lang1"></textarea><br />
                Description:<br />
                <textarea name="meta_description_lang1" rows="4" class="span4" id="meta_description_lang1"></textarea><br />
                </form>
              </div>
              <div id="lang2">
                <b>Сайт:</b>
                <form method="post" action="#" name="edit_settings_lang2" id="edit_settings_lang2" class="form">
                Name:<br />
                <input type="text" name="site_name_lang2" id="site_name_lang2"><br />
                Header:<br />
                <textarea name="site_header_lang2" rows="4" class="span4" id="site_header_lang2"></textarea><br />
                Footer:<br />
                <textarea name="site_footer_lang2" rows="4" class="span4" id="site_footer_lang2"></textarea><br />
                <br />
                <b>Мета теги:</b><br />
                Title:<br />
                <textarea name="meta_title_lang2" rows="4" class="span4" id="meta_title_lang2"></textarea><br />
                Keywords:<br />
                <textarea name="meta_keywords_lang2" rows="4" class="span4" id="meta_keywords_lang2"></textarea><br />
                Description:<br />
                <textarea name="meta_description_lang2" rows="4" class="span4" id="meta_description_lang2"></textarea><br />
                </form>
              </div><br />
            </div>
            <div class="span16">
              <ul id="tabSet2">
                <li><a href="#main_html">HTML-шаблон главной страницы</a></li>
                <li><a href="#other_html">HTML-шаблон остальных страниц</a></li>
              </ul>
              <form method="post" action="#" name="edit_settings_html" id="edit_settings_html" class="form">
                <div id="main_html">
                  <textarea rows="36" class="span7" name="main_html_data" id="main_html_data" ><?php echo $main_page;?></textarea>
                </div>
                <div id="other_html">
                  <textarea rows="36" class="span7" name="other_html_data" id="other_html_data"><?php echo $other_page;?></textarea>
                </div><br />
                <input type="button" class="btn btn-success" id="save_btn" value="Сохранить" />
              </form>
            </div>
          </div>
        <?php
        }
        else{
          echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
        }
        break;
// album (admin) ------------------------------------------------------------------------------
        case 'album':
          if ($group==1){
          $album_id=$_GET['id'];
          $sql="SELECT `name_lang1`,`name_lang2`,`link`,`album_year` FROM `gallery` WHERE `id`=".$album_id;
          $result = $db->query($sql);
          while ($row = mysql_fetch_array($result)){
            $album_data=array(
              'name_lang1'=>$row['name_lang1'],
              'name_lang2'=>$row['name_lang2'],
              'album_year'=>$row['album_year'],
              'link'=>$row['link']
            );
          }
          $mas=$db->OpenAlbum($album_id,'../../');
          $n=(int)count($mas);?>

          <link rel="stylesheet" href="/core/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
          <!--<link rel="stylesheet" type="text/css" href="../lightBox/css/jquery.lightbox-0.5.css" media="screen" />-->
          <style type="text/css">
            /* jQuery lightBox plugin - Gallery style */
            .box{
              padding: 0px;
              width: 100%;
            }
            .box ul{
              list-style: none;
              margin: 0px;
            }
            .box ul img{
              border: 5px solid #fff;/*Цвет рамки вокру фото*/
              /*border-width: 5px 5px 5px;
              margin: 2px;*/
            }
            .box ul a:hover img{
              border: 5px solid #0088CC;/*Цвет рамки вокру фото при наведении*/
              /*border-width: 5px 5px 5px;*/
              color: #fff;
            }
            .box ul a:hover{
              color: #fff;
            }
            .box{
              width:100px;
            }
            .table th{
              text-align: center;
            }
          </style>
          <script type="text/javascript" src="controller/js/ajax_album.js"></script>
          <!--<script type="text/javascript" src="../lightBox/js/jquery.lightbox-0.5.min.js"></script>-->
          <script type="text/javascript" src="/core/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
          <script type="text/javascript" src="/core/fancybox/jquery.fancybox.pack.js"></script>
          <script type="text/javascript">
            $(document).ready(function(){
              $('.box a').fancybox();
            });
          </script>
          <div class="row-fluid">
            <div class="span3 well">
              <p><b>Список альбомов:</b></p>
              <?php
              $sql="SELECT `id`,`name_lang1` FROM `gallery` ORDER BY `num`";
              $result = $db->query($sql);
              $i=1;
              while ($row = mysql_fetch_array($result)) {
                echo '<a href="?content=album&id='.$row['id'].'">'.$i.' - '.$row['name_lang1'].'</a><br />';
                $i++;
              }
              ?>
            </div>
            <div class="span5">
            <?php
            if ($n>0){?>
              <i class="icon-picture"></i> Всего фотографий: <?php echo $n;?>
              <table class="table table-striped table-bordered">
                <thead>
                  <th><b>Фото</b></th>
                  <th><b>Имя файла</b></th>
                  <th><b>Удалить</b></th>
                </thead>
                <tbody>
                  <?php
                    foreach($mas as $fileName){
                      echo '<tr><td class="box"><a rel="foto" title="'.$fileName.'" href="../../../gallery/'.$album_data['link'].'/'.$fileName.'"><img src="../../../gallery/'.$album_data['link'].'/thumbs/'.$fileName.'"></a></td>
                      <td align="center">'.$fileName.'</td>
                      <td align="center"><a href="controller/foto_del.php?album='.$album_data['link'].'&name='.$fileName.'">Удалить</a></td></tr>';
                    }
                  ?>
                </tbody></table>
            <?php }?>

            </div>
            <div class="span4">
              <form class="well form" method="post" action="controller/album_set.php" name="edit_album" id="edit_album" class="form">
                <input type="text" placeholder="Язык 1" name="name_lang1" value="<?php echo $album_data['name_lang1'];?>"><br />
                <input type="text" placeholder="Язык 2" name="name_lang2" value="<?php echo $album_data['name_lang2'];?>"><br />
                <input type="text" placeholder="Год альбома" name="album_year" value="<?php echo $album_data['album_year'];?>"><br />
                <input type="hidden" name="id" value="<?=$album_id;?>">
              </form>
              <div class="well">
                <script type="text/javascript">
                  /*$(document).ready(function(){
                    $('#file_upload').uploadify({
                      'uploader'  : 'controller/uploadify/uploadify.swf',
                      'script'    : 'controller/foto_load.php?link=<?=$album_data['link']?>',
                      'cancelImg' : 'controller/uploadify/cancel.png',
                      'folder'    : 'controller/uploads',
                      'auto'      : true,
                      'multi'     : true,
                      'fileDesc'  : 'Images (jpg, jpeg)',
                      'fileExt'   : '*.jpeg;*.jpg;*.JPG;'
                    });
                  });*/
                </script>
                <input id="file_upload" type="file" name="file_upload" />
              </div>
            </div>
          </div>
        <?php
        }
        else{
          echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
        }
        break;
// page_edit (all) ------------------------------------------------------------------------------
        case 'page_edit':
          $id = intval($_GET['id']);
          $sql = "SELECT `lang1`,`lang2`,`text_lang1`,`text_lang2`,`link`, `edit_date` FROM `page` WHERE `id` = '".$id."'";
          $result = $db->query($sql);
          while ($row = mysql_fetch_array($result)) {
            $text = array(
              'lang1' => htmlspecialchars_decode($row['text_lang1'], ENT_QUOTES),
              'lang2' => htmlspecialchars_decode($row['text_lang2'], ENT_QUOTES)
            );
            $name = array(
              'lang1' => htmlspecialchars_decode($row['lang1'], ENT_QUOTES),
              'lang2' => htmlspecialchars_decode($row['lang2'], ENT_QUOTES)
            );
            $link = $row['link'];
            $edit_date = $row['edit_date'];
          }
          include '../../fckeditor/fckeditor_php5.php';
            ?>
          <div class="row-fluid">
            <div class="span12">
              <div id="show_link">
                <div>
                  <a href="?content=pages"><b>Страницы</b></a> <span class="muted"><b>></b></span><a href="../../<?=$link?>" target="_blank"><b><?=$name['lang1']?></b></a>
                  <div id="edit_date"><b>Дата изменения:</b> <span class="muted"><?=$edit_date?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function() {
              $('#tabSet a:first').tab('show');
              $('a[data-toggle="tab"]').on('shown', function (e) {
                e.target // activated tab
                e.relatedTarget // previous tab
              })
            });
          </script>

          <div class="row-fluid">
            <div class="span3 well">
              <p><b>Список страниц:</b></p>
              <?php
                $sql="SELECT `id`,`lang1` FROM `page` ORDER BY `lang1` ASC;";
                $result = $db->query($sql);
                $i=1;
                while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                  echo '<a href="?content=page_edit&id='.$row['id'].'">'.$i.' - '.$row['lang1'].'</a><br />';
                  $i++;
                }
              ?>
            </div>
            <div class="span9">
              <form  method="post" name="about" id="about" action="controller/page_data_edit.php">
                <ul class="nav nav-tabs" id="tabSet">
                  <li><a href="#lang1" data-toggle="tab">Язык 1</a></li>
                  <li><a href="#lang2" data-toggle="tab">Язык 2</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="lang1">
                    <p>Имя страницы:</p>
                    <textarea name="name_lang1" rows="2" class="span9"><?php echo $name['lang1'];?></textarea><br /><br />
                    
                    <?php
                      $dd_lang1 = new FCKeditor("editor_lang1");
                      $dd_lang1->Config['SkinPath'] = '../../fckeditor/editor/skins/office2003/';
                      $dd_lang1->Value = $text['lang1'];
                      $dd_lang1->Create();
                    ?>
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                  </div>
                  <div class="tab-pane" id="lang2">
                    <p>Имя страницы:</p>
                    <textarea name="name_lang2" rows="2" class="span8"><?php echo $name['lang2'];?></textarea><br /><br />
                    <?php
                      $dd_lang2 = new FCKeditor("editor_lang2");
                      $dd_lang2->Config['SkinPath'] = '../../fckeditor/editor/skins/office2003/';
                      $dd_lang2->Value = $text['lang2'];
                      $dd_lang2->Create();
                    ?>
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                  </div>
                </div><br />
                <p><input type="submit" id="addText" class="btn btn-success" value="Сохранить" /></p>
              </form>
            </div>
          </div>
        <?php break;
// news_edit (all) ------------------------------------------------------------------------------
        case 'news_edit':
          $id = intval($_GET['id']);
          $sql="SELECT `caption_lang1`,`text_lang1`,`caption_lang2`,`text_lang2` FROM `news` WHERE `id` = ".$id.";";
          $result = $db->query($sql);
          while ($row = mysql_fetch_array($result)){
            $text = array(
              'lang1'=>$row['text_lang1'],
              'lang2'=>$row['text_lang2']
            );
            $caption = array(
              'lang1'=>$row['caption_lang1'],
              'lang2'=>$row['caption_lang2']
            );
          }
          include '../../fckeditor/fckeditor_php5.php';
          ?>
          <script type="text/javascript">
            $(document).ready(function(){
              $('#tabSet a:first').tab('show');
              $('a[data-toggle="tab"]').on('shown', function (e) {
                e.target // activated tab
                e.relatedTarget // previous tab
              })
            });
          </script>
          <div class="row-fluid">
            <div class="span12">
              <div id="show_link">
                <?php echo '<div><a href="?content=news"><b>Новости</b></a> <span class="muted"><b>></b></span><a href="../../read_news.php?id='.$id.'"><b>'.$caption['lang1'].'</b></a>';?>
              </div>
            </div>
          </div><br />
          <div class="row-fluid">
            <div class="span3 well">
              <p><b>Список новостей:</b></p>
              <?php
                $sql="SELECT `id`,`caption_lang1` FROM `news` ORDER BY `id` DESC";
                $result = $db->query($sql);
                $i=1;
                while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
                  echo '<a href="?content=news_edit&id='.$row['id'].'">'.$i.' - '.$row['caption_lang1'].'</a><br />';
                  $i++;
                }
              ?>
            </div>
            <div class="span9">
              <ul class="nav nav-tabs" id="tabSet">
                <li><a href="#lang1" data-toggle="tab">Язык 1</a></li>
                <li><a href="#lang2" data-toggle="tab">Язык 2</a></li>
              </ul>
              <form method="post" name="about" id="about" action="controller/news_edit_data.php">
                <div class="tab-content">
                  <div class="tab-pane" id="lang1">
                    <p>Заголовок:</p>
                    <textarea name="caption_lang1" rows="3" class="span8"><?php echo $caption['lang1'];?></textarea><br /><br />
                    <?php
                    $dd = new FCKeditor("editor_lang1");
                    $dd->Config['SkinPath'] = '../../fckeditor/editor/skins/office2003/';
                    $dd->Value = $text['lang1'];
                    $dd->Create();
                    ?>
                    <input type="hidden" name="id" value=<?php echo $id;?> />
                  </div>
                  <div class="tab-pane" id="lang2">
                    <p>Заголовок:</p>
                    <textarea name="caption_lang2" rows="3" class="span8"><?php echo $caption['lang2']?></textarea><br /><br />
                    <?php
                    $dd2 = new FCKeditor("editor_lang2");
                    $dd2->Config['SkinPath'] = '../../fckeditor/editor/skins/office2003/';
                    $dd2->Value = $text['lang2'];
                    $dd2->Create();
                    ?>
                    <input type="hidden" name="id" value=<?php echo $id;?> />
                  </div>
                </div><br />
                <p><input class="btn btn-success" type="submit" id="addText" value="Сохранить" /></p>
              </form>
              <p><i class="icon-comment"></i> <b>Комментарии:</b></p>
              <?php
              $mas=$db->commentRead($id);
              if (isset($mas)){
                foreach ($mas as $val){?>
                  <div class="comment">
                    <div class="com_ava">
                      <a href="O_polzovatele.php?login=<?php echo $val['users_login'];?>"><img src="/avatars/<?php echo $val['users_ava'];?>" /></a>
                    </div>
                    <div class="com_name_date">
                      <a href="O_polzovatele.php?login=<?php echo $val['users_login'];?>">
                        <span class="com_username"><?php echo $val['users_login'];?></span>
                      </a> |
                      <span class="com_date"><?php echo $val['datetime'];?></span>
                    </div>
                    <span class="com_del"><a href="controller/news_comment_del.php?id=<?php echo $val['id'];?>" class="news_comment_del"><i class="icon-trash"></i></a></span>
                    <form class="form" action="controller/news_comment_edit.php" method="post">
                      <span class="com_text"><textarea rows="4" class="span9" name="text"><?php echo $val['text'];?></textarea></span>
                      <input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
                      <input type="submit" class="btn btn-success comm_news_submit" value="OK"/>
                    </form>
                  </div><?php
                }
              }?>
            </div>
          </div>
        <?php break;
        case 'user_edit':
          $login = $_GET['login'];
          $sql = "SELECT `login`,`email`,`group`,'sex',`datreg`,`ava` FROM `users` WHERE `login`= '$login'";
          $result = $db->query($sql);
          while ($row = mysql_fetch_array($result)){
            $user = $row;
          }

          $sql = "SELECT `id`, `lang1`, `lang2` FROM `role`";
          $result = $db->query($sql);
          while ($row = mysql_fetch_array($result)){
            $rol[$row['id']] = $row['lang1'];
            $all .= '<option value='.$row['id'].'>'.$row['lang1'].'</option>';
          }
          $num_mas = sizeof($rol);

          $els = '';
          for ($n = 1; $n <= $num_mas; $n++){
            $now = '<option value='.$row['group'].'>'.$rol[$row['group']].'</option>';
            if ($rol[$row['group']] != $rol[$n]){
              $els .= '<option value='.$n.'>'.$rol[$n].'</option>';
            }
          }
          $gr = '<select name='.$row['id'].'>'.$now.$els.'</select>';



          if ($user['sex'] == 'men'){
            $user['sex'] = 'Мужской';
          }
          else{
            $user['sex'] = 'Женский';
          }
        ?>
          <div class="row-fluid">
            <div class="span2">
              <img src="/avatars/<?=$user['ava']?>">
            </div>
            <div class="span8">
              <b>Логин:</b> <?=$user['login']?> <br />
              <b>E-mail:</b> <?=$user['email']?> <br />
              <b>Пол:</b> <?=$user['sex']?> <br />
              <b>Дата регистрации:</b> <?=$user['datreg']?> <br />
              <b>Группа:</b> <?=$gr?> <br />
              <a href="controller/genNewPass.php?login=<?=$user['login']?>">Сгенерировать новый пароль</a> <br />
            </div>
          </div>
          
        <?break;
        default :?>
        <div class="row-fluid">
          <div class="span12">
            <p>Панель администратора позволяет добавлять, удалять и редактировать страницы, меню и информация о пользователях и многое другое.</p>
            <p>Для начала работы выберите необходимый пункт меню.</p>
          </div>
        </div>
        <?}?>
      </div>
    



    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <?php echo $footer;?>
      </div>
    </footer>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/jquery.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-transition.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-alert.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-modal.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-scrollspy.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-tab.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-popover.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-button.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-collapse.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-carousel.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-typeahead.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/bootstrap-affix.js"></script>

    <script src="http://twitter.github.io/bootstrap/assets/js/holder/holder.js"></script>
    <script src="http://twitter.github.io/bootstrap/assets/js/google-code-prettify/prettify.js"></script>

    <script src="http://twitter.github.io/bootstrap/assets/js/application.js"></script>
  -->
  </body>
</html>
