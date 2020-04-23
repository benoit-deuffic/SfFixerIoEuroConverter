<?php

namespace App\Controller;

use App\Service\fixerIoConverterServiceInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations ;
use FOS\RestBundle\Request\ParamFetcher;


class FixerIoController extends AbstractFOSRestController
{
    /**
     * @Route("/", methods={"GET","HEAD"}, name="accueil")
     */
    public function getHome()
    {
        return $this->render("index.html.twig");
    }

    /**
     * @Route("/api/currency/symbols", methods={"GET","HEAD"}, name="get_symbols")
     */

    public function getSymbols(fixerIoConverterServiceInterface $ioConverter)
    {
        return new Response($ioConverter->getSymbols(), 200);
    }


    /**
     * @Route("/api/currency/convert", methods={"GET","HEAD"}, name="get_convert")
     *
     * @Annotations\QueryParam(name="currency", default="USD"))
     * @Annotations\QueryParam(name="amount", default="10"))
     *
     */

    public function getConvert(fixerIoConverterServiceInterface $ioConverter, ParamFetcher $params)
    {
        $value = floatval($params->get('amount'));
        $currency = $params->get('currency');
        $convert = $ioConverter->calcConvert($currency, $value);
        $data = array('query'=>array('to'=>$currency), 'result'=> $convert );

        $view = $this->view($data, 200);
        $view->setFormat('json');
        $view->setData($data);

        return $this->handleView($view);

    }
}
