<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use Carbon\Carbon;
use Myth\Auth\Config\Services;
use Config\Services as ConfigService;
use Myth\Auth\Entities\User;

class ApiAuth extends BaseController
{
	use ResponseTrait;

	private $secretKey = '';
	private $serverName = "books-web-app.com";

	public function __construct()
	{
		$this->config = config('Auth');
		$this->auth = Services::authentication();
	}

	public function authenticate()
	{
		$this->secretKey = ConfigService::getSecretKey();

		$username = $this->request->getVar('username');

		$password = $this->request->getVar('password');

		$this->auth = Services::authentication();

		$user = $this->auth->validate(['email' => $username, 'password' => $password], true);

		if(!$user)
		{
			return $this->failNotFound();
		}

		$issuedAt = Carbon::now();

		$data = [
		    'iat'  => $issuedAt->getTimestamp(), // Issued at
		    'iss'  => $this->serverName, // Issuer
		    'nbf'  => $issuedAt->getTimestamp(), // Not before
		    'exp'  => $issuedAt->addMinutes(60)->getTimestamp(), // Expire
		    'userId' => $user->id, // User ID
		    'userName' => $user->username, // User Name
		    'userEmail' => $user->email, // User Email
		];
		
		$jwt = JWT::encode($data, $this->secretKey, 'HS256');

		return $this->respond($jwt, 200);
	}

	public function attemptRegister()
	{
		// Check if registration is allowed
		if (! $this->config->allowRegistration)
		{
			return $this->failNotFound();
		}

		$users = model('UserModel');

		$email = $this->request->getVar('email');

		if(strpos($email, '@') === false)
		{
			return $this->fail('mail is not valid', 400);
		}

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = [
			'username'  	=> 'required|alpha_numeric_space|min_length[3]|is_unique[users.username]',
			'email'			=> 'required|valid_email|is_unique[users.email]',
			'password'	 	=> 'required|strong_password',
			'pass_confirm' 	=> 'required|matches[password]',
		];

		if (! $this->validate($rules))
		{
			return $this->fail(array_values(service('validation')->getErrors())[0], 400);
		}

		// Save the user
		$allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
		$user = new User($this->request->getPost($allowedPostFields));

		$this->config->requireActivation !== false ? $user->generateActivateHash() : $user->activate();

		// Ensure default group gets assigned if set
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

		if (! $users->save($user))
		{
			return $this->fail('Error during saving', 400);
		}

		if ($this->config->requireActivation !== false)
		{
			$activator = service('activator');
			$sent = $activator->send($user);

			if (! $sent)
			{
				return $this->fail('Error during sending activation email', 400);
			}

			return $this->respond('Please check your email', 200);
		}

		return $this->respond(true, 200);
	}
}
