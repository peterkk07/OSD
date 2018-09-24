<?php

namespace OSD\Http\Controllers;

use Illuminate\Http\Request;

use OSD\Http\Requests;

use PDF;

class ChartController extends Controller
{
    public function index()

    {

    	$semesters = array();

        array_push($semesters, 1);

        
        /*$pdf = PDF::loadView('internal.test');*/

        $pdf = PDF::loadView('chartjs');

        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('chartTest.pdf');
    }
}
