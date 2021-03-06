<?php /** @noinspection PhpUndefinedNamespaceInspection */

/** @noinspection PhpUndefinedNamespaceInspection */

namespace App\Http\Controllers\Auth;

use DateTime;
use App\Domains\DomainModels\UserDomainModel;
use App\Http\Controllers\Controller;

use Request;
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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('home');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     * @author Yansen
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|numeric',
            'address' => 'required|regex:(street)',
            'birthday' => 'required|date|before:'
                . (date_format(new DateTime(), 'Y') - 12)
                . '-'
                . date_format(new DateTime(), 'm-d'),
            'gender' => 'required',
            'picture' => 'required|image',
            'agreement' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @author Yansen
     *
     * @param array $data
     * @return App\Repository\DataModels\User
     */
    protected function create(array $data)
    {
        return UserDomainModel::addUser($data);
    }
}
