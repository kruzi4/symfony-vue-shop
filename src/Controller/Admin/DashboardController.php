<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route ("/admin")
 */
class DashboardController extends AbstractController
{

    /**
     * @Route ("/admin", name="admin_dashboard_show")
     */
    public function dasboard() : Response
    {
        return $this->render('admin/pages/dashboard.html.twig');
    }
}