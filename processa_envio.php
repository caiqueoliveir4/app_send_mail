<?php
// requerindo bibliotecas do PHPMailor 
    require "bibliotecas/PHPMailer/Exception.php";
    require "bibliotecas/PHPMailer/OAuth.php";
    require "bibliotecas/PHPMailer/PHPMailer.php";
    require "bibliotecas/PHPMailer/POP3.php";
    require "bibliotecas/PHPMailer/SMTP.php";

    // usando o "use" para estrair o recuros do namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    
  
     


// criando classe 
    class Mensagem {
        // criando atributos privados para está classe 
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        /*criando os metodos ou funções magicas get e set para essa classe "Mensagem"
        */
        public function __get($atributos) {
            return $this->$atributos;
        }
        public function __set($atributos, $valor) {
            $this->$atributos = $valor;
        }
        // criando metodos ou função "mensagemValida()"
        public function mensagemValida() {
            // validar os dados para verifcar se são verdadeiros ou não
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
                // se for vazio então
                return false;
            }
            // caso contrario retorne
            return true;
        }
    }

    // criar uma variavel e atribuir a ela uma  instancia dessa classe "Mensagem"
    $mensagem = new Mensagem();
    /* apartir da variavel "mensagem que isntancia meu objeto",
    eu vou utiliar "->" e na sequencia executar o metodo __set para setar os valores */
    $mensagem-> __set('para', $_POST['para']);
    $mensagem-> __set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);
    // dessa forma criamos um objeto com base nos dados recebidos no formulario
    
    /*agora podemos executar o metodo "mesagemValida() atravéz da variavel mensagem
     que armazena a intancia do objeto*/

     If(!$mensagem->mensagemValida()) {
        echo 'Mensagem não é valida';
        die();
     }

     $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'caiquetube@gmail.com';                     // SMTP username
    $mail->Password   = 'xxxxxxxxxxx';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('caiquetube@gmail.com', 'Caique');
    $mail->addAddress($mensagem->__get('para'));     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto');
    $mail->Body    = $mensagem->__get('mensagem');
    $mail->AltBody = 'É necessário utilizar um cliente que suporte HTML para ter total acesso ao conteúdo dessa mensagem';

    $mail->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>