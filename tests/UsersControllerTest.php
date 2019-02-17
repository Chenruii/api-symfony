<?php
/**
 * Created by PhpStorm.
 * User: ruich
 * Date: 17/02/2019
 * Time: 13:11
 */

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UsersControllerTest extends WebTestCase
{
    public function testGetUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users', [], [], ['HTTP_ACCEPT' => 'application/json']);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);

        $arrayContent = \json_decode($content, true);
        $this->assertCount(10, $arrayContent);
    }

    public function testPostUsers()
    {
        $client = static::createClient();
        $client->request('POST', '/api/users', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => 'aaa'
            ],
            //'{"apiKey": "adqaaa","email": "test@behat.com"}'
            '{"apiKey": "teasting","email": "teasdaat@baehat.com"}'
        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($content);
    }
    public function testPatchUsers()
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/users/{email}', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => 'aaa'
            ],
            '{"firstname": "llal","lastname": "jkjdkf","apiKey": "teasting","birthday": "2019-01-01"}'
        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($content);
    }


}