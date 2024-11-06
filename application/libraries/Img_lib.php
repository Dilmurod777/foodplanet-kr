<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Img_lib { 
    var $file; 
    var $image_width; 
    var $image_height; 
    var $width; 
    var $height; 
    var $ext; 
    var $types = array('','gif','jpeg','png','jpg'); 
    var $quality = 80; 
    var $max_size = 150;
    var $top = 0; 
    var $left = 0; 
    var $crop = false; 
    var $type; 
    
    function init($name='') 
    { 
        $this->file = $name; 
        $info = getimagesize($name); 
        $this->image_width = $info[0]; 
        $this->image_height = $info[1]; 
        $this->type = $this->types[$info[2]]; 
        $info = pathinfo($name); 
        $this->dir = $info['dirname']; 
        $this->name = str_replace('.'.$info['extension'], '', $info['basename']); 
        $this->ext = $info['extension']; 
        if($this->image_width > $this->max_size && $this->image_height > $this->max_size) {
            $per = 100;
            if($this->image_width >= $this->image_height) {
                $per = $this->max_size/$this->image_height * 100;
            }
            else {
                $per = $this->max_size/$this->image_width * 100;
            }
            $this->width = round($this->image_width*($per/100)); 
            $this->height = round($this->image_height*($per/100)); 
        }
        else {
            $this->width = $this->image_width;
            $this->height = $this->image_height;
        }
    } 
    
    function save() 
    { 
        if($this->type=='jpeg' || $this->type == 'jpg') $image = imagecreatefromjpeg($this->file); 
        if($this->type=='png') $image = imagecreatefrompng($this->file); 
        if($this->type=='gif') $image = imagecreatefromgif($this->file); 

        $new_image = imagecreatetruecolor($this->width, $this->height); 
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $this->width, $this->height, $this->image_width, $this->image_height); 
        $name = $this->dir.DIRECTORY_SEPARATOR.$this->name.'.'.$this->ext; 

        if($this->type=='jpeg' || $this->type == 'jpg') {
            $exif = exif_read_data($this->file);
            if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']){
                    case 8 : $new_image = imagerotate($new_image,90,0); break;
                    case 3 : $new_image = imagerotate($new_image,180,0); break;
                    case 6 : $new_image = imagerotate($new_image,-90,0); break;
                }
            }
        }

        if($this->type=='jpeg' || $this->type == 'jpg') imagejpeg($new_image, $name, $this->quality); 
        if($this->type=='png') imagepng($new_image, $name); 
        if($this->type=='gif') imagegif($new_image, $name); 
        imagedestroy($image); 
        imagedestroy($new_image); 
    } 
} /* 사용방법 $re_image = new Image(이미지 파일명); $re_image -> width(200); $re_image -> height(300); $re_image -> save(); */ ?>
