<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ElegirType;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
            return $this->redirectToRoute('sonata_admin_dashboard');

    }

    /**
     * @Route("/dashboard1", name="dashboard1")
     */
    public function dashboard1Action(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/dashboard1.html.twig', [
                'user' => $this->getUser(),
                'grafica1' => $this->grafica1(),
                'grafica2' => $this->grafica2(),
                'grafica3' => $this->grafica3(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');
    }

    /**
     * @Route("/controles_volumetricos", name="cont_volumetricos")
     */
    public function controlesAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/controles.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');
    }


    /**
     * @Route("/precios", name="dent_precios")
     */
    public function preciosAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/precios.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/scanners", name="dent_scanners")
     */
    public function scannersAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/scanners.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/casos", name="dent_casos")
     */
    public function casosAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/casos.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/preguntas", name="dent_preguntas")
     */
    public function preguntasAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/preguntas.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    /**
     * @Route("/empresa", name="dent_empresa")
     */
    public function empresaAction(): Response
    {
        $tokenInterface = $this->get('security.token_storage')->getToken();
        $isAuthenticated = $tokenInterface->getRoles();

        if(!empty($isAuthenticated))//reviso que roles tiene
            return $this->render('home/empresa.html.twig', [
                'user' => $this->getUser(),
            ]);
        else //no tiene roles
            return $this->redirectToRoute('sonata_user_admin_security_login');

    }

    private function grafica1()
    {
        $line = new LineChart();
        $line->getData()->setArrayToDataTable(
            [
            [['label' => 'x', 'type' => 'number'], ['label' => 'Millones de Pesos', 'type' => 'number'],
            ['id' =>'i0', 'type' => 'number', 'role' =>'interval'],
            ['id' =>'i1', 'type' => 'number', 'role' =>'interval'],
            ['id' =>'i2', 'type' => 'number', 'role' =>'interval'],
            ['id' =>'i2', 'type' => 'number', 'role' =>'interval'],
            ['id' =>'i2', 'type' => 'number', 'role' =>'interval'],
            ['id' =>'i2', 'type' => 'number', 'role' =>'interval']],
            [1, 100, 90, 110, 85, 96, 104, 120],
            [2, 120, 95, 130, 90, 113, 124, 140],
            [3, 130, 105, 140, 100, 117, 133, 139],
            [4, 90, 85, 95, 85, 88, 92, 95],
            [5, 70, 74, 63, 67, 69, 70, 72],
            [6, 30, 39, 22, 21, 28, 34, 40],
            [7, 80, 77, 83, 70, 77, 85, 90],
            [8, 100, 90, 110, 85, 95, 102, 110]
            ]
        );
        $line->getOptions()->setTitle('Diesel');
        $line->getOptions()->setCurveType('function');
        $line->getOptions()->setLineWidth(4);
        $line->getOptions()->getLegend()->setPosition('none');

        return $line;
    }

    private function grafica2()
    {
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [
                ['Diesel', 'Magna'],
                ['Diesel', 75],
                ['Magna', 25]
            ]
        );
        $pieChart->getOptions()->getLegend()->setPosition('left');
        //$pieChart->getOptions()->setPieSliceText('none');
        $pieChart->getOptions()->setPieStartAngle(135);

        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('black');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('green');
        $pieChart->getOptions()->setSlices([$pieSlice1, $pieSlice2]);

        $pieChart->getOptions()->setHeight(300);
        //$pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTooltip()->setTrigger('none');

        return $pieChart;
    }

    private function grafica3()
    {
        $combo = new ComboChart();
        $combo->getData()->setArrayToDataTable([
            ['Yakult', 'Femsa', 'Liverpool', 'Carso', 'Alsea', 'Hard Rock', 'Frubana'],
            ['2021/05',  165,      938,         522,             998,           450,      614.6],
            ['2021/06',  135,      1120,        599,             1268,          288,      682],
            ['2021/07',  157,      1167,        587,             807,           397,      623],
            ['2021/08',  139,      1110,        615,             968,           215,      609.4],
            ['2021/09',  136,      691,         629,             1026,          366,      569.6]
        ]);
        $combo->getOptions()->setTitle('Venta por Mes Top 10 Clientes');
        $combo->getOptions()->getVAxis()->setTitle('Millones de Pesos');
        $combo->getOptions()->getHAxis()->setTitle('Mes');
        $combo->getOptions()->setSeriesType('bars');

        $series5 = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $series5->setType('line');
        $combo->getOptions()->setSeries([5 => $series5]);

        //$combo->getOptions()->setWidth(900);
        $combo->getOptions()->setHeight(300);

        return $combo;
    }
}