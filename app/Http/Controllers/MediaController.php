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
    $image = Storage::disk('local')->url($media['path']);
    $media['url'] = '/public/'.$image;
    return view('dashboard/media/show', [
      'media' => $media,
      'navs' => [
        ['name' => 'Media', 'action' => action('MediaController@index'), 'active' => false],
        ['name' => $media->name, 'action' => action('MediaController@show', $media->id), 'active' => true],
      ]
    ]);
  }

  public function store (Request $req) {

    // dd($req);

    $files = $req['media'];
    // dd($files);
    foreach ($files as $file) {

      $originalName = $file->getClientOriginalName();

      $fileType = $file->getMimeType();

      $slug = str_replace('.', '-', $originalName);
      $slug = str_replace(' ', '-', $slug);

      $size = $file->getSize();

      $indexType = strripos($originalName, '.');
      $nameWithoutExtension = substr_replace($originalName, '', $indexType);
      $extensionType = substr_replace($originalName, '', 0, $indexType + 1);
      $name = $nameWithoutExtension;

      if (strpos($fileType, 'image') !== false) {

        $uploadedFile = Storage::disk('image')->put('', $file);
        $recentFile = Storage::disk('image')->url($uploadedFile);
        dd($recentFile);
        // $thumbnailName = str_replace('public/', 'thumbnail-', $uploadedFile);
        //
        // $thumbnail = Media::makeThumbnail($recentFile, $extensionType);
        // $uploadedThumbnail = Storage::disk('local')->put('public/'.$thumbnailName, $thumbnail->getContent());

        // $small = Media::makeSmall($recentFile, $extensionType);
        // dd($small);

      } else {
        echo 'no image';
      }

      dd($uploadedFile);



      dd($file, [
        'original' => $originalName,
        'type' => $fileType,
        'name' => $name,
        'slug' => $slug,
        'size' => $size
      ]);



      // $media = new Media;
      // $media['name'] =
      // $media['path'] = $currentFile;
      // $media['slug'] = $file->hashName();
      // $media->save();
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
