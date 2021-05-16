<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use Myth\Auth\Entities\User;
use CodeIgniter\HTTP\IncomingRequest;
use \Firebase\JWT\JWT;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
	public static function getSecretKey()
	{
		return 'G-KaPdSgVkYp3s5v8y/B?E(H+MbQeThWmZq4t7w9z$C&F)J@NcRfUjXn2r5u8x/A'; // 512 bit key -> 64 caratteri
	}

	public static function getUserFromJWT(IncomingRequest $request)
	{
		$key = Services::getSecretKey();

		$authHeader = $request->getServer('HTTP_AUTHORIZATION');

		$arr = explode(' ', $authHeader);

		$token = $arr[1];

		$decoded = JWT::decode($token, $key, ['HS256 ']);

		$userModel = new \Myth\Auth\Models\UserModel();

		$user = $userModel->find($decoded->userId);

		return $user;
	}
}
