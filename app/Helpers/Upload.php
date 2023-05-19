<?php
namespace App\Helpers;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

class Upload
{

    static public function uploadFile($file, $path, $title = null)
    {
        $ext = $file->getClientOriginalExtension();
        if ($title == null) {
            $title = uniqid() . '-' . time() . "." . $ext;
        } else {
            $title = $title . '-' . Str::random(16) . '.' . $ext;
        }
        $uploading = Storage::disk('public');
        $uploading->putFileAs(
            $path,
            $file,
            $title
        );
        if ($uploading) {
            return $path . '/' . $title;
        }
        return false;
    }
}
