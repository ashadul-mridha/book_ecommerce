<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Models\Search;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class UserAuthController extends Controller
{

    public function index()
    {
        $searchs = Search::orderBy('id', 'desc')->limit(1)->first();
        $all_categories = Category::orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('frontend.user_deshboard', compact('user', 'all_categories', 'searchs'));
    }
    public function profile_update(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|string',
        ]);
        $result = false;
        if (!$message) {
            return response(['message' => $message, 'result' => $result], 422);
        }
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        if ($request->gender) {
            $user->gender = $request->gender;
        }
        $user->save();
        $result = true;
        return response(['message' => 'Updated Success', 'result' => $result]);
    }
    // email for otp
    public function email_change_request(Request $request)
    {
        $check_mail = User::where('email', $request->email)->count();
        $result = false;
        if ($check_mail) {
            return response(['message' => 'The email has already been taken.', 'result' => $result]);
        }
        $OTP = rand(100000, 999999);
        Mail::to($request->email)->send(new OTPMail($OTP));

        Cache::put('OTP_' . Auth::user()->id, $OTP, now()->addSeconds(240));
        $result = true;
        return response(['message' => 'An OTP code send on your email address', 'result' => $result]);
    }
    // check email and opt
    public function email_change(Request $request)
    {
        $re_otp = $request->user_opt;
        $re_email = $request->email;
        $get_otp_cache = Cache::get('OTP_' . Auth::user()->id);
        $result = false;

        if ($re_otp != $get_otp_cache) {
            return response(['message' => 'Invalide OTP Code', 'result' => $result]);
        }
        $check_mail = User::where('email', $re_email)->count();
        if ($check_mail) {
            return response(['message' => 'The email has already been taken.', 'result' => $result]);
        }
        $user = user::find(Auth::user()->id);
        $user->email = $re_email;
        $user->save();
        $result = true;
        return response(['message' => 'Your Email Address Change Successfully', 'result' => $result]);
    }
    // password change
    public function change_password(Request $request)
    {
        // return $request->all();
        $user = User::find(Auth::user()->id);
        $old_pass = Hash::check($request->old_pass, $user->password);
        $result = false;
        if (!$old_pass) {
            return response(['message' => 'Old Password Not Match!', 'result' => $result], 403);
        }
        $message = $request->validate([
            'new_pass' => 'min:6|required_with:renew_pass',
            'renew_pass' => 'same:new_pass'
        ]);
        if (!$message) {
            return response(['message' => $message, 'result' => $result], 401);
        }

        $user->password = Hash::make($request->new_pass);
        $user->save();
        $result = true;
        return response(['message' => 'Updated Success', 'result' => $result]);
    }
    public function update_photo(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $ran_name = strtolower(Str::random(11));
        if ($request->hasFile('profileImage')) {
            $file = $request->file('profileImage');
            $photo_name = $ran_name . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            if ($user->photo != 'user.png') {
                $link = base_path('public/images/user/' . $user->photo);
                if (file_exists($link)) {
                    unlink($link);
                }
            }
            Image::make($file)->resize(120, 120)->save(base_path('public/images/user/' . $photo_name), 100);
            $user->photo = $photo_name;
            $user->save();
        }

        $result = true;
        return response(['message' => 'Updated Success', 'result' => $result]);
    }

    public function user_ceate_review(Request $request)
    {
        $message = $request->validate([
            'comment' => 'required'
        ]);
            if (!$message) {
                return ['error', 'Comment Field is required'];
            }
        $review = new Review();
        $review->book_id = $request->book_id;
        $review->user_id = Auth::user()->id;
        if ($request->rating) {
            $review->rating = $request->rating;
        }
        $review->comment = $request->comment;
        $review->save();
        return response(['success' => 'Thanks For Comment']);

    }
}
