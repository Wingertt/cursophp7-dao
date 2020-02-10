<?php

    class Usuario
    {
        private $id_usuario;
        private $usLogin;
        private $Senha;
        private $DtCadastro;

        public function getIdusuario()
        {
            echo "ID=".$this->id_usuario;
            return $this->id_usuario;
        }

        public function setIdusuario($value)
        {
            $this->id_usuario = $value;
        }

        public function getLogin()
        {
            echo "login=".$this->usLogin;
            return $this->usLogin;
        }

        public function setLogin($value)
        {
            $this->usLogin = $value;
        }

        public function getSenha()
        {
            return $this->Senha;
        }

        public function setSenha($value)
        {
            $this->Senha = $value;
        }

        public function getDtCadastro()
        {
            return $this->DtCadastro;
        }

        public function setDtCadastro($value)
        {
            $this->DtCadastro = $value;
        }


        public function loadByID($ID)
        {

            $sql = new Sql();

            $result = $sql->Select("SELECT * FROM usuarios2 WHERE ID_usuario = :ID",array(
                ":ID"=>$ID
            ));

            if(count($result)>0)
            {
                $this->setData($result[0]);    
            }
        }

        public static function getList()//static dis q n precisa-se instanciar um objeto;
        {

            $sql = new Sql();

           return $sql->Select("SELECT * FROM  usuarios2 ORDER BY usLogin");

        }

        public static function search($login)
        {
            $sql = new Sql();

            return $sql->Select("SELECT * FROM usuarios2 WHERE usLogin LIKE :SEARCH ORDER BY usLogin",array(
                ':SEARCH'=>'%'.$login.'%'//entre % diz q pode estar escrito entre qualquer coisa
            ));
        }

        public function login($login,$password)
        {
            $sql = new Sql();

            $result = $sql->Select("SELECT * FROM usuarios2 WHERE usLogin = :LOGIN AND Senha = :PASSWORD",array(
                ":LOGIN"=>$login,
                ":PASSWORD"=>$password
            ));

            if(count($result)>0)
            {
                $this->setData($results[0]);    
            }else
            {
                throw new Exception("Login e/ou senha inválidos.");
                
            }
        }

        public function setData($data)
        {
            $this->setIdusuario($data['ID_usuario']);
            $this->setLogin($data['UsLogin']);
            $this->setSenha($data['Senha']);
            $this->setDtCadastro(new DateTime($data['DtCadastro']));
        }

        public function Insert()
        {
            $sql =new Sql();

            $results = $sql->Select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)", array(
                ':LOGIN'=>$this->getLogin(),
                ':PASSWORD'=>$this->getSenha()
            ));

            if(count($results)>0)
            {
                $this->setData($results[0]);    
            }
        }

        public function Update($login,$password)
        {
            $this->setLogin($login);
            $this->setSenha($password);


            $sql = new Sql();

            $sql->query("UPDATE usuarios2 SET usLogin = :LOGIN, Senha= :PASSWORD where ID_usuario = :ID",array(
                ':LOGIN'=>$this->getLogin(),
                ':PASSWORD'=>$this->getSenha(),
                ':ID'=>$this->getIdusuario()
            ));
        }


        public function __construct($login = "",$password = "")
        {
            $this->setLogin($login);
            $this->setSenha($password);
        }

        public function __toString()
        {
            return json_encode(array(
                "ID_usuario"=>$this->getIdusuario(),
                "UsLogin"=>$this->getLogin(),
                "Senha"=>$this->getSenha(),
                "DtCadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
            ));
        }

    }

?>