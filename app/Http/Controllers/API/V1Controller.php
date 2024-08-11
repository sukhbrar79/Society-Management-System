<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\NotificationCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class V1Controller extends Controller
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->sendEmailVerificationNotification();

        $user->syncRoles(['resident']);

        $token = $user->createToken('LaravelPassportAuth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LaravelPassportAuth')->accessToken;

            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function profileShow()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the user profile data
        return response()->json([
            'success' => true,
            'data' => new UserResource($user),
        ]);
    }

    

public function profileUpdate(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Define validation rules
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'mobile' => 'nullable|string|max:15',
        'avatar' => 'nullable|string', // Change to string for Base64
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json(
            [
                'success' => false,
                'errors' => $validator->errors(),
            ],
            422,
        );
    }

    // Update the user profile
    $user->name = $request->input('name');
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->mobile = $request->input('mobile');

    // Handle Base64 encoded avatar if provided
    if ($request->has('avatar')) {
        $base64Image = $request->input('avatar');

        // Extract the image type and data
        list($type, $data) = explode(';', $base64Image);
        list(, $data) = explode(',', $data);

        // Decode the Base64 string
        $imageData = base64_decode($data);

        // Define the path where avatars are stored
        $avatarDirectory = 'avatars';

        // Check if the directory exists and create it if it does not
        if (!Storage::exists($avatarDirectory)) {
            Storage::makeDirectory($avatarDirectory);
        }

        // Generate a unique file name
        $fileName = Str::random(40) . '.png'; // Assuming PNG format

        // Store the new avatar
        $avatarPath = $avatarDirectory . '/' . $fileName;
        Storage::put('public/' . $avatarPath, $imageData);

        // Delete the old avatar if it exists
        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        $user->avatar = $avatarPath;
    }

    $user->save();

    // Return success response with additional parameters
    return response()->json([
        'success' => true,
        'message' => 'Profile updated successfully',
        'data' => new UserResource($user),
    ]);
}


    public function emergencyDetails()
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [['name' => setting('emergency_name'), 'email' => setting('emergency_email'), 'phone' => setting('emergency_phone'), 'position' => setting('emergency_position')], ['name' => setting('emergency_name'), 'email' => setting('emergency_email'), 'phone' => setting('emergency_phone'), 'position' => setting('emergency_position')]],
        ]);
    }
    /**
     * Get a list of notifications for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->get();

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => new NotificationCollection($notifications),
        ]);
    }

    /**
     * Mark a notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $notificationId
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read.',
            'data' => '',
        ]);
    }
}
