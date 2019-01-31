<?php
/**
 * Created by PhpStorm.
 * User: ruich
 * Date: 30/01/2019
 * Time: 15:07
 */

namespace App\tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ArticlesControllerTest extends WebTestCase
{
    public function testGetArticles()
    {
        $client = static::createClient();
        $client->request('GET', '/api/articles', [], [], ['HTTP_ACCEPT' => 'application/json']);

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($content);

        $arrayContent = \json_decode($content, true);
        $this->assertCount(10, $arrayContent);
    }

    public function testPostArticles()
    {
        $client = static::createClient();
        $client->request('POST', '/api/articles', [], [],
            [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-AUTH-TOKEN' => 'aaa'
            ],
            '{"name": "lorem","description": "blablabla","createAt":"2019-01-01"}'

        );
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($content);
    }
}