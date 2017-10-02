<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use \App\Media;

use Illuminate\Http\Request;

class MediaController extends Controller
{

  public function index (Request $req) {
    $search = app('request')->input('s');

    $medias = new Media;

    if ($search != null) {
      $medias = $medias::where('name', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
    } else {
      $medias = $medias::orderBy('created_at', 'desc');
    }
    $medias = $medias->paginate(15);
    // dd($medias);
    foreach ($medias as $media) {
      $image = '/public'.Storage::disk('local')->url($media->path);
      $media->url = $image;
    }

    return view('dashboard/media/index', [
      'images' => $medias,
      'navs' => [
        ['name' => 'Media', 'action' => action('MediaController@index'), 'active' => true],
      ]
    ]);
  }

  public function upload () {
    return view('dashboard/media/upload');
  }

  public function show ($id) {
    $media = Media::find($id);
    $media->original = Storage::disk('image')->url($media->original);
    $media->thumbnail = Storage::disk('image')->url($media->thumbnail);
    $media->small = Storage::disk('image')->url($media->small);
    $media->medium = Storage::disk('image')->url($media->medium);

    return view('dashboard/media/show', [
      'media' => $media,
      'navs' => [
        ['name' => 'Media', 'action' => action('MediaController@index'), 'active' => false],
        ['name' => $media->name, 'action' => action('MediaController@show', $media->id), 'active' => true],
      ]
    ]);
  }

  public function store (Request $req) {
    $files = $req['media'];

    foreach ($files as $file) {

      $originalName = $file->getClientOriginalName();
      $fileType = $file->getMimeType();
      $size = $file->getSize();

      $indexType = strripos($originalName, '.');
      $nameWithoutExtension = substr_replace($originalName, '', $indexType);
      $extensionType = substr_replace($originalName, '', 0, $indexType + 1);

      $name = $nameWithoutExtension;
      $slug = str_replace(' ', '-', $nameWithoutExtension);
      $slug = str_replace('.', '-', $slug);

      if (strpos($fileType, 'image') !== false) {

        $uploadedFile = Storage::disk('image')->put('', $file);
        $recentFile = Storage::disk('image')->url($uploadedFile);
        $meta = Media::getMetaData($recentFile);

        $thumbnailName = 'thumbnail-'.$uploadedFile;
        $thumbnail = Media::makeThumbnail($recentFile, $extensionType);
        $uploadedThumbnail = Storage::disk('image')->put($thumbnailName, $thumbnail->getContent());

        $smallName = 'small-'.$uploadedFile;
        $small = Media::makeSmall($recentFile, $extensionType);
        $uploadedSmall = Storage::disk('image')->put($smallName, $small->getContent());

        $mediumName = 'medium-'.$uploadedFile;
        $medium = Media::makeMedium($recentFile, $extensionType);
        $uploadedMedium = Storage::disk('image')->put($mediumName, $medium->getContent());

        $dbOptions = [
          'original' => $originalName,
          'type' => $fileType,
          'name' => $name,
          'slug' => $slug,
          'size' => $size,
          'width' => $meta['width'],
          'height' => $meta['height']
        ];

        $media = new Media;
        $media->name = $name;
        $media->path = $uploadedFile;
        $media->slug = $slug;

        $media->original_file_name = $originalName;
        $media->original = $uploadedFile;
        $media->thumbnail = $thumbnailName;
        $media->small = $smallName;
        $media->medium = $mediumName;

        $media->file_type = $fileType;
        $media->file_size = $size;
        $media->file_width = $meta['width'];
        $media->file_height = $meta['height'];

        $media->save();

      } else {
        $uploadedFile = Storage::disk('files')->put('', $file);
        $media = new Media;
        $media->name = $name;
        $media->path = $uploadedFile;
        $media->slug = $slug;

        $media->original_file_name = $originalName;

        $media->file_type = $fileType;
        $media->file_size = $size;

        $media->save();
      }


    }

    return back();
  }

  public function delete (Request $req) {

    $this->validate($req, [
      'images' => 'required'
    ]);

    $medias = Media::find($req->images);
    // dd($media);
    foreach ($medias as $image) {
      Storage::disk('local')->delete($image->path);
    }

    Media::destroy($req->images);

    return back();

  }

}
