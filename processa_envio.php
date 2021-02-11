<?php 
 print_r($_POST);


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
    eu vou utiliar -> e na sequencia executar o metodo __set para setar os valores */
    $mensagem-> __set('para', $_POST['para']);
    $mensagem-> __set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);
    // dessa forma criamos um objeto com base nos dados recebidos no formulario
    
    /*agora podemos executar o metodo "mesagemValida() atravéz da variavel mensagem
     que armazena a intancia do objeto*/

     $mensagem->mensagemValida();


?>