<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

    public function showChangePasswordForm()
    {
        return view('admin.pages.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'different:current_password'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('admin.password.change')->with('success', 'Password changed successfully!');
    }
}
