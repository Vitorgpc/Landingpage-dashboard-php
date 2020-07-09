<?php
    session_start();
    $autoLoad = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/PHPMailerAutoLoad.php');
        }
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoLoad);

    define('INCLUDE_PATH', 'http://localhost/Curso%20WebCompleto/Projeto_01/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'projeto_01');

    function pegaCargo($cargo){
        $arr = [
            '0' => 'Normal',
            '1' => 'Sub Administrador',
            '2' => 'Administrador'
        ];

        return $arr[$cargo];
    }
?>