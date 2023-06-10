<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(Request $request): Response
    {

        $session = $request->getSession();

        if (!$session->has('todos')) {


            $todos = [

                'achat' => 'acheter appartement',
                'cours' => 'Finaliser formation',
                'luffy' => 'Grande line'
            ];
            $session->set('todos', $todos);

            $this->addFlash('info', "La liste des todos vient d'être initialisé ");
        }
        return $this->render('todo/index.html.twig');
    }
    //Il y a une méthode plus simple qui est d'ajouter un ? au element de la route et par la suite définir le mot par défaut

    #[Route('/add/{name}/{content?test}', name: 'todo.add', defaults: ['name' => 'test'])]
    public function addTodo(Request $request, $name, $content): RedirectResponse
    {

        $session = $request->getSession();

        if ($session->has('todos')) {

            $todos = $session->get('todos');

            if (isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name existe déjà ! ");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo d'id $name a bien été ajouté à la liste ! ");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée ");
        }
        return $this->redirectToRoute('app_todo');
    }


    #[Route('/update/{name}/{content}', name: 'todo.up')]


    public function updateTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {

            $todos = $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name n'est pas dans la liste ! ");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('delete', "Le todo d'id $name a bien été modifié de la liste ! ");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée ");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/delete/{name}/{content}', name: 'todo.del')]
    public function deletTodo(Request $request, $name, $content): RedirectResponse
    {
        $session = $request->getSession();

        if ($session->has('todos')) {

            $todos = $session->get('todos');

            if (!isset($todos[$name])) {
                $this->addFlash('error', "Le todo d'id $name n'est pas dans la liste ! ");
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('delete', "Le todo d'id $name a bien été suprimé de la liste ! ");
            }
        } else {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée ");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/reset', name: 'todo.res')]
    public function resetTodo(Request $request): RedirectResponse
    {
        $session = $request->getSession();

        $session->remove('todos');
        $this->addFlash('success', "La liste des todos à bien été vidé! ");
        return $this->redirectToRoute('app_todo');
    }
}
