<?php

namespace App\Filters;

use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;


class JwtFilter implements FilterInterface
{
	use ResponseTrait;

	public function before(RequestInterface $request, $param = null)
	{
		try
		{
			$user = Services::getUserFromJWT($request);

			if(!$user)
			{
				return Services::response()
					->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
			}
		}
		catch (\Exception $e)
		{
			return Services::response()
				->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $param = null)
	{
		// Do something here
	}

	//--------------------------------------------------------------------
}
