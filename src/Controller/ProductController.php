<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ManagerRegistry $entityManager): Response
    {
        $repository = $entityManager->getRepository(Product::class);
        $product = $repository->findAll();
        //dd($product);
        return $this->render('product/index.html.twig', ['products' => $product]);
    }
}
