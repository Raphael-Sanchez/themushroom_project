<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        if ($user !== null)
        {
            $options = ['userParameters' => true];
            $form = $this->createForm(UserType::class, $user, $options);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $em->persist($user);
                $em->flush();
//            $this->addFlash('success', 'Les modifications de vos paramètres on bien été pris en compte !');
                return $this->redirectToRoute('index');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $form->createView()
            ]);
        }

        return $this->redirectToRoute('index');
    }
}
