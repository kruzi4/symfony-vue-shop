<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\EditCategoryFormType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="main_homepage")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $productList = $em->getRepository(Product::class)->findAll();

        return $this->render('main/default/index.html.twig', []);
    }

    /**
     * @Route("/product-add", name="product_add")
     * @throws Exception
     */
    public function productAdd(): Response
    {
        $product = new Product();
        $product->setTitle('Product' . random_int(1, 100));
        $product->setDescription('smthng');
        $product->setPrice(10);
        $product->setQuantity(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirectToRoute('main_homepage');
    }
}
