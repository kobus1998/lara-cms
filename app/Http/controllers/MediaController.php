<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use \App\Media;

use Illuminate\Http\Request;

class MediaController extends Controller
{

  public function index () {
    $medias = Media::orderBy('created_at', 'desc')->paginate(15);
    $images = [];
    foreach ($medias as $media) {
      $image = Storage::disk('local')->url($media->path);
      $media->url = $image;
    }

    return view('dashboard/media/index', ['images' => $medias]);
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

  public function store (Request $req) {
    $this->validate($req, [
      // 'name' => 'required',
      // 'media' => 'required'
    ]);

    $files = $req['media'];
    foreach ($files as $file) {

      $currentFile = $file->store('public');
      $media = new Media;
      $media['name'] = $file->getClientOriginalName();
      $media['path'] = $currentFile;
      $media['slug'] = $file->hashName();
      $media->save();
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
