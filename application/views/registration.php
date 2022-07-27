<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Registro</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>
			.modal-footer {   border-top: 0px; }
		</style>
	</head>
	<body>
	<!--login form-->
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
	      <div class="modal-header">
	          <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
	          <h1 class="text-center">Nueva Cuenta</h1>
			  <?php  
				if(!empty($success_msg)){ 
					echo '<p class="status-msg success">'.$success_msg.'</p>'; 
				}elseif(!empty($error_msg)){ 
					echo '<p class="status-msg error">'.$error_msg.'</p>'; 
				} 
			?>
	      </div>
	      <div class="modal-body">
	          <form class="form col-md-12 center-block" action="<?=base_url();?>users/registration" method="post">
                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" placeholder="Email" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required>
                    <?php echo form_error('email','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password" required>
                    <?php echo form_error('password','<p class="help-block">','</p>'); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="conf_password" class="form-control input-lg" placeholder="Confirmar Password" required>
                    <?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
                </div>
                <div class="send-button">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" name="enviar" value="Crear cuenta">
                </div>
	          </form>
              <p>Regresar a <a href="<?php echo base_url('/'); ?>">Inicio</a></p>
	      </div>
	      <div class="modal-footer ">
	          <div class="col-md-12">
	          <button class="btn hidden" data-dismiss="modal" aria-hidden="true">&nbsp;</button>
			  </div>	
	      </div>
	  </div>
	  </div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	</body>
</html>