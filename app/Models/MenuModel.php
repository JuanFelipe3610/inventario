<?php 
namespace App\Models;
use CodeIgniter\Model;

class MenuModel extends Model {
    protected $table      = 'menu';
    protected $primaryKey = 'id_menu';
    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'url', 'icon', 'position', 'orden', 'img'];

    protected $useTimestamps = true;
    protected $createdField  = 'created';
    protected $updatedField  = 'updated';
    protected $deletedField  = 'deleted';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function readAll() {
        return $this->findAll();
    }

    public function wherePosition($position) {
        $data = [];
        $this->where('position', $position);
        $stmt = $this->findAll();
        foreach($stmt as $row) {
            $data[] = (object)array(
                'ID'      => $row->id_menu,
                'NOMBRE'  => $row->nombre,
                'URL'	  => $row->url,
                'ICON'	  => $row->icon
            );
        }
        return $data;
    }
}
?>