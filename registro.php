<?php
if(isset($_POST['submit'])){
    
    require_once 'includes/conexion.php';
    
    if(!isset($_SESSION)){
        session_start();
    }
    
    $nombre = isset($_POST['nombre']) ? mysqli_escape_string($db, $_POST['nombre'])  : null;
    $apellido = isset($_POST['apellido']) ? mysqli_escape_string($db, $_POST['apellido']) : null ;
    $email= isset($_POST['email']) ? mysqli_escape_string($db, $_POST['email']) : null;
    $passw= isset($_POST['password']) ? mysqli_escape_string($db, $_POST['password']) : null;

    var_dump($_POST);

    // array de errores
    $errores = array();

    
        //validacion de nombre
        if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
            $nombre_validado = true;
        }
        else
        {
            $nombre_validado = false;
            $errores['nombre'] = "El nombre no es validado";
        }

        //validacion de apellido
        if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
            $apellido_validado = true;
        }
        else
        {
            $apellido_validado = false;
            $errores['apellido'] = "El apellido no es validado";
        }

        //validacion de email
        if(!empty($email) &&  filter_var($email , FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
        }
        else
        {
            $email_validado = false;
            $errores['email'] = "El email no es validado";
        }

        if(!empty($passw)){
            $passw_validado = true;
        }
        else {
            $passw_validado = false;
            $errores['password'] = "El password no es validado";
        }

        
    $guardar_usuario = false;
    if(count($errores)== 0)
    {
        $guardar_usuario = true;
        
        //cifrar contraseña
        $password_segura = password_hash($passw, PASSWORD_BCRYPT, ['cost'=>4]);
        
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre','$apellido','$email','$passw', CURDATE())";
        
        $ingreso = mysqli_query($db, $sql);
        
        //var_dump(mysqli_error($db));
        //die;
        
        if ($ingreso) {
            $_SESSION['guardado']='El registro se ha guardado existosamente';
        }
        else{
            $_SESSION['errores']['general']= 'Fallo al guardar usuario';
        }
    }
    else
    {
        $_SESSION['errores'] = $errores;
       
    }
}

 header('location:index.php');