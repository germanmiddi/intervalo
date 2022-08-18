<?php
   
namespace App\Imports;
   
use App\Models\Afirmation;
use App\Models\Competencia;

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
        // VERIFICO LAS COMPETENCIAS
        $cant_competencias = Competencia::count();
        $competencias = [];

        for($i = 1; $cant_competencias; $i++) {
            if($row[$i] != ''){
                $id = Competencia::select('id')->where('competencia', $row[$i])->get();
                if(count($id) > 0){
                    $competencias[$i-1] = $id[0]->id;
                }
            }else{
                break;
            }
        }

        // VERIFICO LA EXISTENCIA DE LA AFIRMACION
        if (!Afirmation::where('text', strtolower($row['afirmacion']))->exists() && $row['afirmacion'] != '') {

            $afirmation = new Afirmation;
            $afirmation->text         =  $row['afirmacion'];
            $afirmation->ponderacion  = $row['ponderacion'];
            
            $afirmation->save();
            
        }else{
            $afirmation = Afirmation::where('text', $row['afirmacion'])->first();
            foreach ($afirmation->competencias as $c) {
                array_push($competencias, $c->id);
            }
        }
        $afirmation->competencias()->sync($competencias);

        return;
    
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }   

    public function getStatus() 
    {
        $retorno = 'Se han procesado un total de '.strval($this->rows).' registros';
        return $retorno;
    }

}