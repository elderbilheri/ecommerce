<?php 
	require_once("vendor/autoload.php");

	use \Slim\Slim;
	use \Hcode\Page;

	$app = new Slim();

	$app->config('debug', true);

	$app->get('/', function() {
		
		$page = new Page(); // Instancia a classe e no construct, chama o Header;

		$page->setTpl("index"); // Chama o index, entre o Header e o Footer.

	}); // No final, quando a memória for ser limpada o desctruct é executado e é chamado Footer.

	$app->run();
?>