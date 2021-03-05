<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formulaire;
use App\Form\FormulaireType;
use Symfony\Component\HttpFoundation\Request;

class FormulaireController extends AbstractController
{
     /**
     * @Route("/", name="formulaire")
     */
    public function index(Request $request): Response {
        $formulaire = new Formulaire();
        $services = $formulaire->getAllServices();

        $form = $this->createForm(FormulaireType::class,$formulaire,[
                                                        'services' => $services,
                                                        ]);
        $form->handleRequest($request);
            if ($form->isSubmitted()) {
                //~ On récupere le formulaire rempli
                $data = $form->getData();
                //~ dd($data);
                if ($form->isValid()) {
                    $this->addFlash(
                                'success',
                                implode(',',$data->getMyArray())
                    );
                } else {
                    $this->addFlash(
                                'error',
                                'valeur invaliude'
                    );
                }
            }
        return $this->render('Formulaire/adddata.html.twig', [
                'form' => $form->createView(),
                'controller_name' => 'FormulaireController',
                'services' => $services
            ]
        );
    }
}
