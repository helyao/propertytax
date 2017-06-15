<?php
/**
 * Created by PhpStorm.
 * User: helyao
 * Date: 5/17/2017
 * Time: 11:26 AM
 */

class Report extends CI_Controller {

    public function index() {
        // get property id
//        if ($this->uri->segment(3)) {
//            $prop_id = $this->uri->segment(3);
//        }
//        else {
//            $prop_id = '100039';
//        }
        $prop_id = $_POST['hidporperty'];


        $pdf = new PDF('L', 'mm', 'A4', $prop_id);
        $pdf->AliasNbPages();
        // <-- Page 1 - Title -->
        // get values from mysql
        $this->load->model('Report_model');
        $loc = $this->Report_model->getAddress($prop_id);       // address info
        $over = $this->Report_model->getOverValue($prop_id);    // over-value
        // draw page
        $pdf->AddPage();
        $pdf->SetFont('Times','B',18);
        $pdf->Cell(0, 0, 'DATA ANALYSIS ON', 0, 0, 'C');
        $pdf->Ln(14);
        $pdf->Cell(0, 0, getdate(time())['year'].' ASSESSED PROPERTY VALUE OF THE PROPERTY AT', 0, 0, 'C');
        $pdf->Ln(14);
        $pdf->Cell(0, 0, $loc->address.', '.$loc->city_zip, 0, 0, 'C');
        $pdf->Ln(12);
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0, 0, '(COUNTY PROPERTY ID: '.$prop_id.')', 0, 0, 'C');
        $pdf->Ln(12);
        $pdf->SetFont('Times','B',18);
        $pdf->Cell(0, 0, 'vs. THOSE OF COMPARABLE PROPERTIES', 0, 0, 'C');
        $pdf->Ln(15);
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0, 0, getdate(time())['year'].' - '.getdate(time())['mon'].' - '.getdate(time())['mday'], 0, 0, 'C');
        $pdf->Ln(15);
        $pdf->SetFont('Times','B',18);
        $pdf->MultiCell(0, 16, 'ANALYSIS RESULT'."\n".$loc->address.'\'s Noticed Property Value is $'.$this->num_format($over).' OVER-VALUED'."\n".'vs.'."\n".'Comparable Properties In The Same Neighborhood', 1, 'C');
        // <-- Page 2 - Notice -->
        $pdf->AddPage();
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(0, 0, 'Disclaimer', 0, 0, 'L');
        $pdf->Ln(15);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(10);
        $pdf->MultiCell(0, 2, '* This disclaimer governs the use of this report. By using this report, you accept this disclaimer in full.', 0, 'L');
        $pdf->Ln(6);
        $pdf->Cell(10);
        $pdf->MultiCell(0, 6, '* You must not rely on the information in the report as an alternative to legal, financial, taxation, or valuation advice from an appropriately qualified professional. If you have any specific questions about any legal, financial, taxation, or valuation matter you should consult an appropriately qualified professional.', 0, 'L');
        $pdf->Ln(6);
        $pdf->Cell(10);
        $pdf->MultiCell(0, 6, '* Property Data Analysis, LLC ("We" or the "Company") is not a legal counsel, property tax consultant, real estate broker, agent, or appraiser, and does not act as such. We do not offer, prepare, or provide property tax consultation, legal advice, real estate appraisal, valuations, or opinions. Any data, analysis or statement provided in this report is not intended and shall not be deemed to constitute a legal opinion, real estate appraisal or property tax advices, of any kind.', 0, 'L');
        $pdf->Ln(6);
        $pdf->Cell(10);
        $pdf->MultiCell(0, 6, '* This Data Analysis Report (the "Report") is provided free of charge, "as is" and "as available". While the data used in compiling the report are deemed accurate and the analysis methods used are deemed correct, we make no representation or warranty concerning the accuracy and usefulness of such data and analysis, and specifically disclaim any warranty and liability, express or implied, arising out of your use of, or any tax or value or any other position taken in reliance on, such information. The entire risk as to the use of this report is assumed by the user. We will not be liable to you in respect of any losses, including without limitation loss of or damage to profits, income, revenue, use, production, anticipated savings, business, contracts, commercial opportunities or goodwill.', 0, 'L');
        // <-- Page 3 - Summary -->
        // get values from mysql
        $base = $this->Report_model->getBaseInfo($prop_id);
        // draw page3 - base info
        $pdf->AddPage();
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(0, 0, 'Summary of the Analysis', 0, 0, 'L');
        $pdf->Ln(15);
        $locX = $pdf->GetX();
        $locY = $pdf->GetY();
        $pdf->SetXY($locX, $locY);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Property ID', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $prop_id, 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Address', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $loc->address.', '.$loc->city_zip, 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Neighborhood ID', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $base->hood_id, 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Year Built/Remodeled', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $base->year, 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Grade', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $base->full_grade, 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Improvement Area(sqf)', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, $this->num_format($base->living_area), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Total Property Value', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->appraised_val), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Property Value $/sqf', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->appraised_aver_val), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Land Value', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->land_val), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Total Improvement Value', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->imprv_val), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Swimming Pool Value', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->swim_val), 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','BU',14);
        $pdf->SetTextColor(139, 26, 26);
        $pdf->Cell(90, 0, 'Noticed Extra Improvement Value', 0, 0, 'R');
        $pdf->Ln(6);
        $pdf->SetFont('Times','',14);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 0, '$'.$this->num_format($base->extra_val), 0, 0, 'R');
        // draw page3 - separator
        $pdf->SetXY($locX + 90 + 2, $locY);
        $pdf->Cell(1, 144, '', 0, 0, 'C', true);
        // draw page3 - summary
        $number = $this->Report_model->getCountCompare($prop_id);
        $summary = $this->Report_model->getSummaryInfo($prop_id);
        $pdf->SetFont('Times','',12);
        $pdf->SetXY($locX + 90 + 4, $locY);
        $pdf->MultiCell(0, 6, '* '.$number.' comparable properties in the same neighborhood were selected according to their similarities with the property at '.$loc->address.' (the "Subject Property") on property grade (±3 Grades), improvement area size (±20%), and year built (±5 years).', 0, 'L');
        $pdf->Cell($locX + 90 - 6);
        $pdf->MultiCell(0, 6, '* The noticed property value of these selected comparable properties were adjusted to the Subject Property for the differences in land value, quality grade, improvement area size, year built, and extra improvement features (swimming pool, etc.). These adjustments are based on rigorous statistical analysis methods.', 0, 'L');
        $pdf->Cell($locX + 90 - 6);
        $pdf->MultiCell(0, 6, '* The median value of the comparable properties (adjusted) in the same neighborhood is $'.$this->num_format($summary->total_mid_val).', or $'.$this->num_format($summary->total_aver_mid_val).' per sqf verse the noticed property value of $'.$this->num_format($base->appraised_val).', indicating a valuation gap of $'.$this->num_format($over).'.', 0, 'L');
        // draw page3 - chart
        // get values from mysql
        $chart = $this->Report_model->getChartInfo($prop_id);
        $chartID = array();
        $chartVal = array();
        foreach ($chart as $row) {
            array_push($chartID, $row->prop_id);
            array_push($chartVal, $row->appraised_val);
        }
        array_push($chartID, $prop_id);
        array_push($chartVal, $base->appraised_val);
        $chartData['prop_id'] = $prop_id;
        $chartData['id'] = $chartID;
        $chartData['val'] = $chartVal;
        $chartData['middle'] = $summary->total_mid_val;
        $pdf->Cell($locX + 90 - 6);
        $pdf->Image($this->compareChart($chartData));
        // <-- Page 4 - Summary -->
        // get values from mysql
        $comp_header = array('Property ID', 'Address', 'Grade', 'Living Area', 'Year Built', 'Appraised Value', 'Land Adj.', 'Pool Adj.', 'Grade Adj.', 'Age Adj.', 'Size Adj.', 'Other Adj.', 'Total Adj.', 'Adjusted Property', 'Your Property', 'Value Gap');
        $comp_o_data = $this->Report_model->getCompareData($prop_id);
        $comp_data = array();
        $adjust_aver_data = array();
        $gap_aver_data = array();
        foreach ($comp_o_data as $row) {
            array_push($comp_data, array($row->prop_id, $row->address, $row->grade, $row->living_area, $row->year,
                '$'.$this->num_format($row->appraised_val), '$'.$this->num_format($row->land_adj), '$'.$this->num_format($row->swim_adj),
                '$'.$this->num_format($row->grade_adj), '$'.$this->num_format($row->age_adj), '$'.$this->num_format($row->size_adj),
                '$'.$this->num_format($row->other_adj), '$'.$this->num_format($row->total_adj), '$'.$this->num_format($row->cmp_market_val),
                '$'.$this->num_format($base->appraised_val), '$'.$this->num_format($row->value_gap)));
            array_push($adjust_aver_data, '$'.$this->num_format(round(($row->cmp_market_val / $row->living_area), 2)));
            array_push($gap_aver_data, '$'.$this->num_format($row->value_gap));
        }
        $other_data['adjust_aver'] = $adjust_aver_data;
        $other_data['porperty_val'] = '$'.$this->num_format($base->appraised_val);
        $other_data['porperty_aver_val'] = '$'.$this->num_format($base->appraised_aver_val);
        $other_data['mid_val'] = '$'.$this->num_format($summary->total_mid_val);
        $other_data['mid_aver_val'] = '$'.$this->num_format(round(($summary->total_mid_val / $base->living_area), 2));
        $other_data['gap_aver'] = $gap_aver_data;
        $other_data['address'] = $loc->address;
        $other_data['over_val'] = '$'.$this->num_format($over);
        // draw page4 - table
        $pdf->AddPage('L', 'A3');
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(0, 0, 'Equity Comparable Analysis (Property Value Adjusted)', 0, 0, 'L');
        $pdf->Ln(15);
        $locX = $pdf->GetX();
        $locY = $pdf->GetY();
        $pdf->SetXY($locX, $locY);
        $pdf->SetFont('Times','',10);
        $pdf->create_compare_table($comp_header, $comp_data, $other_data);
        // draw page4 - summary
        $pdf->SetFont('Times','B',18);
        $pdf->Ln(6);
        $pdf->MultiCell(0, 12, 'ANALYSIS RESULT'."\n".$loc->address.'\'s Noticed Property Value is OVER-VALUED by'."\n".'$'.$this->num_format($over)."\n".'VS.'."\n".'Comparable Properties In The Same Neighborhood', 1, 'C');
        // <-- Page 5 - Base Info List -->
        // get values from mysql
        $base_header = array('', 'Property ID', 'Address', 'Grade', 'Living Area', 'Year Built', 'Land Value', '1st Floor', '2nd Floor', 'Attached Garage', 'Detached Garage', 'Covered Porch', 'Open Porch', 'Swimming Pool', 'Other Features Values', 'Total Appraisal Value');
        $base_o_data = $this->Report_model->getNeighborBaseData($prop_id);
        $base_data = array();
        foreach ($base_o_data as $row) {
            array_push($base_data, array(
                $row->prop_id, $row->address, $row->grade, $row->year, $this->num_format($row->living_area),
                '$'.$this->num_format($row->land_val), $this->num_format($row->floor_1_area), $this->num_format($row->floor_2_area),
                $this->num_format($row->attached), $this->num_format($row->detached), $this->num_format($row->covered_p),
                $this->num_format($row->open_porc), '$'.$this->num_format($row->swim_val), '$'.$this->num_format($row->extra_val),
                '$'.$this->num_format($row->appraised_val)
            ));
        }
        // draw page4 - table
        $pdf->AddPage('L', 'A3');
        $pdf->SetFont('Times','B',16);
        $pdf->Cell(0, 0, 'Comparable Property Land and Improvement Details', 0, 0, 'L');
        $pdf->Ln(15);
        $locX = $pdf->GetX();
        $locY = $pdf->GetY();
        $pdf->SetXY($locX, $locY);
        $pdf->SetFont('Times','',10);
        $pdf->create_base_table($base_header, $base_data);
        $pdf->Ln(4);
        $gmap = 'https://maps.googleapis.com/maps/api/staticmap?center=';
        $item = 0;
        foreach ($base_o_data as $row) {
            if($item==0) {
                $gmap = $gmap.$row->address.', '.$row->city_zip.'&zoom=14&size=1000x300&maptype=roadmap&markers=color:red%7Clabel:'.($item+1).'%7C'.$row->address.', '.$row->city_zip;
            }
            else {
                $gmap = $gmap.'&markers=color:green%7Clabel:'.($item+1).'%7C'.$row->address.', '.$row->city_zip;
            }
            $item++;
        }
        $gmap = $gmap.'&key=AIzaSyA6ocHWiMl0ks_R2EvQ-tjA7uBvMqXRMt0';
        $pdf->Image(str_replace(' ', '%20', $gmap),20,150,376,130,'PNG');
