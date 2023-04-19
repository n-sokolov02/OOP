**TODO CRUD REST API**

`GET /todo` - get todo list

`GET /todo/:id` - get todo by id

`POST /todo` - create todo

`PUT /todo/:id` - update todo

`DELETE /todo/:id` - delete todo

Todo model

```json
{
  "id": 0,
  "description": "",
  "completed": false
}
```

**Usage**

* install composer dependencies
* Run app by `php -S 0.0.0.0:8`
* run tests by `php vendor/bin/codecept run Api` 

**Goal**

Write appropriate methods in `app/api.php` so all tests are passed

*Note*: `POST`, `PUT` requests should return changed model
