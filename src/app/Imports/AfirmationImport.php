<?php
   
namespace App\Imports;
   
use App\Models\Afirmation;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
    
class AfirmationImport implements ToModel,WithHeadingRow
{
    private $rows = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
               
        ++$this->rows;
        
        $afirmation = new Afirmation;

        $afirmation->text         = $row['afirmacion'];
        $afirmation->ponderacion  = $row['ponderacion'];

        $afirmation->save();
        
        $cant = count($row);

        $compe = array_filter($row, function($v, $k) {
                                            if($k != 'afirmacion' && 
                                               $k != 'ponderacion'){
                                                return $v;
                                            }                                    
                                    }, ARRAY_FILTER_USE_BOTH);

        $afirmation->competencias()->sync($compe);
                                
        return;
    
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }   



}