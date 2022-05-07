<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Notes;
use App\Form\NotesType;
use Symfony\Component\Validator\Constraints as Assert;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (!empty($request->request->get('notes'))) {
            $parameters = $request->request->get('notes');
            $parameters['category'] = $em->getRepository(Notes::class)->find($parameters['category']);
            $request->request->set('notes', $parameters);
        }

        $note = new Notes();
        $form = $this->createForm(NotesType::class, $note);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute("index");
        }
        $notes = $em->getRepository(Notes::class)->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'form' => $form->createView(),
            'notes' => $notes,
        ]);
    }

    /**
     * @Route("/edit/{note}", name="edit_note")
     * @param Request $request
     * @param Notes $note
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function editNote (Request $request, Notes $note)
    {
        $form = $this->createForm(NotesType::class, $note, array (
            'action' => $this->generateUrl('edit_note', array (
                'note' => $note->getId(),
            )),
            'method' => 'POST',
        ));

        $em = $this->getDoctrine()->getManager();
        $parameters = $request->request->get('notes');
        $parameters['category'] = $em->getRepository(Notes::class)->find($parameters['category']);
        $request->request->set('notes', $parameters);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            $note->setCreated(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute("index");
        }

        return $this->render('main/edit.html.twig', array (
            'form' => $form->createView(),
            'note' => $note,
        ));
    }


    /**
     * @Route("/remove/{note}", name="remove_note")
     */
    public function removeNote (Notes $note, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();
        return $this->redirectToRoute('index');
    }
}
