<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (\Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $mail = new \stdClass();
            $mail->message = "This is a successful login on your account. If this was not you, kindly take action by changing your account and email passwords.";
            $mail->subject = "Successful login";
            $mail->email = \Auth::user()->email;
            $mail->name = \Auth::user()->name;

            SendEmailJob::dispatch($mail);

            //dispatch(new SendEmailJob($mail));
            //Mail::bcc(auth()->user()->email)->send(new NotificationMail($mail));
            return redirect()->intended('admin-dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $users = User::orderBy('id', 'ASC')->get();
        $permissions = Permission::get();
        $roles = Role::orderBy('id', 'DESC')->get();

        return view('admin.dashboard', compact('users', 'permissions', 'roles'));
    }

    public function addUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Institution::create([
            'user_id' => $user->id
        ]);

        $user->assignRole([$request->roles]);
        return redirect()->back();
    }

    public function updateUser(Request $request, $id)
    {
        $user = \Auth::user();
        \DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        $user->assignRole([$request->role]);
        return redirect()->back();
    }

    public function deleteUser(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()
            ->with('success', 'User deleted successfully');
    }

    public function logout(Request $request): RedirectResponse
    {
        \Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
