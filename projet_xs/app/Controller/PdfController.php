<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\UsersModel;
use \Model\OrdersModel;
use mikehaertl\wkhtmlto\Pdf;

class PdfController extends Controller
{

 //************** fonction pour generer la facture pdf **********************


    public function viewFacturePdf($id){

        
        
        $content = 'http://'.$_SERVER['HTTP_HOST'].$this->generateUrl('pdf_genrateFacture', ['id' => $id]);
        
        
        $pdf = new Pdf([
                //'binary' => 'C:\Program Files\wkhtmltopdf\bin',
                'commandOptions' => [

                    'escapeArgs' => false,
                    'procOptions' => [
                        //'bypass_shell'     => true, // This will bypass the cmd.exe which seems to be recommended on Windows
                        'suppress_errors'=> true, // Also worth a try if you get unexplainable errors
                    ],
                ],
            ]);

        // $pdf = new Pdf();
        $pdf->setOptions(['user-style-sheet' => realpath('assets/css/pdf.css')]);
        $pdf->addPage($content);
        //$pdf->addPage('<html><p>Sagi is the best women in Martinique</p></html>');
        // $pdf->addPage('https://www.google.com');
        // if(!$pdf->send()){
        //     var_dump('Could not create PDF: '.$pdf->getError());
        //     die;

        // $pdf->saveAs($uploadDir.'report.pdf');

        // $pdf->saveAs('/path/to/report.pdf');
    //      if (!$pdf->saveAs('https://www.google.pdf'))
    //       {
 //       var_dump($pdf->getError());
        // }

        if (!$pdf->send()) {
           die('Error Windows:<br>'.$pdf->getError());
        // }

        // $outFile = $this->getOutFile();
 //       $binary = $this->getBinary();


        }
    }


    public function genrateFacture($id){

        $view           = new OrdersModel();
        $order          = $view->find($id);
        $panierCommande = json_decode($order['products']);
        
        $selUser = new UsersModel();
        $user = $selUser->find($order['user_id']);



        $params         = [
            'view_order'     => $order,
            'panierCommande' => $panierCommande,
            'user' => $user,
        ];

        $this->show('User/facturePdfTemplate.php', $params);
    }
}
    


