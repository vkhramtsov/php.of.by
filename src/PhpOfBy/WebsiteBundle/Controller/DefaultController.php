<?php

namespace PhpOfBy\WebsiteBundle\Controller;

use CommonBundle\Controller\AbstractServiceController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends AbstractServiceController
{
    /**
     * @Route("/", name="home")
     * @Template
     */
    public function indexAction()
    {
        return array();
    }
}
