<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Inicio</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style>
			.modal-footer {   border-top: 0px; }
		</style>
	</head>
	<body>
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
	      <div class="modal-header">
	          <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
	          <h1 class="text-center">Acceso</h1>
			  <?php  
				if(!empty($success_msg)){ 
					echo '<p class="status-msg success">'.$success_msg.'</p>'; 
				}elseif(!empty($duplicate_email)){ 
					echo '<p class="status-msg error">'.$duplicate_email.'</p>'; 
				}elseif(!empty($error_msg)){ 
					echo '<p class="status-msg error">'.$error_msg.'</p>'; 
				} 
			?>
	      </div>
	      <div class="modal-body">
	          <form class="form col-md-12 center-block" action="<?=base_url();?>users/login" method="post">
	            <div class="form-group">
	              <input type="text" name="email" class="form-control input-lg" placeholder="Email">
				  <?php echo form_error('email','<p class="help-block">','</p>'); ?>
				</div>
	            <div class="form-group">
	              <input type="password" name="password" class="form-control input-lg" placeholder="Password">
	            </div>
	            <div class="form-group">
	              <button class="btn btn-primary btn-lg btn-block" type="submit" name="enviar">Entrar</button>
	              <span class="pull-right"><?php if(isset($error)) echo "<b><span style='color:red;'>$error</span></b>"; ?></span>
	            </div>
	          </form>
			  <p>¿No tienes una cuenta? <a href="<?php echo base_url('users/registration'); ?>">Registro</a></p>
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