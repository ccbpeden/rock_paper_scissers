<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/RPS.php';

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(),
        array('twig.path'=>__DIR__.'/../views'));


    $app->get('/', function() use ($app) {


        return $app ['twig']->render('home.html.twig');
    });

    $app->post('/result', function() use ($app) {

        $new_game = new RPS($_POST['player1_input'],
        $_POST['player2_input']);
        $output = $new_game->turn($_POST['player1_input'],
        $_POST['player2_input']);

        return $app ['twig']->render('result.html.twig', array('new_game' => $output));
    });

    return $app;

?>
