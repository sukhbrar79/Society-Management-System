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
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add other fields as necessary
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
        $user->email = $request->input('email');
        // Update other fields as necessary
        $user->save();

        // Return success response
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
            'data' =>  new NotificationCollection($notifications),
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
