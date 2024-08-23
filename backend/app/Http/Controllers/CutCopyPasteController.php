<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class CutCopyPasteController extends Controller
{
  public function store(Request $request)
  {
    $data = $request->validate([
      "action" => "required",
      "target_id" => "required",
      "destination_id" => "nullable",
    ]);

    $object = File::find($data['target_id']);
    if ($object == null) {
      $object = Folder::find($data['target_id']);
    }

    if ($data['action'] == "CUT") {
      $object = $this->cutFile($object, $data['destination_id']);
    }

    if ($data['action'] == "COPY") {
      $object = $this->copyFile($object, $data['destination_id']);
    }

    return response($object, 200);
  }

  private function copyFile($file, $destinationId)
  {
    $clone = $file->replicate();
    $path = pathinfo($clone->name);

    $totalCopies = DB::table("files")
      ->where("parent_id", "=", $destinationId)
      ->where("name", "LIKE", "{$path['filename']}%")->count();

    $clone->id = Uuid::uuid4();
    $clone->parent_id = $destinationId;

    if ($totalCopies > 0) {
      $postfix = time();
      $nameComponents = explode(".", $path['filename']);

      $clone->name = "{$nameComponents[0]}.$postfix.{$path['extension']}";
    }

    $clone->save();

    return $clone;
  }

  private function cutFile($file, $destinationId)
  {
    $file->parent_id = $destinationId;
    $file->save();

    return $file;
  }
}
