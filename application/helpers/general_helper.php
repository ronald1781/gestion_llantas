<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hallatiposer'))
{
    function hallatiposer($tposrv) {
        SWITCH($tposrv){
            CASE "1":
                $nomsuc='Incidencia';
                break;
            CASE "2":
                $nomsuc='Peticion';
                break;
            CASE "3":
                $nomsuc='Problema';
                break; 
            CASE "4":
                $nomsuc='Cambios';
                break;
                 
        }
        return $nomsuc;
    }
}


?>


