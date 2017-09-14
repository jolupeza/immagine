<?php

use Endroid\SimpleExcel\SimpleExcel;

/**
 * Description of prestudentsController.
 *
 * @author jperez
 */
class prestudentsController extends Controller
{
    private $excel;
    private $headers;

    public function __construct()
    {
        parent::__construct();
        $this->headers = array();
    }

    public function index()
    {
        echo 'hola mundo';
    }

    public function generateExcel($sede = 'all', $level = 'all', $year = 'all')
    {
        $this->excel = new SimpleExcel();
        $objPHPExcel = new PHPExcel();

        $filename = 'admision.xls';
        
        $sede = ($sede === 'all') ? 0 : (int)$sede;
        $level = ($level === 'all') ? 0 : (int)$level;
        $year = ($year === 'all') ? 0 : (int)$year;

        $title = 'Admisión';
        
        if ($sede) {
            $dataSede = get_post($sede);
            $title .= " - Sede: {$dataSede->post_title}";
        }
        
        if ($level) {
            $dataLevel = get_term_by('id', $level, 'levels');
            
            $title .= " - Grado: {$dataLevel->name}";
        }
        
        if ($year) {
            $title .= " - Año: $year";
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Alumnos');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', $title);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

        $this->generateHeaderExcel($objPHPExcel);
        $this->generateCellsExcel($objPHPExcel, $sede, $level, $year);

//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type XLSX
        header('Content-Type: application/vnd.ms-excel'); //mime type XLS
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

//        $this->excel->loadFromArray(array('Postulantes' => $data));
//        $this->excel->saveToOutput($filename, array('Postulantes'));
    }

    private function generateHeaderExcel(PHPExcel $excel)
    {
        $headers = $this->setHeaders();

        if (count($headers)) {
            foreach ($headers as $key => $value) {
                $excel->getActiveSheet()->setCellValue($key, $value);
                $excel->getActiveSheet()->getStyle($key)->getFont()->setSize(11);
                $excel->getActiveSheet()->getStyle($key)->getFont()->setBold(true);
                $excel->getActiveSheet()->getStyle($key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }
        }
    }

    private function setHeaders()
    {
        $this->headers = array(
            'A3' => 'Padre de Familia',
            'B3' => 'DNI / CE',
            'C3' => 'Teléfono / Celular',
            'D3' => 'Correo electrónico',
            'E3' => 'Sede',
            'F3' => 'Horario',
            'G3' => 'Nombre Hijo',
            'H3' => 'Grado',
            'I3' => 'Año',
            'J3' => 'Fecha',
        );

        return $this->headers;
    }

    private function generateCellsExcel(PHPExcel $excel, $sede = 0, $level = 0, $year = 0)
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'prestudents',
        );

        if ($sede) {
            $args['meta_query'][] = [
                'key' => 'mb_sede',
                'value' => $sede
            ];
        }
        
        if ($level) {                    
            $args['tax_query'][] = [
                'taxonomy' => 'levels',
                'field' => 'term_id',
                'terms' => $level
            ];
        }
        
        if ($year) {
            $args['meta_query'][] = [
                'key' => 'mb_year',
                'value' => $year
            ];
        }

        $i = 4;
        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();

                $id = get_the_ID();
                $values = get_post_custom($id);

                $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
                $dni = isset($values['mb_dni']) ? esc_attr($values['mb_dni'][0]) : '';
                $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
                $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
                $sedeRow = isset($values['mb_sede']) ? esc_attr($values['mb_sede'][0]) : '';
                $sonName = isset($values['mb_sonName']) ? esc_attr($values['mb_sonName'][0]) : '';
                $schedule = isset($values['mb_schedule']) ? esc_attr($values['mb_schedule'][0]) : '';
                $yearRow = isset($values['mb_year']) ? esc_attr($values['mb_year'][0]) : '';
                $level = '';
                
                if (!empty($sedeRow)) {
                    $dataSedeRow = get_post($sedeRow);
                }
                
                if (!empty($schedule)) {
                    $dataSchedule = get_post($schedule);
                }

                $levels = get_the_terms($id, 'levels');
                if (count($levels)) {
                    $level = $levels[0];
                }

                $excel->getActiveSheet()->setCellValue('A'.$i, $name);
                $excel->getActiveSheet()->getStyle('A'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('B'.$i, $dni);
                $excel->getActiveSheet()->getStyle('B'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('C'.$i, $phone);
                $excel->getActiveSheet()->getStyle('C'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('D'.$i, $email);
                $excel->getActiveSheet()->getStyle('D'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('E'.$i, $dataSedeRow->post_title);
                $excel->getActiveSheet()->getStyle('E'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('F'.$i, $dataSchedule->post_excerpt);
                $excel->getActiveSheet()->getStyle('F'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('G'.$i, $sonName);
                $excel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('H'.$i, is_object($level) ? $level->name : '');
                $excel->getActiveSheet()->getStyle('H'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('I'.$i, $yearRow);
                $excel->getActiveSheet()->getStyle('I'.$i)->getFont()->setSize(10);

                $excel->getActiveSheet()->setCellValue('J'.$i, get_the_time('d-m-Y'));
                $excel->getActiveSheet()->getStyle('J'.$i)->getFont()->setSize(10);

//                $excel->getActiveSheet()->setCellValue('G'.$i, $datePostulation);
//                $excel->getActiveSheet()->getStyle('G'.$i)->getFont()->setSize(10);
//                $excel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                ++$i;
            }
        }
        wp_reset_postdata();
    }
}
