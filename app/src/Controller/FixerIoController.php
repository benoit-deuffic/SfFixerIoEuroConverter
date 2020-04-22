<?php

namespace App\Controller;

use App\Service\fixerIoConverterServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FixerIoController extends AbstractController
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
     * @Route("/api/currency/convert/{currency}/{amount}", methods={"GET","HEAD"}, name="get_convert")
     */

    public function getConvert(fixerIoConverterServiceInterface $ioConverter, string $currency, string $amount)
    {

        $value = floatval($amount);
        $convert = $ioConverter->calcConvert($currency, $value);
        $return = array('query'=>array('to'=>$currency), 'result'=> $convert );

        return new Response(json_encode($return));
    }
}
