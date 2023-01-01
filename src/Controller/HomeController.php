<?php

namespace App\Controller;

use App\Form\RegexType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $form =$this->createForm(RegexType::class);

        $form->handleRequest($request);
        //ensuite on rentre notre if
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dd($data);
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
