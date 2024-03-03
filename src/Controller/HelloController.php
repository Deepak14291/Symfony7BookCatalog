<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    private array $messages = [
        ['message' => 'Hello', 'created' => '2023/11/12'],
        ['message' => 'Hi', 'created' => '2023/09/12'],
        ['message' => 'Bye!', 'created' => '2023/01/12']
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index')]
    public function index($limit): Response
    {
        return $this->render(
            "hello/index.html.twig",
            [
                "messages" => $this->messages,
                "limit" => $limit
            ]
        );
    }

    #[Route('/messages/{id<\d+>}', name: 'showone_message')]
    public function showOne($id): Response
    {
        return $this->render(
            "hello/showone.html.twig",
            [
                "message" => $this->messages[$id]
            ]
        );

    }

}