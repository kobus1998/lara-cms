<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
  protected $table = 'medias';

  public static function getImg($name, $size = 'original') {
    $result = '';

    if (strpos($name, '.gif') !== null) {
      $size = 'original';
    }

    switch ($size) {
      case 'thumbnail':
        $result = Storage::disk('image')->url('thumbnail-'.$name);
        break;
      case 'small':
        $result = Storage::disk('image')->url('small-'.$name);
        break;
      case 'medium':
        $result = Storage::disk('image')->url('medium-'.$name);
        break;
      case 'original':
        $result = Storage::disk('image')->url($name);
        break;
      default:
        $result = Storage::disk('image')->url($name);
        break;
    }

    return $result;
  }

  public static function getMetaData ($file) {
    $img = \Image::make($file);
    $width = $img->width();
    $height = $img->height();

    return [
      'height' => $height,
      'width' => $width
    ];
  }

  public static function resizeGif ($gif) {
    $gif = $gif->coalesceImages();

    foreach ($gif as $frame) {
      dd($frame);
      $frame->cropImage($crop_w, $crop_h, $crop_x, $crop_y);
      $frame->thumbnailImage($size_w, $size_h);
      $frame->setImagePage($size_w, $size_h, 0, 0);
    }
  }

  public static function makeThumbnail ($file, $type) {
    $img = \Image::make($file);

    $img->resize(50, null, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $img->response($type);
  }

  public static function makeSmall ($file, $type) {
    $img = \Image::make($file);

    $img->resize(250, null, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $img->response($type);
  }

  public static function makeMedium ($file, $type) {
    $img = \Image::make($file);

    $img->resize(500, null, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $img->response($type);
  }

  public static function makeFullHD ($file, $type) {
    $img = \Image::make($file);

    $img->resize(1920, null, function ($constraint) {
      $constraint->aspectRatio();
    });

    return $img->response($type);
  }

}
