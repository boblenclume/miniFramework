<?php

require __DIR__ . '/../vendor/autoload.php';
use Model\LocationFinder;
use Model\Entities\Location;
use Model\CommentFinder;
use Model\Entities\Comment;
use Http\Request;
use Http\Response;
use Http\JsonResponse;
use Exception\HttpException;
use DAL\Connection;
use Model\LocationDataMapper;

// Config
$debug = true;
$database = 'mysql:host=localhost;dbname=uframework';
$user = 'root';
$password = 'toto';
//$user = 'uframework';
//$password = 'uframework123';

$con = new Connection($database, $user, $password);


$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Index
 */
$app->get('/', function () use ($app) {
    return $app->render('index.php');
});

// GET Locations
$app->get('/locations', function (Request $request) use ($app, $con) 
{
	$locations = new LocationFinder($con);
	$allLocations = $locations->findAll();
    if ($request->guessBestFormat() === 'json') {   
    	return new JsonResponse($allLocations);   
    }
    return $app->render('locations.php', array('locations' => $allLocations));
});

// GET Location
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
		$locations = new LocationFinder($con);
		$loc = $locations->findOneById($id);
		if ($loc === null){
			throw new HttpException(404, "Object doesn't exist");
		}
	
		 if ($request->guessBestFormat() === 'json') {   
		    	return new JsonResponse($allLocations);   
		   }			
		
		return $app->render('location.php', array('location' => $loc));	
});


// GET Comment of Location
$app->get('/locations/(\d+)/comments', function (Request $request, $id) use ($app, $con) {
		$locations = new LocationFinder($con);
		$loc = $locations->findOneById($id);
		if ($loc === null){
			echo "Object doesn't exist";
			throw new HttpException(404, "Object doesn't exist");
		}

		$comments = $loc->getComments();

		return new JsonResponse($comments);   
});

// POST Locations
$app->post('/locations', function (Request $request) use ($app, $con) {
	$location = new Location();
	$name = $request->getParameter('name');
	
	if (empty($name)){
			throw new HttpException(418, "No Value");
		}
		
	$location->setName($name);
	
	$locationMapper = new LocationDataMapper($con);
	$locationMapper->persist($location);

	if ($request->guessBestFormat() === "json"){
		return new JsonResponse($locations->create($name), 201);
	}
	
	$app->redirect('/locations');
});
	
// PUT Location
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
		$locations = new LocationFinder($con);
		$loc = $locations->findOneById($id);
		if ($loc === null){
			echo "Object doesn't exist";
			throw new HttpException(404, "Object doesn't exist");
		}

		$name = $request->getParameter('name');
	
		if (empty($name)){
				throw new HttpException(418, "No Value");
			}
			
		$loc->setName($name);
		
		$locationMapper = new LocationDataMapper($con);
		$locationMapper->persist($loc);
		
		if ($request->guessBestFormat() === "json"){
			return new JsonResponse($locations->update($id,$name), 201);
		}
		
		$app->redirect('/locations');
});

// DELETE Location
$app->delete('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
		$locations = new LocationFinder($con);
		$loc = $locations->findOneById($id);
		if ($loc === null){
			echo "Object doesn't exist";
			throw new HttpException(404, "Object doesn't exist");
		}		
		$locationMapper = new LocationDataMapper($con);
		$locationMapper->remove($loc);

		$app->redirect('/locations');
});

return $app;
