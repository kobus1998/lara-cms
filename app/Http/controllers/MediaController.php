<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use \App\Media;

use Illuminate\Http\Request;

class MediaController extends Controller
{

  public function index () {
    $medias = Media::get();
    $images = [];
    // dd($medias);
    foreach ($medias as $media) {
      $image = Storage::disk('local')->url($media->path);
      array_push($images, [
        'id' => $media['id'],
        'name' => $media['name'],
        'url' => $image
      ]);
    }

    // dd($images);
    return view('dashboard/media/index', ['images' => $images]);
  }

  public function store (Request $req) {
    $this->validate($req, [
      // 'name' => 'required',
      // 'media' => 'required'
    ]);

    $files = $req['media'];
// dd($files);
    foreach ($files as $file) {

      $currentFile = $file->store('public');
      // dd($file);
      // $file = $file[0];
      // dd($file);
      $media = new Media;
      $media['name'] = $file->getClientOriginalName();
      $media['path'] = $currentFile;
      $media['slug'] = $file->hashName();
      $media->save();
    }

    return back();
  }

  public function upload () {
    return view('dashboard/media/upload');
  }

  public function show ($id) {
    $media = Media::find($id);
    $image = Storage::disk('local')->url($media['path']);
    $media['url'] = $image;
    return view('dashboard/media/show', ['media' => $media]);
  }

}
