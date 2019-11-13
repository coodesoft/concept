<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset= "<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title(); ?></title>
  <!-- Definir viewport para dispositivos web móviles -->
  <meta name="viewport" content="width=device-width, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  <link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa|Noto+Sans+KR|Open+Sans" rel="stylesheet">
  <?php wp_head(); ?>
</head>
