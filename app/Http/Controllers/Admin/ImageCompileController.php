<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ImageCompileController extends Controller
{
	public function renderGalleryAdminPreview( string $filename )
	{
        if(!\Storage::exists('public/gallery')){
            \Storage::makeDirectory('public/gallery');
        }

        if(!\Storage::exists('public/gallery_cache')){
            \Storage::makeDirectory('public/gallery_cache');
        }

        $path = storage_path('app/public/gallery/'.$filename);
        $compiledPath = storage_path('app/public/gallery_cache/admin_'.$filename);

        if(!file_exists($compiledPath)){
            try {
                $image = \Image::make($path);

                $factor = floatval(250) / floatval($image->height()) * .98;

                $image->resize( ($factor * $image->width() ), ( $factor * $image->height() ) );

                $image->save($compiledPath);
            } catch (\Exception $e){
                return abort(404, 'Image not found!');
            }
        } else {
            $image = \Image::make($compiledPath);
        }

        return $image->response();
	}
}
