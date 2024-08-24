<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class FolderController extends Controller
{
  public function index()
  {
    $data = DB::table("folders")
      ->select("*")
      ->addSelect(DB::raw("'FOLDER' AS type"))
      ->orderBy("name", "asc")
      ->get();

    return response($data, 200);
  }

  public function files(Request $request, Folder $folder)
  {
    $folders = DB::table("files")
      ->select("*")
      ->addSelect(DB::raw("'FILES' AS type"))
      ->where("parent_id", "=", $folder->id);

    $data = DB::table("folders")
      ->select("*")
      ->addSelect(DB::raw("'FOLDER' AS type"))
      ->where("parent_id", "=", $folder->id)
      ->union($folders)
      ->orderBy("name", "asc")
      ->get();

    return response($data, 200);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      "name" => "required",
      "parent_id" => "nullable",
    ]);

    $duplicate = Folder::where("parent_id", "=", $data['parent_id'])
      ->where("name", "=", $data['name'])
      ->first();

    if ($duplicate != null) {
      throw ValidationException::withMessages(["message" => "Duplicate name found."]);
    }

    $data['id'] = Uuid::uuid4();
    $folder = Folder::create($data);

    return response($folder, 201);
  }

  public function update(Request $request, Folder $folder)
  {
    $data = $request->validate([
      "name" => "required"
    ]);

    $duplicate = Folder::where("parent_id", "=", $folder->parent_id)
      ->where("name", "=", $data['name'])
      ->first();

    if ($duplicate != null) {
      throw ValidationException::withMessages(["message" => "Duplicate name found."]);
    }


    $folder->name = $data['name'];
    $folder->save();

    return response($folder, 201);
  }

  public function destroy(Folder $folder)
  {
    $id = $folder->id;

    DB::transaction(function () use ($folder, $id) {
      $folder->delete();
      $this->deleteRecursively($id);
    });

    return response(null, 204);
  }

  private function deleteRecursively($rootId)
  {
    $folders = Folder::where("parent_id", "=", $rootId)->get();
    $files = File::where("parent_id", "=", $rootId)->get();
    $children = [...$folders, ...$files];

    foreach ($children as $child) {
      if ($child instanceof File) {
        $child->delete();
      }

      if ($child instanceof Folder) {
        $id = $child->id;
        $child->delete();

        $this->deleteRecursively($id);
      }
    }
  }
}
