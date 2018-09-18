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
            unset($_SESSION['permissoes']); 
        }

    //=======================================
        public static function IniciarSessao($dados){
            //Iniciar a sessao
            $_SESSION['id_utilizador'] = $dados[0]['id_utilizador']; 
            $_SESSION['nome'] = $dados[0]['nome']; 
            $_SESSION['permissoes']= $dados[0]['permissoes'];
        }

        public static function CriarCodigoAlfanumerio($numChars){
            // Criar codigo aleatorio alfanumerico
            $codigo = '';
            $caracteres = 'abcdefghijklmnopqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789!()-%';
                for($i = 0; $i<$numChars; $i++){
                    $codigo .= substr($caracteres,rand(0, strlen($caracteres)) , 1); 
                }
            return $codigo;


        }
        //=================================================================
        public static function CriarLOG($mensagem ,$utilizador){
            // Cria um registro em LOGS
            $gestor = new cl_gestorBD(); 
            $data_hora = new DateTime();
            $parametros = [
                ':data_hora'       => $data_hora->format('Y-m-d H:i:s'),
                ':utilizador'      => $utilizador, 
                ':mensagem'        => $mensagem
            ];

            $gestor->EXE_NON_QUERY(
                'INSERT INTO logs(data_hora, utilizador, mensagem)
                 VALUES (:data_hora, :utilizador, :mensagem)',$parametros);

            }


            public static function Permissao($index){
                // Verifica se o utilizador com sess ativa 
                if(substr($_SESSION['permissoes'],$index,1) ==1){
                    return true; 
                }else{
                    return false; 
                }
            }
    }
   
?>