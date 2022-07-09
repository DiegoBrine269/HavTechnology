<?php
    namespace App\Helpers;

    use PDF;

    class AppHelper
    {
        public static function generarBarcodesPDF ($srcs, $id = '') {
            $data = compact('srcs');

            $pdf = PDF::loadView('productos.barcodes', $data);
            return $pdf->download("barcodes_{$id}.pdf");
        }

        public static function instance()
        {
            return new AppHelper();
        }
    }