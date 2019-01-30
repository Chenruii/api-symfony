<?php
/**
 * Created by PhpStorm.
 * User: ruich
 * Date: 30/01/2019
 * Time: 15:07
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
        $this->assertCount(11, $arrayContent);
    }

    public function testPostUsers()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            '{"apiKey": "adqaaa","email": "test@behat.com"}'
        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);
    }


}