//        // <-- Page 4 - Subject -->
//        // get values from mysql
//
//        // draw page5 - title
//        $pdf->AddPage('L', 'A4');
//        $pdf->SetFont('Times','B',16);
//        $pdf->Cell(0, 0, 'Appendix: The Subject Property Information', 0, 0, 'L');
//        $pdf->Ln(15);
//        // draw page5 - subject info
//        $ox = $pdf->GetX();
//        $oy = $pdf->GetY();
//        $pdf->SetFont('', 'B', 12);
//        $pdf->Cell(40, 10, 'Property ID', 0, 0, 'L');
//        $pdf->Cell(80, 10, '100039', 0, 0, 'L');
//        $pdf->Ln();
//        $pdf->Cell(40, 10, 'County', 0, 0, 'L');
//        $pdf->Cell(80, 10, '100039', 0, 0, 'L');
//        $pdf->Ln();
//        $pdf->Cell(40, 10, 'Address', 0, 0, 'L');
//        $pdf->Cell(80, 10, '100039', 0, 0, 'L');
//        $pdf->Ln();
//        $pdf->Cell(40, 10, 'Neighborhood ID', 0, 0, 'L');
//        $pdf->Cell(80, 10, '100039', 0, 0, 'L');
//        $pdf->Ln();
        // output pdf
        $pdf->Output();
    }

    public function compareChart($data) {
        $this->load->add_package_path(APPPATH.'third_party/pchart');
        $this->load->library('pchart');

        $filename = 'report\comp'.$data['prop_id'].'.png';
        if (!file_exists($filename)) {
            $pdata = new pData();
            $pdata->addPoints($data['val'], "Compared Improvement Value");
            $pdata->setAxisName(0, "Property Value");
            $pdata->addPoints($data['id'], "Labels");
            $pdata->setSerieDescription("Labels", "Propery ID");
            $pdata->setAbscissa("Labels");
            $pdata->setPalette("Compared Improvement Value", array("R" => 46, "G" => 151, "B" => 224));

            $pimage = new pImage(700, 325, $pdata);
            $pimage->setFontProperties(array("FontName" => APPPATH . 'third_party/pchart/fonts/Forgotte.ttf', "FontSize" => 11));
            $pimage->drawText(150, 35, "Compared Properties", array("FontSize" => 20, "Align" => TEXT_ALIGN_BOTTOMLEFT));
            $pimage->setGraphArea(70, 40, 670, 300);
            $pimage->drawScale(array("DrawSubTicks" => TRUE, "DrawArrows" => TRUE, "ArrowSize" => 6));
            $Palette = array(
                "0" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "1" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "2" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "3" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "4" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "5" => array("R" => 46, "G" => 151, "B" => 224, "Alpha" => 100),
                "6" => array("R" => 224, "G" => 100, "B" => 46, "Alpha" => 100),
                "7" => array("R" => 224, "G" => 100, "B" => 46, "Alpha" => 100));
            $pimage->drawBarChart(array("DisplayPos" => LABEL_POS_INSIDE, "DisplayValues" => TRUE, "Rounded" => TRUE, "Surrounding" => 30, "OverrideColors" => $Palette));
            $pimage->drawThreshold($data['middle'], array("Alpha" => 70, "Ticks" => 2, "R" => 0, "G" => 0, "B" => 255, "WriteCaption" => TRUE, "Caption" => "Midian Value: " . $this->num_format($data['middle']), "CaptionR" => 0, "CaptionG" => 0, "CaptionB" => 0, "NoMargin" => true));
            $pimage->drawLegend(360, 24, array("BoxSize" => 4, "R" => 173, "G" => 163, "B" => 83, "Surrounding" => 20, "Family" => LEGEND_FAMILY_CIRCLE));
            $pimage->drawRectangle(0, 0, 686, 320, array("R" => 0, "G" => 0, "B" => 0));
            $pimage->render($filename);
        }
        return $filename;
    }

    function num_format($num){
        if(!is_numeric($num)){
            return false;
        }
        if($num == 0) {
            return $num;
        }
        $rvalue='';
        $num = explode('.',$num);
        $rl = !isset($num['1']) ? '' : $num['1'];
        $j = strlen($num[0]) % 3;
        $sl = substr($num[0], 0, $j);
        $sr = substr($num[0], $j);
        $i = 0;
        while($i <= strlen($sr)){
            $rvalue = $rvalue.','.substr($sr, $i, 3);
            $i = $i + 3;
        }
        $rvalue = $sl.$rvalue;
        $rvalue = substr($rvalue,0,strlen($rvalue)-1);
        $rvalue = explode(',',$rvalue);
        if($rvalue[0]==0){
            array_shift($rvalue);
        }
        $rv = $rvalue[0];
        for($i = 1; $i < count($rvalue); $i++){
            $rv = $rv.','.$rvalue[$i];
        }
        if(!empty($rl)){
            $rvalue = $rv.'.'.$rl;
        }else{
            $rvalue = $rv;
        }
        return $rvalue;
    }

}

