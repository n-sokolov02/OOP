<?php

namespace Api;

use Codeception\Util\HttpCode;
use Tests\Support\ApiTester;

class TodoCest
{
    var $todo_id;
    // tests
    public function testCreate(ApiTester $I)
    {
        $newTodo = [
            "description" => 'test',
            "completed" => false
        ];

        $I->sendPost('/todos', $newTodo);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $I->seeResponseIsJson();

        list($id) = $I->grabDataFromResponseByJsonPath('$.id');

        $this->todo_id = $id;

        $I->seeResponseMatchesJsonType([
            'id' => 'integer|string',
            'description' => 'string',
            'completed' => 'boolean'
        ]);
    }

    public function testReadList(ApiTester $I) {
        $I->sendGet('/todos');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'id' => 'integer|string',
            'description' => 'string',
            'completed' => 'boolean'
        ]);
    }

    public function testRead(ApiTester $I) {
        $I->sendGet(sprintf('/todos/%s', $this->todo_id ?? 1));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'id' => 'integer|string',
            'description' => 'string',
            'completed' => 'boolean'
        ]);

        $I->seeResponseContainsJson(array('id' => $this->todo_id));
    }

    public function testUpdate(ApiTester $I) {
        $I->sendPut(sprintf('/todos/%s', $this->todo_id), [
            'completed' => true
        ]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'id' => 'integer|string',
            'description' => 'string',
            'completed' => 'boolean'
        ]);

        $I->seeResponseContainsJson(array('completed' => true));
    }

    public function testDelete(ApiTester $I) {
        $I->sendDelete(sprintf('/todos/%s', $this->todo_id));
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }
}
