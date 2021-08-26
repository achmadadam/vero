<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class Admin extends CI_Controller 
{

public function __construct()
    {
        parent::__construct();

        $this->load->model("M_Admin");
        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['title'] = 'Laporan Lembur';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $keyword = $this->input->post('keyword');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        // if ($this->input->post('search'))
        // {
        // 	$data['keyword'] = $this->input->post('keyword');
        // 	$this->session->set_userdata('keyword', $data['keyword']);
        // }
        // else 
        // {
        // 	$data['keyword'] = $this->session->userdata('keyword');
    
        // }
    
        $data['lembur'] = $this->M_Admin->get_lembur($keyword, $startDate, $endDate);
        $data['chart'] = $this->M_Admin->get_chart(1);
        $label = array();
        $chartData = array();
        for ($i=0; $i < count($data['chart']); $i++) { 
            array_push($label, $data['chart'][$i]['DATE']);
            array_push($chartData, $data['chart'][$i]['all']);
        };
        $data['label'] = $label;
        $data['chartData'] = $chartData;
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_adm', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function data_adm()
    {
        $data['title'] = 'Laporan Lembur';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $keyword = $this->input->post('keyword');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        // if ($this->input->post('search'))
        // {
        // 	$data['keyword'] = $this->input->post('keyword');
        // 	$this->session->set_userdata('keyword', $data['keyword']);
        // }
        // else 
        // {
        // 	$data['keyword'] = $this->session->userdata('keyword');
    
        // }
    
        $data['lembur'] = $this->M_Admin->get_lembur($keyword, $startDate, $endDate);
        $data['chart'] = $this->M_Admin->get_chart(1);
        $label = array();
        $chartData = array();
        for ($i=0; $i < count($data['chart']); $i++) { 
            array_push($label, $data['chart'][$i]['DATE']);
            array_push($chartData, $data['chart'][$i]['all']);
        };
        $data['label'] = $label;
        $data['chartData'] = $chartData;
    
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar_adm', $data);
        $this->load->view('admin/data_adm', $data);
        $this->load->view('templates/footer');
    }
    public function cetaklaporan()
    {
        $data['title'] = 'Laporan Lembur';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $keyword = $this->input->post('keyword');
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        // if ($this->input->post('search'))
        // {
        // 	$data['keyword'] = $this->input->post('keyword');
        // 	$this->session->set_userdata('keyword', $data['keyword']);
        // }
        // else 
        // {
        // 	$data['keyword'] = $this->session->userdata('keyword');
    
        // }
    
        $data['lembur'] = $this->M_Admin->get_lembur($keyword, $startDate, $endDate);
        $data['chart'] = $this->M_Admin->get_chart(1);
        $label = array();
        $chartData = array();
        for ($i=0; $i < count($data['chart']); $i++) { 
            array_push($label, $data['chart'][$i]['DATE']);
            array_push($chartData, $data['chart'][$i]['all']);
        };
        $data['label'] = $label;
        $data['chartData'] = $chartData;
    
        $this->load->view('templates/header', $data);
        $this->load->view('admin/cetaklaporan', $data);
        $this->load->view('templates/footer');
    }

public function laporan()
{
    $tgl_awal = '2021-08-05';
    $tgl_akhir = '2021-08-06';
	$this->db->select('*');
    $this->db->from('input_spl');
    $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
    // $this->db->where("date BETWEEN $tgl_awal AND $tgl_akhir");
    $querylap = $this->db->get()->result_array();
    
    include_once APPPATH.'/third_party/xlsxwriter.class.php';
      ini_set('display_errors', 0);
      ini_set('log_errors', 1);
      error_reporting(E_ALL & ~E_NOTICE);

      $filename = "laporan_spl".".xlsx";
      header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
      header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
      header('Content-Transfer-Encoding: binary');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');

        $header = array(
        'no.'=>'string',    
        'name'=>'string',
        'date'=>'string',
        'divisi'=>'string',
        'jo'=>'string',
        'qty'=>'string',
        'time'=>'string',
      );
        $writer = new XLSXWriter();
        $writer->setAuthor('Manusia');
        $writer->writeSheetHeader('Sheet1', $header, $styles);
        $no = 1;
        foreach($querylap as $ql){
            $writer->writeSheetRow('Sheet1', [$no, $ql['name'], $ql['date'], $ql['divisi'], $ql['jo'], $ql['qty'], $ql['time']], $styles2);
            $no++;
          }
          $writer->writeToStdOut();




    $object = new PHPExcel();
    $object->getProperties()->setCreator("Laporan Surat Perintah Lembur");
    $object->getProperties()->setLastModifiedBy("Laporan Surat Perintah Lembur");
    $object->getProperties()->setTitle("Laporan SPL");

    $object->setActiveSheetIndex(0);
    $object->getActiveSheet()->setCellValue('A1', 'Nama ');
    $object->getActiveSheet()->setCellValue('B1', 'Date');
    $object->getActiveSheet()->setCellValue('C1', 'Division');
    $object->getActiveSheet()->setCellValue('D1', 'No Job Order');
    $object->getActiveSheet()->setCellValue('E1', 'Qty');
    $object->getActiveSheet()->setCellValue('F1', 'Time');
    
    $baris = 2;
    $no = 1;

    foreach ($querylap as $ql) 
    {
        $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
        $object->getActiveSheet()->setCellValue('B'.$baris, $ql['name']);
        $object->getActiveSheet()->setCellValue('C'.$baris, $ql['date']);
        $object->getActiveSheet()->setCellValue('D'.$baris, $ql['divisi']);
        $object->getActiveSheet()->setCellValue('E'.$baris, $ql['jo']);
        $object->getActiveSheet()->setCellValue('F'.$baris, $ql['qty']);
        $object->getActiveSheet()->setCellValue('G'.$baris, $ql['time']);
        $baris++;
    }

    $filename = "Laporan_SPL_".date('Ymd').'.xlsx';
    
    $object->getActiveSheet()->setTitle("Laporan SPL");

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    $writer->save('php://output');

    exit;


        
}

    public function laporan2() {

        $tgl_awal = '';
        $tgl_akhir = '';
        $this->db->select('input_spl.*, user.name');
        $this->db->from('input_spl');
        $this->db->join('user', 'user.id = input_spl.user_id');
        $this->db->where("input_spl.status_id = 1");
        // $this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
        // $this->db->where("date BETWEEN $tgl_awal AND $tgl_akhir");
        $querylap = $this->db->get()->result_array();
        
        $spreadsheet = new Spreadsheet();
        for ($i=0; $i < 1; $i++) { 
            $spreadsheet->createSheet();   
        }
        $sheet = $spreadsheet->getSheet(0);
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Date');
        $sheet->setCellValue('D1', 'Divisi');
        $sheet->setCellValue('E1', 'Jo');
        $sheet->setCellValue('F1', 'Qty');
        $sheet->setCellValue('G1', 'Time');
        $rows = 2;

        $no = 1;

        foreach ($querylap as $ql) 
        {
            $sheet->setCellValue('A'.$rows, $no++);
            $sheet->setCellValue('B'.$rows, $ql['name']);
            $sheet->setCellValue('C'.$rows, $ql['date']);
            $sheet->setCellValue('D'.$rows, $ql['divisi']);
            $sheet->setCellValue('E'.$rows, $ql['jo']);
            $sheet->setCellValue('F'.$rows, $ql['qty']);
            $sheet->setCellValue('G'.$rows, $ql['time']);
            $rows++;
        }

        $sheet2 = $spreadsheet->getSheet(1);
        $sheet2->fromArray(
            [
                ['', 2010, 2011, 2012],
                ['Q1', 12, 15, 21],
                ['Q2', 56, 73, 86],
                ['Q3', 52, 61, 69],
                ['Q4', 30, 32, 0],
            ]
        );
        
        // Set the Labels for each data series we want to plot
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1', null, 1), // 2010
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$C$1', null, 1), // 2011
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$D$1', null, 1), // 2012
        ];
        // Set the X-Axis Labels
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $xAxisTickValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$5', null, 4), // Q1 to Q4
        ];
        // Set the Data values for each data series we want to plot
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$5', null, 4),
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$2:$C$5', null, 4),
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$D$2:$D$5', null, 4),
        ];
        
        // Build the dataseries
        $series = new DataSeries(
            DataSeries::TYPE_BARCHART, // plotType
            DataSeries::GROUPING_CLUSTERED, // plotGrouping
            range(0, count($dataSeriesValues) - 1), // plotOrder
            $dataSeriesLabels, // plotLabel
            $xAxisTickValues, // plotCategory
            $dataSeriesValues        // plotValues
        );
        // Set additional dataseries parameters
        //     Make it a horizontal bar rather than a vertical column graph
        $series->setPlotDirection(DataSeries::DIRECTION_BAR);
        
        // Set the series in the plot area
        $plotArea = new PlotArea(null, [$series]);
        // Set the chart legend
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        
        $title = new Title('Test Bar Chart');
        $yAxisLabel = new Title('Value ($k)');
        
        // Create the chart
        $chart = new Chart(
            'chart1', // name
            $title, // title
            $legend, // legend
            $plotArea, // plotArea
            true, // plotVisibleOnly
            DataSeries::EMPTY_AS_GAP, // displayBlanksAs
            null, // xAxisLabel
            $yAxisLabel  // yAxisLabel
        );
        
        // Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A7');
        $chart->setBottomRightPosition('H20');
        
        // Add the chart to the worksheet
        $sheet2->addChart($chart);
        
        $fileName = "Laporan_SPL_".date('Ymd').'.xlsx';

        // $writer = new Xlsx($spreadsheet);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
        
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('world.xlsx');
        // return $this->response->download('world.xlsx', null)->setFileName('sample.xlsx');
    }

    public function chartReport() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getSheet(0);
        $array = [['Date', 'Value']];
        $chartData = $this->M_Admin->get_chart(1);

        for ($i=0; $i < count($chartData); $i++) { 
            $header = $chartData[$i]['DATE'];
            $value = $chartData[$i]['all'];
            array_push($array, [$header, $value]);
        }
        
        $sheet->fromArray($array);
        
        // Set the Labels for each data series we want to plot
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $dataSeriesLabels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1', null, 1), // 2010
        ];
        // Set the X-Axis Labels
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $xAxisTickValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$12', null, 4), // Q1 to Q4
        ];
        // Set the Data values for each data series we want to plot
        //     Datatype
        //     Cell reference for data
        //     Format Code
        //     Number of datapoints in series
        //     Data values
        //     Data Marker
        $dataSeriesValues = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$12', null, 4),
            // new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$2:$C$5', null, 4),
            // new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$D$2:$D$5', null, 4),
        ];
        
        // Build the dataseries
        $series = new DataSeries(
            DataSeries::TYPE_BARCHART, // plotType
            DataSeries::GROUPING_CLUSTERED, // plotGrouping
            range(0, count($dataSeriesValues) - 1), // plotOrder
            $dataSeriesLabels, // plotLabel
            $xAxisTickValues, // plotCategory
            $dataSeriesValues        // plotValues
        );
        // Set additional dataseries parameters
        //     Make it a horizontal bar rather than a vertical column graph
        $series->setPlotDirection(DataSeries::DIRECTION_COL);
        
        // Set the series in the plot area
        $plotArea = new PlotArea(null, [$series]);
        // Set the chart legend
        $legend = new Legend(Legend::POSITION_RIGHT, null, false);
        
        $title = new Title('Bar Chart');
        $yAxisLabel = new Title('Value');
        
        // Create the chart
        $chart = new Chart(
            'chart1', // name
            $title, // title
            $legend, // legend
            $plotArea, // plotArea
            true, // plotVisibleOnly
            DataSeries::EMPTY_AS_GAP, // displayBlanksAs
            null, // xAxisLabel
            $yAxisLabel  // yAxisLabel
        );
        
        // Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('A7');
        $chart->setBottomRightPosition('H17');
        
        // Add the chart to the worksheet
        $sheet->addChart($chart);
        
        $fileName = "Laporan_SPL_Chart".date('Ymd').'.xlsx';

        // $writer = new Xlsx($spreadsheet);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }

}

