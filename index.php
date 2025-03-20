<?php 

	session_start();

	require_once("vendor/autoload.php");

	use \Slim\Slim;
	use \Hcode\Page;
	use \Hcode\PageAdmin;
	use \Hcode\Model\User;

	$app = new Slim();

	$app->config('debug', true);

	$app->get('/', function() {
		
		$page = new Page(); // Instancia a classe e no construct, chama o Header;

		$page->setTpl("index"); // Chama o index, entre o Header e o Footer.

	}); // No final, quando a memória for ser limpada o desctruct é executado e é chamado Footer.


	$app->get('/admin', function() {

		User::verifyLogin();
		
		$page = new PageAdmin();

		$page->setTpl("index");

	});

	$app->get('/admin/login', function() {
		
		$page = new PageAdmin([
			"header" => false,
			"footer" => false
		]);

		$page->setTpl("login");

	}); 

	$app->post('/admin/login', function() {
		
		User::login($_POST['login'], $_POST['password']);

		header("Location: /admin");
		exit;

	}); 

	$app->get('/admin/logout', function() {

		User::logout();
		
        header("Location: /admin/login");
        exit;

	});

	$app->run();
?>