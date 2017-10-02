<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $table = 'medias';

  public static function getMetaData ($file) {
    $img = \Image::make($file);
    $width = $img->width();
    $height = $img->height();

    return [
      'height' => $height,
      'width' => $width
    ];
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
