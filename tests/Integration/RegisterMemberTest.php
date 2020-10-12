<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Generator;

/**
 * Class RegisterMemberTest
 * @package App\Tests\Integration
 */
class RegisterMemberTest extends WebTestCase
{
    public function testSuccessFormRegister()
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_member")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form([
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "john@doe.com",
            "member[plainPassword]" => "Password123*"
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
            $router->generate("register_member")
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
            "member[firstName]" => "",
            "member[lastName]" => "Doe",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[lastName]" => "Doe",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "fail",
            "member[plainPassword]" => "Password123!"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => ""
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "email@email.com"
        ]];

        yield [[
            "member[firstName]" => "John",
            "member[lastName]" => "Doe",
            "member[email]" => "email@email.com",
            "member[plainPassword]" => "fail"
        ]];
    }
}
