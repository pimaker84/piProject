<?php

/* 
 * In theory, REST is not tied to the web, but its almost always implemented as such, and was inspired by HTTP.
 * As a result, REST can be used wherever HTTP can.
 * 
 * code ref: http://codewiz.biz/article/post/guide+to+building+a+rest+api+with+php+and+apache
 */

require_once ('../functions/functions.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$app = new \Slim\App;

//API function:POST:Login
$app->post('/login', function(Request $request, Response $response) use ($app)
{
    //decode JSON data into object and assign its proteprties into $user variable for further usage
    $tmp = json_decode($request->getBody());
    $user['login'] = $tmp->username;
    $user['pass'] = $tmp->password;

    //set output header: content-type
    $newresponse = $response->withHeader('Content-type', 'application/json');

    //try login
    $loginresult = login($user['login'], $user['pass']);
    if($loginresult !== false)
    {
        //login successful
        //encode token and other user data and send them to client
        $output = json_encode(array("token" => $loginresult['token'], 'user_id' => $loginresult['user_id']));
        $newresponse = $newresponse->withStatus(200);
        $body = $newresponse->getBody();
        $body->write($output);
    }
    else
    {
        //login unsuccessful
        $newresponse = $newresponse->withStatus(401);
    }
    return $newresponse;
}); 


//API function:GET:Get file list
$app->get('/getfilelist/{token}/{user_id}', function (Request $request, Response $response, $args) use ($app)
{
    //set output header: content-type
    $newresponse = $response->withHeader('Content-type', 'application/json');

    //check if token is expired or invalid
    if(!checktoken($args['user_id'], $args['token']))
    {
        //request not authorised
        $newresponse = $newresponse->withStatus(401);
        //return $newresponse;
        return $newresponse;
    }

    $tmp = json_encode(scandirectory("."));
    $newresponse->getBody()->write($tmp);
    return $newresponse;
});

//API function:GET:Download specific file
$app->get('/getfile/{id}/{token}/{user_id}', function (Request $request, Response $response, $args) use ($app)
{
    //set output header: content-type
    $newresponse = $response->withHeader('Content-type', 'application/json');

    //check if token is expired or invalid
    if(!checktoken($args['user_id'], $args['token']))
    {
        //request not authorised
        $newresponse = $newresponse->withStatus(401);
        //return $newresponse;
        return $newresponse;
    }

    //id is id of file from database
    //here you should put functionality for getting file path from database by id
    $filepath = "./download/test.jpg"; //setting test value 

    //set output headers
    //content headers
    $newresponse = $newresponse->withHeader('Content-type', 'application/octet-stream'); //rewriting content type from application/json to application/octet-stream for sending file
    $newresponse = $newresponse->withHeader('Content-Description', 'File Transfer');
    $newresponse = $newresponse->withHeader('Content-Disposition', 'attachment; filename=' . basename($filepath));
    $newresponse = $newresponse->withHeader('Content-Length', filesize($filepath));
    $newresponse = $newresponse->withHeader('Content-Transfer-Encoding', 'binary');
    //other headers
    $newresponse = $newresponse->withHeader('Expires', '0');
    $newresponse = $newresponse->withHeader('Cache-Control', 'must-revalidate');
    $newresponse = $newresponse->withHeader('Pragma', 'public');
    
    //clean buffers and send file content to output

    $newstream = new \GuzzleHttp\Psr7\LazyOpenStream($filepath, 'r');
    $newresponse = $newresponse->withBody($newstream);
    return $newresponse;
});


$app->run();