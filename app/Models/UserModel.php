<?php 
    namespace App\Models;
    use CodeIgniter\Model;

    class UserModel extends Model {
        protected $table      = 'users';
        protected $primaryKey = 'id_user';
        protected $useAutoIncrement = true;

        protected $returnType     = 'object';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['nombre', 'apellido', 'usuario', 'correo', 'pass', 'img'];

        protected $useTimestamps = true;
        protected $createdField  = 'created';
        protected $updatedField  = 'updated';
        protected $deletedField  = 'deleted';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;

        public function login($user, $pass) {
            $this->join('type_user', 'id_type_user = type_user', 'Left');
            $this->where("(usuario = '$user' or correo = '$user')");
            $this->where("pass", $pass);
            return $this->find();
        }
    }
?>