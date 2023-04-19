**TODO CRUD REST API**


`GET localhost:8080/api/v1/todos` - get todo list

`GET localhost:8080/api/v1/todos/:id` - get todo by id

`POST localhost:8080/api/v1/todos` - create todo

`PUT localhost:8080/api/v1/todos/:id` - update todo

`DELETE localhost:8080/api/v1/todos/:id` - delete todo

Todo model

```json
{
  "id": 0,
  "description": "",
  "completed": "0"
}
```

**Usage**

* install composer dependencies
* Run app by `php -S localhost:8080`
* run tests by `php vendor/bin/codecept run Api` 

**Goals**

* Fork repo
* Write appropriate methods in `app/api.php` so all tests are passed
* Commit changes to forks taking into account gitflow
* Create PR to main repo and assign repo owner as reviewer

*Note*: `POST`, `PUT` requests should return changed model
