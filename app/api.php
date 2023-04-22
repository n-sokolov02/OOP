<?php
require_once 'storage.php';

$blank_todo = [
    'id' => 0,
    'description'=> '',
    'completed' => "0"
];

/**
 * Read list of items
 *
 * @return array
 */
function listTodo(): array {
    return read_data();
//  return json_decode(file_get_contents('./data.json'), true);
}

/**
 * Create and return item
 *
 * @param $todoData mixed
 * @return mixed
 */
function createTodo (mixed $todoData): mixed {
    global $blank_todo;
    $all_todos = read_data();
    $new_todo = array_merge($blank_todo, $todoData);
    $new_todo['id'] = uniqid();
    $all_todos[] = $new_todo;
    write_data($all_todos);
    return $new_todo;
}

/**
 * Edit and return item by id
 *
 * @param $todoId
 * @param $todoData
 * @return mixed
 */
function editTodo($todoId, $todoData) {
    $all_todos = read_data();
    $current_id = array_search($todoId, array_column($all_todos, 'id'));
    $current_todo = $all_todos[$current_id];
    $changed_todo = array_merge($current_todo, $todoData);
    $all_todos[$current_id] = $changed_todo;
    write_data($all_todos);
    return $changed_todo;
}

/**
 * Read item by id
 *
 * @param $todoId
 * @return void
 */
function readTodo($todoId) {
    $all_todos = read_data();
    $current_id = array_search($todoId, array_column($all_todos, 'id'));
    $current_todo = $all_todos[$current_id];
    if (array_key_exists($current_id, $all_todos)) {
     return $current_todo;
    }
    return false;
}


/**
 * Delete item
 *
 * @param $todoId
 * @return bool
 */
function deleteTodo($todoId) {
    $all_todos = read_data();
    $current_id = array_search($todoId, array_column($all_todos, 'id'));

    if ($current_id !== false)
    {
        unset($all_todos[$current_id]);
        write_data($all_todos);
        return true;
    } else {return false;}
}
