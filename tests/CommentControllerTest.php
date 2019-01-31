<?php
/**
 * Created by PhpStorm.
 * User: ruich
 * Date: 31/01/2019
 * Time: 09:53
 *
 *
 *
 * ce test permet de reinitialiser chaque test dans un etat connu , ici dans le cas de fixture
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentControllerTest extends WebTestCase
{
    public function setUp()
    {
        parent::setup();
        $fixtures = array(
            'AppBundle\DataFixtures\ORM\LoadUserData',
            'Acme\Bundle\ApiBundle\DataFixtures\ORM\LoadUserCommentData',
        );
        $this->loadFixtures($fixtures);
    }



}