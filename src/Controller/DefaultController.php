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

    /*#[Route("/api/produit/{id}", name: "api_produit_detail")]
    public function apiProduitDetail(int $id, FruitRepository $fruitRepository, SerializerInterface $serializer): Response
    {
        $fruit = $fruitRepository->find($id);
        $data = $serializer->serialize($fruit, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }*/
    #[Route("/api/products", name: "api_products")]
    public function apiProduit(): Response
    {
        // Créer un client HTTP pour effectuer la requête à l'API
        $client = HttpClient::create();
        // Faire la requête GET à l'API
        $response = $client->request('GET', 'https://fakestoreapi.com/products');
        // Récupérer le contenu de la réponse
        $data = $response->toArray();
        // Convertir les données en chaîne JSON
        $jsonData = json_encode($data);
        // Retourner les données au format JSON
        return new JsonResponse($jsonData, Response::HTTP_OK, [], true);
    }
}
