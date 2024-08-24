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
    $type = "FILE";
    if ($object == null) {
      $object = Folder::find($data['target_id']);
      $type = "FOLDER";
    }

    if ($data['action'] == "CUT") {
      $object = $this->cutFileOrFolder($object, $data['destination_id']);
    }

    if ($data['action'] == "COPY" && $type == "FILE") {
      $object = $this->copyFile($object, $data['destination_id']);
    }

    if ($data['action'] == "COPY" && $type == "FOLDER") {
      $object = $this->copyFolderRecursively($object, $data['destination_id']);
    }

    return response($object, 200);
  }

  private function cutFileOrFolder($file, $destinationId)
  {
    $file->parent_id = $destinationId;
    $file->save();

    return $file;
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

  private function copyFolderRecursively($folder, $destinationId)
  {
    $root = null;
    DB::transaction(function () use ($folder, $destinationId, $root) {
      $oldId = $folder->id;
      $newId = Uuid::uuid4();

      $root = $folder->replicate();
      $root->id = $newId;
      $root->parent_id = $destinationId;
      $root->save();

      $this->copyRecursively($oldId, $newId);
    });

    return $root;
  }

  private function copyRecursively($oldParentId, $newParentId)
  {
    $folders = Folder::where("parent_id", "=", $oldParentId)->get();
    $files = File::where("parent_id", "=", $oldParentId)->get();
    $children = [...$folders, ...$files];

    foreach ($children as $child) {
      if ($child instanceof File) {
        $clone = $child->replicate();
        $clone->id = Uuid::uuid4();
        $clone->parent_id = $newParentId;
        $clone->save();
      }

      if ($child instanceof Folder) {
        $oldChildId = $child->id;
        $newChildId = Uuid::uuid4();

        $clone = $child->replicate();
        $clone->id = $newChildId;
        $clone->parent_id = $newParentId;
        $clone->save();

        $this->copyRecursively($oldChildId, $newChildId);
      }
    }
  }
}
