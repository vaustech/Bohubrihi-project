<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <-- 'U' বড় হাতের হবে
use Illuminate\Support\Facades\Hash; // <-- পাসওয়ার্ডের জন্য এটি import করুন
use Illuminate\Support\Facades\Auth; // <-- লগইনের জন্য এটি import করুন

class UserController extends Controller
{
    /**
     * এটি শুধু লগইন/রেজিস্ট্রেশন পেজটি দেখাবে
     */
    public function index()
    {
        return view('account'); // <-- লগইন লজিক এখান থেকে সরিয়ে ফেলা হয়েছে
    }

    /**
     * রেজিস্ট্রেশন (নতুন ইউজার সেভ করা)
     */
    public function store(Request $request)
    {
        // 'user' এর বদলে 'User' হবে
        User::insert([
            'name'=>$request->has('uname') ? $request->get('uname'):'',
            'email'=>$request->has('email') ? $request->get('email'):'',
            'phone'=>$request->has('mobile') ? $request->get('mobile'):'', // User.php মডেলে 'phone' আছে

            // রেজিস্ট্রেশনের সময় 'bcrypt()' বা 'Hash::make()' ব্যবহার করা সঠিক
            'password'=>$request->has('pass') ? Hash::make($request->get('pass')):'',
        ]);

        // সফলভাবে রেজিস্ট্রেশন হলে প্রোডাক্ট পেজে পাঠান
        return redirect('/products')->with('success','User Registered Successfully');
    }

    /**
     * লগইন চেক করার জন্য নতুন এই ফাংশনটি যোগ করা হলো
     */
    public function checkLogin(Request $request)
    {
        // ফর্ম থেকে আসা ইমেল ও পাসওয়ার্ড ('pass')
        $credentials = [
            'email' => $request->email,
            'password' => $request->pass, // 'pass' ফিল্ডটিকে 'password' হিসেবে চেক করবে
        ];

        // Auth::attempt() ফাংশনটি নিজে থেকেই ডাটাবেসের হ্যাশড পাসওয়ার্ডের সাথে
        // ফর্মের প্লেইন পাসওয়ার্ড ('123456') মিলিয়ে দেখবে।
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // লগইন সফল হলে প্রোডাক্ট পেজে রিডাইরেক্ট করুন
            return redirect()->intended('/products');
        }

        // লগইন ব্যর্থ হলে, আবার account পেজে ফেরত পাঠান এবং এরর দেখান
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // --- অন্যান্য ডিফল্ট ফাংশন ---

    public function create()
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
