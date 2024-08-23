<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

class FileController extends Controller
{
  public function index()
  {
    $data = DB::table("files")
      ->select("*")
      ->addSelect(DB::raw("'FILES' AS type"))
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

    $duplicate = File::where("parent_id", "=", $data['parent_id'])
      ->where("name", "=", $data['name'])
      ->first();

    if ($duplicate != null) {
      throw ValidationException::withMessages(["message" => "Duplicate name found."]);
    }

    $data['id'] = Uuid::uuid4();
    $file = File::create($data);

    return response($file, 201);
  }

  public function update(Request $request, File $file)
  {
    $data = $request->validate([
      "name" => "required"
    ]);

    $duplicate = File::where("parent_id", "=", $file->parent_id)
      ->where("name", "=", $data['name'])
      ->first();

    if ($duplicate != null) {
      throw ValidationException::withMessages(["message" => "Duplicate name found."]);
    }

    $file->name = $data['name'];
    $file->save();

    return response($file, 201);
  }

  public function destroy(File $file)
  {
    $file->delete();

    return response(null, 204);
  }
}
