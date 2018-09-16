<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    class emails{
        // =========================================================
        /*
            PARA QUEM 
            ASSUNTO
            MENSAGEM
        */
        public function EnviarEmail($dados){ 
            //DADOS[0] = ENDERECO DO EMAIL DO DESTINATRIO
            //DADOS[1] = ASSUNTO
            //DADOS[2] = MENSAGEM
            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';
            
            //Configuracoes
            $config = include('inc/config.php');

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPOptions = array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                    )
                );

            $mail->isHTML();
            $mail->SMTPDebug = $config['MAIL_DEBUG'];
            $mail->Host = $config['MAIL_HOST'];
            $mail->Port = $config['MAIL_PORT']; 
            $mail->SMTPAuth = true; 
            $mail->Username = $config['MAIL_USERNAME'];
            $mail->Password = $config['MAIL_PASSWORD'];
            $mail->setFrom ($config['MAIL_FROM'], 'SPACET');
            $mail->addAddress($dados[0], $dados[0]);
            $mail->CharSet = "UTF-8";
            //assunto
            $mail->Subject = $dados[1];
            //mensagem
            $mail->Body = $dados[2];               
            //envio da mensagem
            $enviada = false;
            if($mail->send()){ $enviada = true; }
            return $enviada;
    }
    
     // =========================================================
     //enviar emails para clientes validar a sua conta
}


?>