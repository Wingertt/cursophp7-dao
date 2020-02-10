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
                $row = $result[0];

                $this->setIdusuario($row['ID_usuario']);
                $this->setLogin($row['UsLogin']);
                $this->setSenha($row['Senha']);
                $this->setDtCadastro(new DateTime($row['DtCadastro']));
            }
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