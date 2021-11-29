<?php

namespace App\Controllers;
class PagesController extends BaseController 
{
	private $menu;

	public function __construct()
	{
		$this->menu = new MenuController('left');
		$this->menu->GenerateMenu();				
	}

	public function index()
	{
		$this->view();
	}

	public function view($page = 'dashboard', $controllerData = array(), $pageData = [])
	{
		if (isset($this->session->logged_in) && $this->session->logged_in == 1) {
			if ($page == 'login') {
				header('Location: dashboard');
			}	
			if(empty($pageData)){
				$pageData = [
					'name' => $page,
					'Header' => 'header',
					'Footer' => 'footer'
				];
			}			
			$this->loadPage($pageData, '<script src="/resources/js/js/' . $page . '.js" ></script>', $controllerData);
		}else if($page != 'login'){		
			header('Location: login');
		}else{
			$this->loadPage($pageData, '<script src="/resources/js/js/' . $page . '.js" ></script>', $controllerData);
		}
	}

	private function loadPage($pageData, $script = "", $controllerData = []){
		if (!is_file(APPPATH . '/Views/pages/' . $pageData['name'] . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($pageData['name']);
		}

		$data['title'] = ucfirst('Fast Inventory | '.$pageData['name']); // Capitalize the first letter
		$data['menu'] = $this->menu;
		$data['winname'] = $pageData['name'];
		$data['script'] = $script;
		$data['controllerData'] = $controllerData;
		echo view('templates/'. $pageData['Header'], $data);
		echo view('pages/' . $pageData['name'], $data);
		echo view('templates/'. $pageData['Footer'], $data);
	}
}
