<?php

namespace App\Controller;

use App\Form\RegexType;
use App\Service\OpenAiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, OpenAiService $openAi): Response
    {
        $form =$this->createForm(RegexType::class);

        $form->handleRequest($request);
        //ensuite on rentre notre if
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            //dd($data);
            //on va recuperer nos infos via une API et on lui passe lechamp regex de notre form
            $json = $openAi->getHistory($data['regex']);
            //dd($json);
            return $this->render('home/histoire.html.twig', [
                'json' => $json ?? null,
            ]);
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
