<?php
    // Funcoe estaticas

    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }
//---------------------------- metodoos estaticos
     class funcoes{

        public static function VerificarLogin(){
            $resultado  = false; 
            if(isset($_SESSION['id_utilizador'])){
                $resultado = true; 
            }
            return $resultado; 
        } 

    //========================================
        public static function DestroiSessao(){
            unset($_SESSION['id_utilizador']);
            unset($_SESSION['nome']); 
        }

    //=======================================
        public static function IniciarSessao($dados){
            //Iniciar a sessao
            $_SESSION['id_utilizador'] = $dados[0]['id_utilizador']; 
            $_SESSION['nome'] = $dados[0]['nome']; 
        }

}
   
       



?>