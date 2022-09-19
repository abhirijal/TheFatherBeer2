<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AgeVerification;


class MainController extends AbstractController
{

    private $age;

    public function __construct(AgeVerification $age)
    {
        $this->age = $age;
    }

    #[Route('/', name: 'homepage')]
    public function homepage(Request $request): Response
    {
        $resp = new Response();
        if ($this->age->verifyAge($request, $resp) == false) {
            return $this->render('age.html.twig', [
            ]);
        }
        $resp->setContent($this->renderView('index.html.twig', [
        ]));
        $resp->prepare($request);
        return $resp;
    }

    #[Route('/what-the-fog', name: 'whatTheFog')]
    public function whatTheFog(): Response
    {

        return $this->render('whatTheFog.html.twig', [
        ]);
    }

    #[Route('/wheres-the-fog', name: 'wheresTheFog')]
    public function wheresTheFog(): Response
    {

        return $this->render('wheresTheFog.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'contact', methods:['GET'])]
    public function contact(): Response
    {

        return $this->render('contact.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'submitContact', methods:['POST'])]
    public function submitContact(Request $request): Response
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $message = $request->request->get('message');
        $to  = 'avi.rizal51@gmail.com';
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        $text = 'Name: ' . $name . '\n ' . 'Email: ' . $email . '\n' . 'Message: ' . $message;
        mail($to,"email received",$text);
        // ->html('<p>See Twig integration for better HTML integration!</p>');

        // $mailer->send($email);
        return $this->render('contact.html.twig', [
            'message' => 'success'
        ]);
    }
}