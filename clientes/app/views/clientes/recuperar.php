<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<title><?=$titulo?></title>
        
        <link href="<?=base_url();?>css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?=base_url();?>css/signin.css" rel="stylesheet">
        
</head>
    <body>
        <div class="container">
            
             <?php echo form_open('recuperar_clave',array("class"=>"form-signin"));?>

                <h2 class="form-signin-heading">Recuperar Contraseña</h2>
                <?php 
                if(isset($error)){
                    echo $error; 
                }
                ?>
                <div class="alert alert-success alert-dismissable">Para recuperar tu contraseña, escribe tu correo y te enviaremos un link para cambiar la clave.</div>
                <label for="txtCorreo" >Correo</label><input type='mail' name='txtCorreo'  class="form-control" required autofocus>
 
                <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>

            </form>
            
            </div>
    </body>
</html>