<?php

namespace EMM\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        return new Response('Ola k ase');
    }

    public function articlesAction($page)
    {
        return new Response('Este es mi artículo ' . $page );
    }


}
