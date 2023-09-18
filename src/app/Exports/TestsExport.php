<?php

namespace App\Exports;

use App\Models\Test;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Carbon\Carbon;

class TestsExport implements FromArray,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    /* public function collection()
    {
        return Test::all();
    }

    public function headings(): array
    {

    } */

    public function array(): array
    {   
        $tests = Test::get(); 
        //$tags = Tagskeysvalues::all();
        
        //$tags = $this->tags_list();

        $resultado = [];

        foreach($tests as $row){            
            $result = [];
            
            $r['id']                = $row['id'];
            $r['name']              = $row->person->name;
            $r['lastname']          = $row->person->lastname;
            $r['email']              = $row->person->email;
            $r['fecha']             = Carbon::create($row['fecha'])->format('d/m/Y');
            $r['status']            = $row->status->description;
            
            foreach ($row->test_detail as $value) {
                $tags_key = []; 
                $tags_key['competencia'] = $value->competencia_related->competencia->competencia;
                $tags_key['score'] = $value->score.' %';
                $tags_key = array_merge($r, $tags_key);
                $result[] = $tags_key;
            }

            
            
            //dd($result);
            $resultado[] = $result;
        }

        return $resultado;
    }

    public function headings(): array
    {
        $header = [
                    'ID',
                    'NOMBRE',
                    'APELLIDO',
                    'EMAIL',
                    'FECHA',
                    'ESTADO',
                    'COMPETENCIA',
                    'RESULTADO (%)',
                ];

        return $header;
    }
        
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                    $event->getSheet()->autoSize();
                    
                    $event->sheet->getDelegate()->getStyle('A1:G1')
                            ->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setARGB('cccccc');                              
                    },
                ];
            }

}