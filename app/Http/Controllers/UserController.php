<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order=$request->order;
        $users = User::query()->orderBy('updated_at', $order)->get();
        return response()->json([
            "success" => true,
            "data" => [
                "client_count" => $users->where('category','client')->count(),
                "admin_count" => $users->where('category','admin')->count(),
                "merchant" => $users->where('category','merchant')->count(),
                "users" => $users
            ]
        ], 200);
        // return view('Users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'      => 'string|required|max:255',
            'email'     => 'email|required|max:255|unique:users,email',
            'phone'     => 'string|required|max:30|unique:users,phone',
            'category'  => 'string|required|in:client,admin,merchant',
            'image'     => 'nullable|image',
            'password'  => [
                'required',
                'confirmed',
                Password::min(8)->letters()
                    ->mixedCase()  //upper and lower case
                    ->numbers()     //number 
                    ->symbols()     //!@#$%^&*()
                    ->uncompromised(),
            ]
            // regex
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filePath = $image->store('users_images', 'public'); // Save to the 'public' disk
            $data['avatar'] = asset("storage/$filePath"); // Generate public URL for the image
        } else {
            $data['avatar'] = null; // Default value if no image is uploaded
        }
        // dd($data);
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success'   => false,
                'data'      => 'USER IS NOT FOUND!!!'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        // $user = User::query()->where('id',$id)->first();
        $user->delete();
        return redirect()->route('user.index');
    }

    public function loginForm()
    {
        return view('Users.login');
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required'
        ]);
        if ($validator->fails())
            return $validator->errors();
        $data = $validator->validated();
        $user = User::query()->where('email', $data['email'])->first();
        if (Hash::check($data['password'], $user->password)) {
            if (Auth::attempt($data)) {
                $request->session()->regenerate();

                return $user->category == 'client' ? redirect()->route('category.index') : redirect()->route('user.index');
                // return redirect()->intended('dashboard');
            }
        } else {
            return 'WRONG PASSWORD!!!';
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
