<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_teams_without_parameters()
    {
        $this->get('/api/v1/teams');

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'code',
                        'created_at',
                        'updated_at',
                    ]
                ],
            ],
            $this->response->getContent()
        );

        // $this->assertEquals(
        //     'TeamController@index', $this->response->getContent()
        // );
    }
}
