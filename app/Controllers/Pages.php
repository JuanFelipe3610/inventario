<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Pages extends Controller
{
	private $menu;

	public function __construct() {
		$menu = new MenuController('left');
		$menu->GenerateMenu();
		$this->menu = $menu;
	}
	
    public function index()
    {
		$page = 'dashboard';
		if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$data['title'] = ucfirst('Fast Inventory'); // Capitalize the first letter
		$data['menu'] = $this->menu;
		$data['winname'] = $page;
		echo view('templates/header', $data);
		echo view('pages/'.$page, $data);
		echo view('templates/footer', $data);
    }

    public function view($page = 'home')
    {
        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$data['title'] = ucfirst('Fast Inventory'); // Capitalize the first letter
		$data['menu'] = $this->menu;
		$data['winname'] = ucfirst($page);
		echo view('templates/header', $data);
		echo view('pages/'.$page, $data);
		echo view('templates/footer', $data);
    }
}