<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;
use Carbon\Carbon;
use Myth\Auth\Config\Services;
use Config\Services as ConfigService;

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
}
