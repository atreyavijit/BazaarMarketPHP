<?php
  session_start();
  date_default_timezone_set('America/Montreal');

  //MeekroDB Configuration
  DB::$user = 'ipd';
  DB::$password = 'ipdipd';
  DB::$dbName = 'bazaar';
  DB::$error_handler = true; // since we're catching errors

  //Monolog Configuration
  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;

  //Start Logger
  $log = new Logger('main_log');
  $log->pushHandler(new StreamHandler('log/main_log.log', Logger::INFO));

  // TWIG configuration
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  function is_logged_in() {
  	if(isset($_SESSION['id']) && $_SESSION['id'] != "") {
  		return true;
  	} else {
  		return false;
  	}
  }

  function is_admin() {
  	if(isset($_SESSION['id']) && $_SESSION['id'] != "" && $_SESSION['type'] == "Admin") {
  		return true;
  	} else {
  		return false;
  	}
  }

  function get_username() {
    if(isset($_SESSION['username']) && $_SESSION['username'] != "")
      return $_SESSION['username'];
  }
  //upload_file($_FILES['product_image'], $insert, 'product');

  function upload_file($fileArray, $insert, $table_name, $name){
    if ( isset( $fileArray[$name] ) ){
     // FILES variable exists

     if ( $fileArray[$name]['error'] == 0 ){
       //file was successfully uploaded

       // @ suppresses any errors/warnings/notices from a php function
       $extension = strtolower(@end(explode(".", $fileArray[$name]['name'])));

       $allowed_extensions = array("png", "gif", "jpg", "jpeg");
       if ( in_array( $extension, $allowed_extensions ) ){
         // file extensions is allowed

         //upload our file
         $file_name = explode(".", $fileArray[$name]['name'])[0] ."_".rand(0,9).rand(0,9).rand(0,9).rand(0,9);

         $tmpName = $file_name;
         $file_name .= "." . $extension;

         $new_array = array("photo" => $tmpName.'_400x400.'.$extension);
         $arrayMerge = array_merge($insert, $new_array);

         if ( move_uploaded_file( $fileArray[$name]['tmp_name'], "uploads/" . $file_name ) ){
           DB::insert($table_name, $arrayMerge);
           resize_and_crop("uploads/".$file_name, "uploads/".$tmpName.'_400x400.'.$extension, 400, 400);
         }else{
           $error = "An error has occured!";
         }
       } else {
         // file extension is not allowed
         $error = "File must be an image";
       }
     }else{
       //there was an error
         switch( $fileArray[$name]['error'] ){
           case 1 :	//UPLOAD_ERR_INI_SIZE
           case 2 : 	//UPLOAD_ERR_FORM_SIZE
             $error = "File size is too big";
             break;
           case 3 :	//UPLOAD_ERR_PARTIAL
           case 4 :	//UPLOAD_ERR_NO_FILE
             $error = "No file uploaded";
             break;
           case 6 :	//UPLOAD_ERR_NO_TMP_DIR
           case 7 :	//UPLOAD_ERR_CANT_WRITE
             $error = "Permission error";
             break;
           case 8 :	//UPLOAD_ERR_EXTENSION
           default :
             $error = "Blame PHP!!!";
          }
        }
      }
      // DB::insert('product', $insert);
    //Product name minimum length of 5

  }
  function upload_file_by_id_update($fileArray, $updateArray, $table_name, $name, $id){
    if ( isset( $fileArray[$name] ) ){
     // FILES variable exists

     if ( $fileArray[$name]['error'] == 0 ){
       //file was successfully uploaded

       // @ suppresses any errors/warnings/notices from a php function
       $extension = strtolower(@end(explode(".", $fileArray[$name]['name'])));

       $allowed_extensions = array("png", "gif", "jpg", "jpeg");
       if ( in_array( $extension, $allowed_extensions ) ){
         // file extensions is allowed

         //upload our file
         $file_name = explode(".", $fileArray[$name]['name'])[0] ."_".rand(0,9).rand(0,9).rand(0,9).rand(0,9);

         $tmpName = $file_name;
         $file_name .= "." . $extension;

         $new_array = array("photo" => $file_name);
         $arrayMerge = array_merge($updateArray, $new_array);

         if ( move_uploaded_file( $fileArray[$name]['tmp_name'], "uploads/" . $file_name ) ){
           DB::update($table_name, $arrayMerge, "id=%i", $id);
           resize_and_crop("uploads/".$file_name, "uploads/".$tmpName.'_400x400.'.$extension, 400, 400);
         }else{
           $error = "An error has occured!";
         }
       } else {
         // file extension is not allowed
         $error = "File must be an image";
       }
     }else{
       //there was an error
         switch( $fileArray[$name]['error'] ){
           case 1 :	//UPLOAD_ERR_INI_SIZE
           case 2 : 	//UPLOAD_ERR_FORM_SIZE
             $error = "File size is too big";
             break;
           case 3 :	//UPLOAD_ERR_PARTIAL
           case 4 :	//UPLOAD_ERR_NO_FILE
             $error = "No file uploaded";
             break;
           case 6 :	//UPLOAD_ERR_NO_TMP_DIR
           case 7 :	//UPLOAD_ERR_CANT_WRITE
             $error = "Permission error";
             break;
           case 8 :	//UPLOAD_ERR_EXTENSION
           default :
             $error = "Blame PHP!!!";
          }
        }
      }
      // DB::insert('product', $insert);
    //Product name minimum length of 5

  }

  function resize_and_crop($original_image_url, $thumb_image_url, $thumb_w, $thumb_h, $quality=75)
  {
      // ACQUIRE THE ORIGINAL IMAGE: http://php.net/manual/en/function.imagecreatefromjpeg.php
      $original = imagecreatefromjpeg($original_image_url);
      if (!$original) return FALSE;

      // GET ORIGINAL IMAGE DIMENSIONS
      list($original_w, $original_h) = getimagesize($original_image_url);

      // RESIZE IMAGE AND PRESERVE PROPORTIONS
      $thumb_w_resize = $thumb_w;
      $thumb_h_resize = $thumb_h;
      if ($original_w > $original_h)
      {
          $thumb_h_ratio  = $thumb_h / $original_h;
          $thumb_w_resize = (int)round($original_w * $thumb_h_ratio);
      }
      else
      {
          $thumb_w_ratio  = $thumb_w / $original_w;
          $thumb_h_resize = (int)round($original_h * $thumb_w_ratio);
      }
      if ($thumb_w_resize < $thumb_w)
      {
          $thumb_h_ratio  = $thumb_w / $thumb_w_resize;
          $thumb_h_resize = (int)round($thumb_h * $thumb_h_ratio);
          $thumb_w_resize = $thumb_w;
      }

      // CREATE THE PROPORTIONAL IMAGE RESOURCE
      $thumb = imagecreatetruecolor($thumb_w_resize, $thumb_h_resize);
      if (!imagecopyresampled($thumb, $original, 0,0,0,0, $thumb_w_resize, $thumb_h_resize, $original_w, $original_h)) return FALSE;

      // ACTIVATE THIS TO STORE THE INTERMEDIATE IMAGE
      // imagejpeg($thumb, 'RAY_temp_' . $thumb_w_resize . 'x' . $thumb_h_resize . '.jpg', 100);

      // CREATE THE CENTERED CROPPED IMAGE TO THE SPECIFIED DIMENSIONS
      $final = imagecreatetruecolor($thumb_w, $thumb_h);

      $thumb_w_offset = 0;
      $thumb_h_offset = 0;
      if ($thumb_w < $thumb_w_resize)
      {
          $thumb_w_offset = (int)round(($thumb_w_resize - $thumb_w) / 2);
      }
      else
      {
          $thumb_h_offset = (int)round(($thumb_h_resize - $thumb_h) / 2);
      }

      if (!imagecopy($final, $thumb, 0,0, $thumb_w_offset, $thumb_h_offset, $thumb_w_resize, $thumb_h_resize)) return FALSE;

      // STORE THE FINAL IMAGE - WILL OVERWRITE $thumb_image_url
      if (!imagejpeg($final, $thumb_image_url, $quality)) return FALSE;
      return TRUE;
  }

  function isValidNumber($num) {
    if(is_numeric($num) && isset($num) && $num > 0)
      return true;

    return false;
  }

  $twig->addGlobal("is_logged_in", is_logged_in());
  $twig->addGlobal("is_admin", is_admin());
  $twig->addGlobal("session", $_SESSION);
  $twig->addGlobal("get_username", get_username());


?>
