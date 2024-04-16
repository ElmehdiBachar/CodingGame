<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class DefaultController extends AbstractController
{
    #[Route("/", name: "index")]
    #[Route("/products", name: "products")]
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }

    #[Route("/api/products", name: "api_products")]
    public function apiProduit(): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://fakestoreapi.com/products');
        $data = $response->toArray();
        $jsonData = json_encode($data);
        return new JsonResponse($jsonData, Response::HTTP_OK, [], true);
    }
}
