<?php


namespace App\Helpers;

    use Illuminate\Support\Facades\Session;

    use PDF;

    class AppHelper
    {
        public static function generarBarcodesPDF ($srcs, $id = '') {
            $data = compact('srcs');

            $pdf = PDF::loadView('productos.barcodes', $data);
        
            return $pdf->stream("barcodes_{$id}.pdf");
        }

        public static function instance()
        {
            return new AppHelper();
        }
    }