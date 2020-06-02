<?php
/**
 * Created by Gregoire Humeau
 * gregoire.humeau@gmail.com
 * 2020-05-11
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render(
            'pages/home.html.twig',
            ['slug' => 'home']
        );
    }

    /**
     * @Route("/{slug}", requirements={"slug"="^(?!.*(contact)$).*"})
     */
    public function page(string $slug)
    {
        return $this->render(
            sprintf('pages/%s.html.twig', $slug),
            compact('slug')
        );
    }
}