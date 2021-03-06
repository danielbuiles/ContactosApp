<?php
    class Base_Datos
    {
        public $Usuario='root';
        public $password='';
        public function Conexion_DB(){
            try 
            {
                $Datos='mysql:host=localhost;dbname=guardarlinks';
                $Conexion=new PDO($Datos,$this->Usuario,$this->password);
                return $Conexion;
            } 
            catch (PDOException $Error) 
            {
                echo($Error.getMessage());
            }
        }
        public function RegistrarUsuarioDB($ConsultaSQL){
            try 
            {
                $Base=$this->Conexion_DB();

                $Lanzar=$Base->prepare($ConsultaSQL);

                $ejecutor=$Lanzar->execute();
            } 
            catch (PDOException $Error) 
            {
                echo ($Error.getMessage());
            }
        }
        public function BuscarDatos($ConsultaSQL){
            try 
            {
                $Conectar=$this->Conexion_DB();

                $Preparo=$Conectar->prepare($ConsultaSQL);

                $Preparo->setFetchMode(PDO::FETCH_ASSOC);

                $Ejecucion=$Preparo->execute();

                return($Preparo->fetchAll());
            }
            catch (PDOException $Error) 
            {
                echo ($Error.getMessage());
            }
        }
        public function EliminarDatos($ConsultaSQL)
        {
            try 
            {
                $Conectar=$this->Conexion_DB();

                $Preparo=$Conectar->prepare($ConsultaSQL);

                $Ejecute=$Preparo->execute();
            } 
            catch (PDOException $Error) 
            {
                echo ($Error.getMessage());
            }
        }
        public function EditarUsuario($ConsultaSQL)
        {
            try 
            {
                $Conexion = $this->Conexion_DB();

                $Prepare = $Conexion->prepare($ConsultaSQL);

                $execute = $Prepare->execute();
            } 
            catch (PDOException $Error)
            {
                echo($Error.getMessage());
            }
        }
    }
?>