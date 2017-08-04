<?php

namespace App\Http\Controllers\Auth;

use App\Entities\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/home';
    public $em;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManagerInterface $em)
    {
       $this->em = $em;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:App\Entities\UserEntity',
            'password' => 'required|string|min:6|confirmed',
            'userLevel' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new UserEntity(
        $data['name'],
        $data['email'],
        bcrypt($data['password']),
        $data['userLevel']
        );
        $this->em->persist($user);
        $this->em->flush();
        return $user;
/*        return new UserEntity(
            $data['name'],
            $data['email'],
            bcrypt($data['password']),
            $data['userLevel']
        )*/
    }

}
