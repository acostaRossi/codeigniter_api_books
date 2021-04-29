<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$title = 'Books';

		$db = db_connect();

		$query = $db->query('SELECT * FROM books');

		$res = $query->getResult();

		return view('home', compact('title', 'res'));
	}

	public function edit($isbn)
	{
		$title = 'Edit Book';

		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$isbn'");

		$res = $query->getRow();

		if(empty($res))
		{
			return redirect()->to("/books");
		}

		return view('edit', compact('title', 'res'));
	}

	public function update($isbn)
	{
		$db = db_connect();

		$query = $db->query("SELECT * FROM books WHERE isbn = '$isbn'");

		$res = $query->getRow();

		$title = $this->request->getVar('title');

		$author = $this->request->getVar('author');

		if(!empty($res))
		{
			if($db->simpleQuery("UPDATE books SET title = '$title', author = '$author' WHERE isbn = '$isbn'"))
			{
				return redirect()->to("/books/$isbn");
			}
		}

		$error = 'data not valid';

		return view('edit', compact('title', 'res', 'error'));
	}

	public function new()
	{
		$data = ['title' => 'New Book'];

		return view('create', $data);
	}

	public function create()
	{			
		$isbn = $this->request->getVar('isbn');

		$title = $this->request->getVar('title');

		$author = $this->request->getVar('author');

		$db = db_connect();

		$sql = "INSERT INTO books (isbn, title, author) VALUES ('$isbn', '$title', '$author')";

		if($db->simpleQuery($sql))
		{
			return redirect()->to("/books");
		}

		return redirect()->to("/books/create");
	}

}
