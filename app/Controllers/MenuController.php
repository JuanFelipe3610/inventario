<?php 
    namespace controller;
    use model\Menu;
    use \DOMDocument;

    class MenuController extends Menu{
        private $menu;
        private $labels = array();
        private $data;

        public function __construct($menu) {
            parent::__construct();
            $this->data = $this->GetMenu($menu);
        }

        private function CreateNavMenu($class = null) {
            $labels = '';
            foreach ($this->labels as $key => $value) {
                $labels .= $value; 
            }
            $ul = '<ul class="'.$class.'">'.$labels.'</ul>';
            $nav = '<nav>'.$ul.'</nav>';
            return $nav;
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

        public function AppenedLabelAfter($class = '', $id = '', $url = '', $classIcon = '', $name = '', $submenu = '') {
            $labels = array();
            $labels[0] = $this->CreateLabelMenu($class, $id, $url, $classIcon, $name, $submenu);
            foreach ($this->labels as $key => $value) {
                $labels[$key+1] = $value;
            }
            $this->labels = $labels;
        }
        
        public function GenerateMenu($menu = null) {
            $data = $this->data;
            $labels = array();
            if ($data != 'error') {
                foreach ($data as $obj) {
                    $uri = str_replace('.php', '', basename($_SERVER['PHP_SELF']));
                    ($uri == $obj->URL) ? $class = 'active' : $class = '';
                    (isset($obj->SUBMENU)) ? $submenu = $obj->SUBMENU : $submenu = '';
                    $this->labels[] = $this->CreateLabelMenu($class, '', $obj->URL, $obj->ICON, $obj->NOMBRE, $submenu);
                }
            }            
        }

        public function ShowMenu($ulClass = null) {
            $this->menu = $this->CreateNavMenu($ulClass);
            echo $this->menu;
        }

        public function GetLabels() {
            return $this->labels;
        }
    }  
?>