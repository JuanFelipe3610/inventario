<?php 
    include_once(DIRNAME."/model/icons.php");
    class IconsController extends Icons{
        public function __construct() {
            parent::__construct();
        }
        
        public function gtIcons($font) {
            $icon = '';
            $data = $this->readForFont($font);
            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $icon .= (
                        "<div>
                            <i class='".$data[$key]['CASS']."'></i>
                            <p>".$data[$key]['CASS']."</p>
                        </div>"
                    );
                }
            }else{
                $icon = 'VACIO';
            }
            return $icon;
        }
    }  
?>