<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 19/02/2019
 * Time: 08:01 PM
 */

namespace App\Http\Controllers;


use App;
use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function pdf(Request $request, $processId)
    {
        ini_set('max_execution_time', 300);
        $process = App\Http\Model\Process::find($processId);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("pdf", [
            "process" => $process,
            "jefe" => \request('fefe_depto'),
            "responsable" => \request('responsable'),
            "cargo" => \request('cargo'),
        ]);
        return $pdf->stream();
//        return view('pdf', ["process" => $process]);
    }
}