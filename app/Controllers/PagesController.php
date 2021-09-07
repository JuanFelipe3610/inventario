<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use controller\session;

class PagesController extends Controller 
{
	private $menu;

	public function __construct()
	{
		$menu = new MenuController('left');
		//session::init();

		$menu->GenerateMenu();
		$this->menu = $menu;
	}

	public function index()
	{
		if (isset($_SESSION['session']) && $_SESSION['session'] == 1) {
			$page = 'dashboard';
			if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
				// Whoops, we don't have a page for that!
				throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
			}

			$data['title'] = ucfirst('Fast Inventory'); // Capitalize the first letter
			$data['menu'] = $this->menu;
			$data['winname'] = $page;
			$data['script'] = '';
			echo view('templates/header', $data);
			echo view('pages/' . $page, $data);
			echo view('templates/footer', $data);
		}else{
			$page = 'index';
			if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
				// Whoops, we don't have a page for that!
				throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
			}

			$data['title'] = ucfirst('Fast Inventory'); // Capitalize the first letter
			$data['menu'] = $this->menu;
			$data['winname'] = $page;
			$data['script'] = '';
			echo view('templates/index_header', $data);
			echo view('pages/' . $page, $data);
			echo view('templates/index_footer', $data);
		}
	}

	public function view($page = 'dashboard')
	{
		if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$data['title'] = ucfirst('Fast Inventory'); // Capitalize the first letter
		$data['menu'] = $this->menu;
		$data['winname'] = ucfirst($page);
		$data['script'] = '<script src="/resources/js/js/' . $page . '.js" ></script>';
		echo view('templates/header', $data);
		echo view('pages/' . $page, $data);
		echo view('templates/footer', $data);
	}
}
