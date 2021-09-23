<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;

class ProfileController extends Controller
{
    use ImageUpload;
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function getByUser($id)
    {
        $data = $this->user->with('profile', 'posts')->find($id);
        return view('user.profile', compact('data'));
    }

    public function getCommentsByUser($id)
    {
        $data = $this->user->with('profile', 'comments.post')->find($id);
        return view('user.profile', compact('data'));
    }
    public function settings()
    {
        $user = $this->user->with('profile')->find(auth()->id());
        return view('user.settings', compact('user'));
    }
    public function UpdateProfile(Request $request)
    {
        if ($request->hasFile('avatar_file')) {
            $avatar = $this->uploadAvatar($request->avatar_file);
            $request->merge(['avatar' => $avatar]);
        }
        auth()->user()->update($request->only(['name', 'email']));

        auth()->user()->profile()->update($request->only(['website', 'bio', 'avatar']));
        return back()->with('success', trans('alerts.success'));
    }
}
