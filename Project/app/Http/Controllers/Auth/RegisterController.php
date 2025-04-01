<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Companies;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => ['required', 'string', 'min:10', 'max:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if (User::count() == 0) {
            $users = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'contact' => $data['contact'],
                'is_admin' => '1',
                'user_view' => '1',
                'home_view'  => '1',
                'order_view'  => '1',
                'product_view'  => '1',
                'product_add'  => '1',
                'product_edit'  => '1',
                'product_delete'  => '1',
                'user_view'  => '1',
                'user_add'  => '1',
                'user_edit'  => '1',
                'user_delete'  => '1',
                'user_status'  => '1',
                'caregory_view'  => '1',
                'caregory_add'  => '1',
                'caregory_edit'  => '1',
                'caregory_delete'  => '1',
                'supplier_view' => '1',
                'supplier_add' => '1',
                'supplier_edit' => '1',
                'supplier_delete' => '1',
                'customer_view' => '1',
                'customer_add' => '1',
                'customer_edit' => '1',
                'customer_delete' => '1',
                'payin_out' => '1',
                'payin' => '1',
                'payout' => '1',
                'addstore_view' => '1',
                'addstore' => '1',
                'quick_addstore' => '1',
            ]);

           
            return $users;
        } else {
            $users = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'contact' => $data['contact'],
            ]);

            return $users;
        }
    }
}
