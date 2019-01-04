<?php
function save_all_pic($sn,$pic_name,$dir,$sel,$image_x,$image_y)
{
    include_once "class/upload/class.upload.php";
    $pic = new Upload($_FILES[$pic_name], 'zh_TW');
    //$pic = new Upload($_FILES['news_pic'], 'zh_TW');
    
    if ($pic->uploaded) {
        //大圖
        $pic->file_new_name_body = $sn;
        $pic->file_overwrite     = true;
        if ($sel != ''){
          $pic->image_resize       = true;
          $pic->image_x            = $image_x;
          $pic->image_y            = $image_y;
        }
        $pic->image_convert      = 'jpg';
        //$pic->image_ratio_crop   = true;
        $pic->Process($dir);
        if (!$pic->processed) {
            return 'error : ' . $pic->error;
        }
    }
}

function convert_to_html($sText)
{  
   /* 幾個和html轉換有關的函式
    * addslashes() 在特定的符號前加反斜線 (包括 ' " \ 及 NULL)
     (使用get_magic_quotes_gpc() 檢查，若為真，則不能再次使用 addslashes)
    * stripslashes() 刪除由addslashes() 函式增加的反斜線
    * htmlspecialchars() 轉換下表的五個符號
    * htmlentities() 除了轉換下表的五個符號, 也轉換中文 (速度慢)
    * htmlspecialchars_decode() 是htmlspecialchars的反函式
    * html_entity_decode() 是htmlentities的反函式
    * mysql_real_escape_string() 轉換在SQL指令中使用的特殊符號 (包括 x00 \n \r ' " x1a)   
   -----------------------------------------
     & (ampersand)     &amp;
     " (double quote)  &quot;
     ' (single quote)  '&#039; or &apos;
     < (less than)     &lt;
     > (greater than)  &gt;
   -----------------------------------------
   */
   $_str = $sText;
    
   $_str = htmlspecialchars($_str, ENT_QUOTES, 'UTF-8');
   //$_str = preg_replace("/&amp;#([[:alnum:]]{3,5});/is","&#\\1;",$_str);
   //$_str = preg_replace("/&amp;([[:alpha:]]{2,7});/is","&\\1;",$_str);
   //$_str = str_replace("\"","&quot;",$_str);
   //$_str = str_replace("'","&#39;",$_str);

   return $_str;
}
//可根據指定資料類型來過濾變數
function my_filter($var, $type = "int")
{
    switch ($type) {
        case 'string':
            $var = isset($var) ? filter_var($var, FILTER_SANITIZE_MAGIC_QUOTES) : '';
            break;
        case 'url':
            $var = isset($var) ? filter_var($var, FILTER_SANITIZE_URL) : '';
            break;
        case 'email':
            $var = isset($var) ? filter_var($var, FILTER_SANITIZE_EMAIL) : '';
            break;
        case 'int':
        default:
            $var = isset($var) ? filter_var($var, FILTER_SANITIZE_NUMBER_INT) : '';
            break;
    }

    return $var;
}

//取得商品圖片


function get_all_pic($all_sn = '', $type)
{
    $filename = "uploads/{$type}/{$all_sn}.jpg";
    if (file_exists($filename)) {
        return $filename;
    } else {
        return "";
    }
}


