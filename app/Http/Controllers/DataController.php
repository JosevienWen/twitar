<?php

namespace App\Http\Controllers;

use App\Models\tweets;
use Illuminate\Support\Facades\Validator;
use App\Models\users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    //function untuk autentikasi middleware
    function __construct()
    {
        $this->middleware('login')->except('psignin','register','login');
    }

    //function untuk membuka file index
    public function psignin()
    {
        return view('index');
    }

    //function untuk membuka file home dan return data dari model tweets
    public function phome()
    {
        $data = tweets::with('user')->latest()->get();
        return view('home')->with([
            'data' => $data
        ]);
    }

    //function untuk membuka file profile dan return data dari model tweets
    public function pprofile($id)
    {
        $data = tweets::where('user_id', $id)->latest()->get();
        return view('profile')->with([
            'data' => $data,
        ]);
    }

    //function untuk membuka file addpost
    public function paddpost()
    {
        return view('addpost');
    }

    //function untuk register
    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'username' => 'required|max:20|unique:users',
            'email' => 'required|max:50|unique:users|email',
            'password' => 'required',
        ]);

        if($validasi->fails())
        {
            return redirect() 
                ->back()
                ->withInput()
                ->with([
                'error' => 'Data anda tidak berhasil di regis'
            ]);
        } else {
            $data = users::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($data){
            return redirect()
                ->route('psignin')
                ->with([
                    'success' => 'Data anda berhasil di regis'
                ]);
        } else { 
            return redirect() 
                ->back()
                ->withInput()
                ->with([
                'error' => 'Data anda tidak berhasil di regis'
            ]);
        }
        }
    }

    //function untuk login
    public function login(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($validasi)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        } else {
            return redirect()
                ->route('psignin')
                ->with([
                    'error' => 'Email atau Password salah'
                ]);
        }
    }
    
    //function untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('psignin')
            ->with([
                'success' => 'Anda berhasil logout'
            ]);
    }
}