require APPPATH.'third_party/fpdf/fpdf.php';


class PDF extends FPDF {

    function __construct($orientation, $unit, $size, $property='100039')
    {
        parent::__construct($orientation, $unit, $size);
        $this->title = 'www.payfairtax.com';
    }

    function Header()
    {
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 0, $this->title, 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    function create_base_table($header, $data) {
        // Column Detail
        $w_c = array(array_sum(array(10, 26, 40, 14, 20, 20, 20)), array_sum(array(20, 20, 30, 30, 25, 22, 28, 38)), 38);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(211,211,211);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->Cell($w_c[0], 6, '', 0, 0, 'C');
        $this->Cell($w_c[1], 6, 'Land and Improvement Details', 0, 0, 'C', true);
        $this->Cell($w_c[2], 6, '', 0, 0, 'C');
        $this->Ln();
        // Header
        $w = array(10, 26, 40, 14, 20, 20, 20, 20, 20, 30, 30, 25, 22, 28, 38, 38);
        $this->SetFillColor(255, 228, 225);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(255, 245, 238);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        for ($i = 0; $i < count($header); $i++){
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        // Data
        $this->SetFont('');
        $item = 1;
        foreach($data as $row)
        {
            $this->Cell($w[0],12,$item, 0, 0, 'C');
            for($j=0; $j<count($w)-1; $j++) {
                $this->Cell($w[$j+1],12,$row[$j], 0, 0, 'C');
            }
            $item++;
            $this->Ln();
        }
    }

    function create_compare_table($header, $data, $add)
    {
        // Column Number
        $w_cell = array(26, 50, 15, 25, 25, 30, 120, 20, 30, 30, 30);
        $this->SetFillColor(135, 206, 250);
        $this->SetTextColor(25, 25, 112);
        $this->SetDrawColor(240, 248, 255);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        for ($i = 0; $i < count($w_cell); $i++)
            $this->Cell($w_cell[$i], 7, 'C' . ($i + 1), 1, 0, 'C', true);
        $this->Ln();
        // Header
        $w = array(26, 50, 15, 25, 25, 30, 20, 20, 20, 20, 20, 20, 20, 30, 30, 30);
        $this->SetFillColor(255, 228, 225);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(255, 245, 238);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        for ($i = 0; $i < count($header); $i++){
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        // Data
        $this->SetFont('');
        $item = 0;
        foreach($data as $row)
        {
            for($j=0; $j<count($w); $j++) {
                if($j==13) {        // C9 Adjusted Property Value
                    $x=$this->GetX();
                    $y=$this->GetY();
                    $this->MultiCell($w[$j],6,$row[$j]."\n".$add['adjust_aver'][$item].'/sqf', 0, 'C');
                    $this->SetXY($x+$w[$j],$y);
                }
                elseif ($j==14) {   // C10 Your Property Value
                    $x=$this->GetX();
                    $y=$this->GetY();
                    $this->MultiCell($w[$j],6,$row[$j]."\n".$add['porperty_aver_val'].'/sqf', 0, 'C');
                    $this->SetXY($x+$w[$j],$y);
                }
                elseif ($j==15) {   // C11 Value Gap
                    $this->MultiCell($w[$j],6,$row[$j]."\n".$add['gap_aver'][$item].'/sqf', 0, 'C');
                }
                else {
                    $this->Cell($w[$j],12,$row[$j], 0, 0, 'C');
                }
            }
            $this->Ln();
            $item++;
        }
        // R1
        $w_r1 = array(311, 30, 60);
        $this->SetFillColor(255,228,225);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(255,228,225);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->Cell($w_r1[0], 12, 'Median Comparable Property Value    ', 0, 0, 'R');
        $x=$this->GetX();
        $y=$this->GetY();
        $this->MultiCell($w_r1[1], 6, $add['mid_val']."\n".$add['mid_aver_val'].'/sqf', 0, 'C', true);
        $this->SetXY($x+$w_r1[1],$y);
        $this->MultiCell($w_r1[2], 12, '', 0, 'C');
        // R2
        $w_r1 = array(311, 30, 60);
        $this->SetFillColor(255,160,122);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(255,160,122);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->Cell($w_r1[0], 12, 'vs. '.$add['address'].' Total Noticed Property Value    ', 0, 0, 'R');
        $x=$this->GetX();
        $y=$this->GetY();
        $this->MultiCell($w_r1[1], 6, $add['porperty_val']."\n".$add['porperty_aver_val'].'/sqf', 0, 'C', true);
        $this->SetXY($x+$w_r1[1],$y);
        $this->MultiCell($w_r1[2], 12, '', 0, 'C');
        // R3
        $w_r1 = array(311, 30, 60);
        $this->SetFillColor(255,127,80);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(255,127,80);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        $this->Cell($w_r1[0], 12, 'Over-valued by    ', 0, 0, 'R');
        $this->Cell($w_r1[1], 12, $add['over_val'], 0, 0, 'C', true);
        $this->Cell($w_r1[2], 12, '', 0, 0, 'C');
        // Closing line
        $this->Ln();
        $this->SetDrawColor(0,0,0);
//        $this->Cell(array_sum($w),0,'','T');
    }
}


