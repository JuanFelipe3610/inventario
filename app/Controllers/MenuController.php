<?php 
    namespace App\Controllers;
    use App\Models\MenuModel;
    use \DOMDocument;

    class MenuController extends MenuModel{
        private $menu;
        private $labels = array();
        private $data;
        private $page;

        public function index($page)
        {
            $this->page = $page;
        }

       private function CreateNavMenu($class = null) {
            $label = '';
            foreach ($this->labels as $value) {
                $label .= $value; 
            }
            $ul = '<ul class="'.$class.'">'.$label.'</ul>';
            return '<nav>'.$ul.'</nav>';
        }

        private function CreateLabelMenu($class, $id, $url, $classIcon, $name, $submenu = null){
            $DOM = new DOMDocument('1.0', 'utf-8');
            $a = $DOM->createElement('a');
            if($url == null){
                $li = $DOM->createElement('li', $name);
            }else{
                $li = $DOM->createElement('li');
                $li->appendChild($a);
            }

            $a->appendChild($i = $DOM->createElement('i'));
            $a->appendChild($DOM->createElement('span', $name));
            $i->setAttribute('class', $classIcon);
            $li->setAttribute('class', $class);

            if ($submenu == null || $submenu == '') {
                $a->setAttribute('href', $url);                
            }else{
                $div = $DOM->createElement('div');
                $div->setAttribute('class', 'submenu');
                $a->appendChild($i = $DOM->createElement('i'));
                $i->setAttribute('class', 'fa fa-caret-down');
                foreach ($submenu as $value) {
                    $a = $DOM->createElement('a');
                    $a->setAttribute('href', $value->URL);
                    $a->appendChild($i = $DOM->createElement('i'));
                    $i->setAttribute('class', $value->ICON);
                    $a->appendChild($DOM->createElement('span', $value->NOMBRE));
                    $div->appendChild($a);
                }
                $li->appendChild($div);
            }
            $DOM->appendChild($li);
            return $DOM->saveHTML();
        }
        
        private function GenerateMenu() {
            $this->labels = [];
            if ($this->data != 'error') {
                foreach ($this->data as $obj) {
                    ($this->page == $obj->URL) ? $class = 'active' : $class = '';
                    (isset($obj->SUBMENU)) ? $submenu = $obj->SUBMENU : $submenu = '';
                    $this->labels[] = $this->CreateLabelMenu($class, '', $obj->URL, $obj->ICON, $obj->NOMBRE, $submenu);
                }
            }            
        }

        public function ShowMenu($ulClass = null, $type = null) {            
            $this->data = $this->wherePosition($type);
            $this->GenerateMenu();   
            $this->menu = $this->CreateNavMenu($ulClass);
            echo $this->menu;
        }
    }  
?>