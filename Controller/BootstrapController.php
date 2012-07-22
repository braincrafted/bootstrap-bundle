<?php

/**
 * BootstrapController
 *
 * PHP Version 5.3.10
 *
 * @category  Controller
 * @package   BraincraftedBootstrapBundle
 * @author    Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright 2012 Florian Eckerstorfer
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

namespace Braincrafted\BootstrapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Braincrafted\BootstrapBundle\Form\Type\BasicFormType;
use Braincrafted\BootstrapBundle\Form\Type\InlineFormType;
use Braincrafted\BootstrapBundle\Form\Type\SearchFormType;

/**
 * BootstrapController
 *
 * @category  Controller
 * @package   BraincraftedBootstrapBundle
 * @author    Florian Eckerstorfer <florian@theroadtojoy.at>
 * @copyright 2012 Florian Eckerstorfer
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class BootstrapController extends Controller
{
    public function overviewAction()
    {
        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:overview.html.twig'
        );
    }

    public function scaffoldingAction()
    {
        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:scaffolding.html.twig'
        );
    }

    public function baseCssAction()
    {
        $basicForm  = $this->createForm(new BasicFormType());
        $inlineForm = $this->createForm(new InlineFormType());
        $searchForm = $this->createForm(new SearchFormType());

        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:baseCss.html.twig',
            array(
                'basicForm'     => $basicForm->createView(),
                'inlineForm'    => $inlineForm->createView(),
                'searchForm'    => $searchForm->createView()
            )
        );
    }

    public function componentsAction()
    {
        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:components.html.twig'
        );
    }

    public function javascriptAction()
    {
        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:javascript.html.twig'
        );
    }

    public function lessAction()
    {
        return $this->render(
            'BraincraftedBootstrapBundle:Bootstrap:less.html.twig'
        );
    }
}
