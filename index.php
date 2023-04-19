<?php
require_once './app/api.php';

$method = $_SERVER['REQUEST_METHOD'];

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if(preg_match('/\/api\/v1\/todos\/?(?P<id>\w*)/', $request_uri, $matches)) {
    list('id' => $id) = $matches;
}

$respond = '';
$status_code = 200;

switch ($method) {
    case 'GET':
        if ($id) {
            $respond = readTodo($id);
        } else {
            $respond = listTodo();
        }
        break;
    case 'POST':
        $respond = createTodo($_REQUEST);
        $status_code = 201;
        break;
    case 'PUT':
        $putData = [];
        parse_str(file_get_contents("php://input"), $putData);
        $respond = editTodo($id, $putData);
        break;
    case 'DELETE':
        if (deleteTodo($id)) {
            $status_code = 204;
            $respond = null;
        } else {
            $status_code = 404;
        }

}


header('Content-type: application/json', true, $status_code);
echo json_encode($respond);
