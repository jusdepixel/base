<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Generator;

/**
 * Class RegisterVisitorTest
 * @package App\Tests\Integration
 */
class RegisterVisitorTest extends WebTestCase
{
    public function testSuccessFormRegister()
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_visitor")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form([
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "john@doe.com",
            "visitor[plainPassword]" => "Password123*"
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
            $router->generate("register_visitor")
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
            "visitor[firstName]" => "",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "fail",
            "visitor[plainPassword]" => "Password123!"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => ""
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "email@email.com"
        ]];

        yield [[
            "visitor[firstName]" => "John",
            "visitor[lastName]" => "Doe",
            "visitor[email]" => "email@email.com",
            "visitor[plainPassword]" => "fail"
        ]];
    }
}
