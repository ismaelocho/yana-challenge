<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>Administración</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
<div class="container">
	<ul class="nav nav-tabs">
	<li role="presentation"><a href='<?php echo base_url('/admin/user_management')?>'>Usuarios</a></li>
	<li role="presentation"><a href='<?php echo base_url('/admin/user_activity_management')?>'>Actividades de Usuarios</a></li>
	<li role="presentation"><a href='<?php echo base_url('/useractivities/get_conversations').'/'.$this->session->userdata('userId')?>' target="_Blank">Historial JSON</a> </li>
	<li role="presentation"><a href='<?php echo base_url('/users/logout')?>'>Cerrar Sesion</a> </li>
	<li class="pull-right"><a href="<?php echo base_url('/admin')?>"><?php echo $this->session->userdata('userEmail');?></a></li>
	</ul>
	<div class="row"> 
		<div class="col" style="padding: 10px">
			<?php echo $output; ?>
		</div>
	</div>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
</div>
</body>
</html>
