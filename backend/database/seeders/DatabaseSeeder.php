<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $files = [
      ["id" => "fa03ec58-984a-40ea-8500-dba8fe820e33", "parent_id" =>  "f5814b39-ab0b-4ed3-a02c-b4d63b141e73", "name" => "flutter", "created_at" => "2024-08-23 14:50:38", "updated_at" => "2024-08-23 14:50:38"],
      ["id" => "dae1a31f-c3fe-4bf9-9de4-62099f2592c8", "parent_id" =>  "bdb2b455-5d38-4210-811b-7385572e9eb0", "name" => "RobotoFlex-Variable.ttf", "created_at" => "2024-08-23 14:55:47", "updated_at" => "2024-08-23 15:42:08"],
      ["id" => "cbbe7317-5435-4c3f-89b4-b1e52c9cb2a7", "parent_id" =>  "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" => "Catatan.md", "created_at" => "2024-08-23 14:52:02", "updated_at" => "2024-08-23 15:42:45"],
      ["id" => "c3569c47-ee61-4bfc-8e61-8a538270d908", "parent_id" =>  "af3be18e-dabd-4e5e-87e3-5bd2c0303ce2", "name" => "Catatan Thirtheen.txt", "created_at" => "2024-08-23 14:52:35", "updated_at" => "2024-08-23 15:44:48"],
      ["id" => "b9265d30-e96f-41cf-84ad-9eb0a695b0f9", "parent_id" =>  "bdb2b455-5d38-4210-811b-7385572e9eb0", "name" => "README.txt", "created_at" => "2024-08-23 14:55:29", "updated_at" => "2024-08-23 14:55:29"],
      ["id" => "b4321260-c4ad-4a92-9331-ae7d19dc4199", "parent_id" =>  "400d7aca-7659-4473-8436-5b1891b6bfb6", "name" => "android", "created_at" => "2024-08-23 14:50:52", "updated_at" => "2024-08-23 15:41:38"],
      ["id" => "9723be8e-4aea-46f9-a7d4-d540af723500", "parent_id" =>  "75a95b26-6490-4447-88ed-8916c5d323d9", "name" => "flutter-doctor.sh", "created_at" => "2024-08-23 14:53:23", "updated_at" => "2024-08-23 14:57:20"],
      ["id" => "90a7d4f2-c5a7-427a-a69e-e3d21bb04508", "parent_id" =>  "0bbcb1ea-82fb-4c31-ade5-4513135aafc4", "name" => "WPS Office Installer.app", "created_at" => "2024-08-23 14:54:49", "updated_at" => "2024-08-23 14:54:49"],
      ["id" => "7d99925d-a388-46fd-af53-27148fd4a8eb", "parent_id" =>  "ca470cb2-21b0-4968-ac33-18d2c4ca0461", "name" => "Catatan Pertemuan.md", "created_at" =>  "2024-08-23 15:44:28", "updated_at" => "2024-08-23 15:44:55"],
      ["id" => "679b73a7-c5c5-4a0a-b84c-fc8c49f8506f", "parent_id" =>  "4f4e7e0f-c508-4b13-9834-85df1cbebbf7", "name" => "Visual Studio Code.app", "created_at" => "2024-08-23 14:49:33", "updated_at" => "2024-08-23 14:49:33"],
      ["id" => "4931b5dc-eef1-479f-84a2-76f7847980a6", "parent_id" =>  "4f4e7e0f-c508-4b13-9834-85df1cbebbf7", "name" => "Android Studio.app", "created_at" =>  "2024-08-23 14:49:16", "updated_at" => "2024-08-23 14:49:16"],
      ["id" => "3bc8a565-706a-4fbb-87ac-86e332d2ca39", "parent_id" =>  "4f4e7e0f-c508-4b13-9834-85df1cbebbf7", "name" => "Postman.app", "created_at" => "2024-08-23 14:49:25", "updated_at" => "2024-08-23 14:49:25"],
      ["id" => "38e876b5-6b2c-410b-9e95-c9ebbc8c8721", "parent_id" =>  "546c5472-dd2c-4c17-b6d7-d95baff0b43f", "name" => "note.txt", "created_at" => "2024-08-23 14:51:29", "updated_at" => "2024-08-23 14:51:34"],
      ["id" => "30349ed2-4bf1-44e8-9e48-8577e6ee7190", "parent_id" =>  "4f4e7e0f-c508-4b13-9834-85df1cbebbf7", "name" => "Figma.app", "created_at" => "2024-08-23 14:49:39", "updated_at" => "2024-08-23 14:49:39"],
      ["id" => "0a4144ba-e6fb-45b6-a390-21c1ab3e5df5", "parent_id" =>  "b9b56dc0-70ae-4013-a90b-12c38df71d97", "name" => "RobotoFlexRegular.ttf", "created_at" => "2024-08-23 14:56:14", "updated_at" => "2024-08-23 14:56:14"],
    ];

    File::insert($files);

    $folders = [
      ["id" => "fdd9e2d3-2025-4ce5-8970-7696e894df3a", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Python", "created_at" =>  "2024-08-23 15:16:44", "updated_at" =>  "2024-08-23 15:16:44"],
      ["id" => "fbfa78c0-ac1b-44c1-9c1a-241ce73251b8", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 2", "created_at" =>  "2024-08-23 14:51:53", "updated_at" =>  "2024-08-23 14:51:53"],
      ["id" => "f856af3f-10e3-4249-83cf-7976d2b516b5", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 1", "created_at" =>  "2024-08-23 14:51:49", "updated_at" =>  "2024-08-23 14:51:49"],
      ["id" => "f5814b39-ab0b-4ed3-a02c-b4d63b141e73", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Flutter", "created_at" =>  "2024-08-23 14:50:14", "updated_at" =>  "2024-08-23 15:40:25"],
      ["id" => "e5bd6cc5-51c2-442e-a8e7-fa9ea7261879", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 3", "created_at" =>  "2024-08-23 14:57:27", "updated_at" =>  "2024-08-23 14:57:27"],
      ["id" => "e1321f51-0733-4858-b4d2-d296eacff4f0", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Kratos", "created_at" =>  "2024-08-23 14:50:19", "updated_at" =>  "2024-08-23 14:50:19"],
      ["id" => "dde62e3b-39bb-41c0-b610-24a2d42ba175", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Rust", "created_at" =>  "2024-08-23 15:06:24", "updated_at" =>  "2024-08-23 15:40:11"],
      ["id" => "d7ef57d1-2483-41f8-9486-f80b7de911c2", "parent_id" => "546c5472-dd2c-4c17-b6d7-d95baff0b43f", "name" =>  "Parcus", "created_at" =>  "2024-08-23 14:51:24", "updated_at" =>  "2024-08-23 14:51:24"],
      ["id" => "d38fd922-6ac7-46cd-8d00-764bced826f9", "parent_id" => "fbfa78c0-ac1b-44c1-9c1a-241ce73251b8", "name" =>  "Pengantar Pemrograman", "created_at" =>  "2024-08-23 14:52:16", "updated_at" =>  "2024-08-23 15:45:19"],
      ["id" => "ca470cb2-21b0-4968-ac33-18d2c4ca0461", "parent_id" => "af3be18e-dabd-4e5e-87e3-5bd2c0303ce2", "name" =>  "Summary", "created_at" =>  "2024-08-23 15:44:53", "updated_at" =>  "2024-08-23 15:44:53"],
      ["id" => "c78cb7d5-98f4-4538-9e2f-ce17a28d073b", "parent_id" => "400d7aca-7659-4473-8436-5b1891b6bfb6", "name" =>  "bin", "created_at" =>  "2024-08-23 14:50:47", "updated_at" =>  "2024-08-23 15:23:56"],
      ["id" => "c1bb0e98-3954-45e8-94c8-4696137d68df", "parent_id" => "546c5472-dd2c-4c17-b6d7-d95baff0b43f", "name" =>  "Basilisk", "created_at" =>  "2024-08-23 14:51:42", "updated_at" =>  "2024-08-23 14:51:42"],
      ["id" => "c148dc0a-f3e9-437f-b0ae-3ff36b093171", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 7", "created_at" =>  "2024-08-23 15:00:10", "updated_at" =>  "2024-08-23 15:00:10"],
      ["id" => "bdb2b455-5d38-4210-811b-7385572e9eb0", "parent_id" => "0bbcb1ea-82fb-4c31-ade5-4513135aafc4", "name" =>  "Roboto_Flex", "created_at" =>  "2024-08-23 14:55:06", "updated_at" =>  "2024-08-23 14:55:06"],
      ["id" => "b9b56dc0-70ae-4013-a90b-12c38df71d97", "parent_id" => "bdb2b455-5d38-4210-811b-7385572e9eb0", "name" =>  "static", "created_at" =>  "2024-08-23 14:56:02", "updated_at" =>  "2024-08-23 14:56:49"],
      ["id" => "af3be18e-dabd-4e5e-87e3-5bd2c0303ce2", "parent_id" => "fbfa78c0-ac1b-44c1-9c1a-241ce73251b8", "name" =>  "English", "created_at" =>  "2024-08-23 14:52:24", "updated_at" =>  "2024-08-23 14:52:24"],
      ["id" => "abbb80ee-8445-4374-b923-8d246297da3f", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "PostgreSQL", "created_at" =>  "2024-08-23 14:49:50", "updated_at" =>  "2024-08-23 14:52:53"],
      ["id" => "aa3418ed-fa45-48fb-826d-e76737399950", "parent_id" => null, "name" => "Workspaces", "created_at" =>  "2024-08-23 14:49:02", "updated_at" =>  "2024-08-23 14:49:02"],
      ["id" => "8fc46d48-904b-4747-bf94-1409bd6a3184", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Golang", "created_at" =>  "2024-08-23 15:06:20", "updated_at" =>  "2024-08-23 15:06:20"],
      ["id" => "75a95b26-6490-4447-88ed-8916c5d323d9", "parent_id" => "f5814b39-ab0b-4ed3-a02c-b4d63b141e73", "name" =>  "bin", "created_at" =>  "2024-08-23 14:50:28", "updated_at" =>  "2024-08-23 14:50:28"],
      ["id" => "5d4ef699-1b8e-4808-a12d-e3f67276fd04", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 5", "created_at" =>  "2024-08-23 14:57:40", "updated_at" =>  "2024-08-23 14:57:40"],
      ["id" => "546c5472-dd2c-4c17-b6d7-d95baff0b43f", "parent_id" => "aa3418ed-fa45-48fb-826d-e76737399950", "name" =>  "Side Projects", "created_at" =>  "2024-08-23 14:51:18", "updated_at" =>  "2024-08-23 14:51:18"],
      ["id" => "526b5acf-3139-401e-a335-4b53b1c08e67", "parent_id" => "f5814b39-ab0b-4ed3-a02c-b4d63b141e73", "name" =>  "docs", "created_at" =>  "2024-08-23 14:50:32", "updated_at" =>  "2024-08-23 14:50:32"],
      ["id" => "4f4e7e0f-c508-4b13-9834-85df1cbebbf7", "parent_id" => null, "name" =>  "Applications", "created_at" =>  "2024-08-23 14:30:38", "updated_at" => "2024-08-23 14:30:38"],
      ["id" => "4849f2d6-274d-4d46-8146-78c69d7e66ff", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 4", "created_at" =>  "2024-08-23 14:57:33", "updated_at" =>  "2024-08-23 14:57:33"],
      ["id" => "4722e111-2272-4c2e-8b49-1976cb53309d", "parent_id" => null, "name" =>  "Documents", "created_at" =>  "2024-08-23 14:25:04", "updated_at" => "2024-08-23 14:25:04"],
      ["id" => "400d7aca-7659-4473-8436-5b1891b6bfb6", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Android", "created_at" =>  "2024-08-23 14:49:58", "updated_at" =>  "2024-08-23 14:49:58"],
      ["id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "parent_id" => null, "name" =>  "Development", "created_at" =>  "2024-08-23 14:48:56", "updated_at" => "2024-08-23 14:48:56"],
      ["id" => "39f702ab-a290-44f2-a6fb-01512168b34d", "parent_id" => "aa3418ed-fa45-48fb-826d-e76737399950", "name" =>  "Office", "created_at" =>  "2024-08-23 14:51:04", "updated_at" =>  "2024-08-23 14:51:04"],
      ["id" => "36693873-579e-41ed-a3a7-ae1b4918da33", "parent_id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "name" =>  "Semester 6", "created_at" =>  "2024-08-23 14:58:35", "updated_at" =>  "2024-08-23 14:58:35"],
      ["id" => "26e5daeb-026c-458b-9b2f-01a55996b425", "parent_id" => "3ac806dc-e8c2-4bc6-b4a9-a66b2e9f6348", "name" =>  "Docker", "created_at" =>  "2024-08-23 14:49:54", "updated_at" =>  "2024-08-23 14:49:54"],
      ["id" => "22198954-7ad8-460e-9b8d-95d5c2c94451", "parent_id" => "aa3418ed-fa45-48fb-826d-e76737399950", "name" =>  "College", "created_at" =>  "2024-08-23 14:51:09", "updated_at" =>  "2024-08-23 14:51:09"],
      ["id" => "0bbcb1ea-82fb-4c31-ade5-4513135aafc4", "parent_id" => null, "name" =>  "Downloads", "created_at" =>  "2024-08-23 14:29:51", "updated_at" => "2024-08-23 14:29:51"],
    ];

    Folder::insert($folders);
  }
}
