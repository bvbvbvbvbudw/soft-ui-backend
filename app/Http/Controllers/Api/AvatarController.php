<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $user_id = $request->user_id;
            $existingAvatar = Avatar::where('user_id', $user_id)->first();

            $path = $request->file('avatar')->store('storage/avatars', 'public_test');
            $databasePath = str_replace('storage/', '', $path);

            if ($existingAvatar) {
                Storage::delete($existingAvatar->avatar);
                $existingAvatar->avatar = $databasePath;
                $existingAvatar->save();
            } else {
                Avatar::create([
                    'avatar' => $databasePath,
                    'user_id' => $user_id,
                ]);
            }

            return response()->json(['message' => 'Avatar uploaded successfully']);
        }

        return response()->json(['message' => 'No avatar provided'], 400);
    }


    public function send(Request $request)
    {
        $user_id = $request->input('user_id');
        $currentAvatar = Avatar::where('user_id', $user_id)->with('user')->first();

        if (!$currentAvatar) {
            return response()->json(['error' => 'Avatar not found'], 404);
        }

        $response = [
            'user_id' => $user_id,
            'avatar' => $currentAvatar->avatar,
            'user' => [
                'id' => $currentAvatar->user->id,
                'name' => $currentAvatar->user->name,
            ],
        ];

        return response()->json($response, 200);
    }



}
