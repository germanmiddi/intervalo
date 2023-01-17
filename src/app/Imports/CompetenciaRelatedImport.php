<?php
   
namespace App\Imports;
   
use App\Models\Competencia;
use App\Models\CompetenciaRelated;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Facades\Log;
    
class CompetenciaRelatedImport implements ToModel,WithHeadingRow
{
    private $rows = 0;
    private $rowsInvalidos = 0;
    private $registrosInvalidos = '';
    private $registrosIncompletos = '';

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {      
        ++$this->rows;
        //$id = Competencia::where('competencia', $row['competencia'])->first()->id;
        $id_competencia = $this->comparar_competencia($row['competencia']);
        $id_competencia_relacionada = $this->comparar_competencia($row['competencia_relacionada']);

        if ($id_competencia != 0 && $id_competencia_relacionada != 0) {
            try {
                $data = [];
                if($row['devolucion_positiva']){
                    $data['feedback_approve'] = $row['devolucion_positiva'];
                }
                if($row['devolucion_negativa']){
                    $data['feedback_disapprove'] = $row['devolucion_negativa'];
                }

                CompetenciaRelated::updateOrCreate(
                    ['competencia_id' => $id_competencia , 'relate_id' => $id_competencia_relacionada],
                    $data
                );
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }
                

            if($row['devolucion_positiva'] == '' || $row['devolucion_negativa'] == ''){
                $this->registrosIncompletos .= 'Registro N° '. strval($this->rows+1).' - '. $row['competencia'] .'-'. $row['competencia_relacionada'].' posee campos incompletos <br>';
            }

        }else{
            ++$this->rowsInvalidos;
            $this->registrosInvalidos .= ' - Registro N° '. strval($this->rows+1).' - '. $row['competencia'] .' <br> ';
        }                 
        return;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    } 

    public function getStatus() 
    {
        $retorno = 'Se han procesado un total de '.strval($this->rows).' registros <br> ';

        if($this->rowsInvalidos > 0){
            $retorno .= 'Se ha detectado un total de '.strval($this->rowsInvalidos). ' relaciones con competencias inexistentes <br>';
        }

        $retorno .= $this->registrosInvalidos;
        $retorno .= $this->registrosIncompletos;
        return $retorno;
    }

    function comparar_competencia($competencia){
        $competencia_import = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $this->elimina_acentos($competencia));
        $competencias = Competencia::select('competencia','id')->get();
        $listado = [];

        foreach ($competencias as $c) {
            $competencia_database = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $this->elimina_acentos($c['competencia']));
            if($competencia_database === $competencia_import){
                //dd("competencia: ". $c['id']);
                return $c['id'];
            }
        }
        return 0;
    }
    function elimina_acentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
 
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
 
            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',
 
            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
 
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
        );
 
        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }

    
}