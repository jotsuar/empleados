<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return $this->renderView('welcome_message');
		// return view('welcome_message');
	}
}
