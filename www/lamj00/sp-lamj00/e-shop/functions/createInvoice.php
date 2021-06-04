<?php require_once dirname(__DIR__) . '/fpdf/fpdf.php'; ?>
<?php


function createInvoice($order,$user,$cart){

    $pdf = new FPDF('P','mm','A4');

    $pdf->AddPage();

//set font to arial, bold, 14pt
    $pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130	,5,'Componentoro',0,0);
    $pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
    $pdf->SetFont('Arial','',12);

    $pdf->Cell(130	,5,'[AMONGUS]',0,0);
    $pdf->Cell(59	,5,'',0,1);//end of line

    $pdf->Cell(130	,5,'[Hawary Shar, Irak]',0,0);
    $pdf->Cell(25	,5,'Date',0,0);
    $pdf->Cell(34	,5,$order->getDate(),0,1);//end of line

    $pdf->Cell(130	,5,'Phone [+12345678]',0,0);
    $pdf->Cell(25	,5,'Order #',0,0);
    $pdf->Cell(34	,5,$order->getID(),0,1);//end of line

    $pdf->Cell(130	,5,'Fax [+12345678]',0,0);
    $pdf->Cell(25	,5,'Customer ID',0,0);
    $pdf->Cell(34	,5,$user["ID"],0,1);//end of line

//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189	,10,'',0,1);//end of line

//billing address
    $pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
    $pdf->Cell(10	,5,'',0,0);
    $pdf->Cell(90	,5,$user["firstName"]." ".$user["lastName"],0,1);

    $pdf->Cell(10	,5,'',0,0);
    $pdf->Cell(90	,5,$user["address"],0,1);

    $pdf->Cell(10	,5,'',0,0);
    $pdf->Cell(90	,5,"lamj00@gmail.com",0,1);

//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
    $pdf->SetFont('Arial','B',12);

    $pdf->Cell(130	,5,'Description',1,0);
    $pdf->Cell(25	,5,'Price',1,0);
    $pdf->Cell(34	,5,'Amount',1,1);//end of line

    $pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
    $price = 0;

//display the items
    foreach($cart as $item){
        $pdf->Cell(130	,5,$item['product_name'],1,0);
        //add thousand separator using number_format function
        $pdf->Cell(25	,5,number_format($item['price']),1,0);
        $pdf->Cell(34	,5,number_format($item['quantity']),1,1,'R');//end of line
        //accumulate tax and amount
        $price += $item['price']*$item['quantity'];
    }

//summary
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,5,'Total',0,0);
    $pdf->Cell(4	,5,'$',1,0);
    $pdf->Cell(30	,5,number_format($price),1,1,'R');//end of line



    $output = $pdf->Output("invoice.pdf", "F");
    return $output;
}

?>