<?php

// src/Controller/CartController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

class CartController extends AbstractController
{
    #[Route("/api/cart", name: "api_cart")]
    public function index(Request $request): Response
    {
        // Récupérez les produits du panier depuis la session
        $cart = $request->getSession()->get('cart', []);

        // Retourner le contenu du panier au format JSON
        return new JsonResponse($cart);
    }

    #[Route("/api/cart/add/{productId}", name: "api_cart_add")]
    public function addToCart(Request $request, $productId): Response
    {
        // Ajoutez le produit au panier (dans cet exemple, stocké en session)
        $cart = $request->getSession()->get('cart', []);
        $cart[] = $productId;
        $request->getSession()->set('cart', $cart);

        // Obtenir l'URL de référence ou définir une URL de redirection par défaut
        $referer = $request->headers->get('referer') ?? '/';
        
        // Redirigez l'utilisateur vers l'URL précédente ou l'URL par défaut
        return new RedirectResponse($referer);
    }
}
