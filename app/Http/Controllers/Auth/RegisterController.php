<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ServiceM8\ServiceM8Service;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validate registration data
     */
    protected function validator(array $data)
    {
        dd($data);
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create user after validation
     */
    protected function create(array $data)
    {
        /** @var ServiceM8Service $serviceM8 */
        $serviceM8 = app(ServiceM8Service::class);

        // 🔍 Check if email exists in ServiceM8 companies
        $companies = $serviceM8->getClients([
            '$filter' => "email eq '{$data['email']}'",
            '$top'    => 1,
        ]);
        dd($companies);
        if (empty($companies) || count($companies) === 0) {
            throw ValidationException::withMessages([
                'email' => 'This email is not registered as a client with Tom’s Pest Control.',
            ]);
        }

        $company = $companies[0];

       

        return User::create([
            'name'                   => $data['name'],
            'email'                  => $data['email'],
            'password'               => Hash::make($data['password']),
            'servicem8_company_uuid' => $company['company_uuid'] ?? null, // ⭐ IMPORTANT
            'created_at'             => time(),
            'updated_at'             => time(),
            'is_active'              => 'Yes',
            'type'                   => 'client',
        ]);
    }
}
