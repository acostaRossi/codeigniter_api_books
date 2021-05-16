<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Config\Services;

class Api extends BaseController
{
	use ResponseTrait; 
    
	public function index()
	{
		//$user = Services::getUserFromJWT($this->request);

		$db = db_connect();

		$query = $db->query('SELECT * FROM books');

		$data = $query->getResult();

        return $this->respond($data, 200);
	}

	public function edit($isbn)
	{
		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$isbn'");

		$data = $query->getRow();

		if(empty($data))
		{
			return $this->failNotFound();
		}

		return $this->respond($data, 200);
	}

	public function create()
	{
		// data validation

		$isbn = $this->request->getVar('isbn');

		$title = $this->request->getVar('title');

		$author = $this->request->getVar('author');

		$validation = \Config\Services::validation();

		$rules = [
		    'isbn' => ['rules' => 'required'],
		    'title' => ['rules' => 'required'],
		    'author' => ['rules' => 'required'],
		];

		$validation->setRules($rules);

		if (!$validation->run(compact('isbn', 'title', 'author')))
		{
			return $this->failValidationError(array_values($validation->getErrors())[0]);
		}

        // check if exixts

		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$isbn'");

		$data = $query->getRow();

		if(!empty($data))
		{
			return $this->failResourceExists();
		}

		// insert in DB

		$sql = "INSERT INTO books (isbn, title, author) VALUES ('$isbn', '$title', '$author')";

		if($db->simpleQuery($sql))
		{
			return $this->respondCreated();
		}

		// if insert fails return error

		return $this->fail('');
	}

	public function update($bookIsbn)
	{
		// data validation

		$isbn = $this->request->getVar('isbn');

		$title = $this->request->getVar('title');

		$author = $this->request->getVar('author');

		$validation = \Config\Services::validation();

		$rules = [
		    'isbn' => ['rules' => 'required'],
		    'title' => ['rules' => 'required'],
		    'author' => ['rules' => 'required'],
		];

		$validation->setRules($rules);

		if (!$validation->run(compact('isbn', 'title', 'author')))
		{
			return $this->failValidationError(array_values($validation->getErrors())[0]);
		}

        // check if exixts

		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$bookIsbn'");

		$data = $query->getRow();

		if(empty($data))
		{
			return $this->failNotFound();
		}

		// update in DB

		if($db->simpleQuery("UPDATE books SET isbn = '$isbn', title = '$title', author = '$author' WHERE isbn = '$bookIsbn'"))
		{
			return $this->respondCreated();
		}

		// if insert fails return error

		return $this->fail('');
	}

	public function delete($bookIsbn)
	{
		// check if exixts

		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$bookIsbn'");

		$data = $query->getRow();

		if(empty($data))
		{
			return $this->failNotFound();
		}

		// update in DB

		if($db->simpleQuery("DELETE from books WHERE isbn = '$bookIsbn'"))
		{
			return $this->respondCreated();
		}

		// if insert fails return error

		return $this->fail('');
	}
}
