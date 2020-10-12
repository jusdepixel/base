<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Generator;

/**
 * Class RegisterAdminTest
 * @package App\Tests\Integration
 */
class RegisterAdminTest extends WebTestCase
{
    public function testSuccessFormRegister()
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_admin")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form([
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "john@doe.com",
            "admin[plainPassword]" => "Password123*"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider provideBadRegister
     * @param array $formData
     */
    public function testBadFormRegister(array $formData)
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_admin")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form($formData);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    /**
     * @return Generator
     */
    public function provideBadRegister(): Generator
    {
        yield [[
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];
        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "fail",
            "admin[plainPassword]" => "Password123!"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => ""
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com"
        ]];

        yield [[
            "admin[pseudo]" => "Pseudo",
            "admin[firstName]" => "John",
            "admin[lastName]" => "Doe",
            "admin[email]" => "email@email.com",
            "admin[plainPassword]" => "fail"
        ]];
    }
}
