<?php

use App\Http\Controllers\CutCopyPasteController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::apiResource("api/files", FileController::class);
Route::apiResource("api/folders", FolderController::class);
Route::get("api/folders/{folder}/files", [FolderController::class, 'files']);

// Route::controller(FolderController::class)->group(function () {
//   Route::get("api/folders", [FolderController::class, 'index']);
//   Route::get("api/folders/{folder}", [FolderController::class, 'show']);
//   Route::get("api/folders/{folder}/files", [FolderController::class, 'files']);
//   Route::post("api/folders", [FolderController::class, 'store']);
//   Route::put("api/folders/{folder}", [FolderController::class, 'update']);
//   Route::delete("api/folders/{folder}", [FolderController::class, 'destroy']);
// });

Route::post("api/cut_copy_paste", [CutCopyPasteController::class, 'store']);
