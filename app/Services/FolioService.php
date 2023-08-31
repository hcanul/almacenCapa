<?php

namespace App\Services;

class FolioService
{
    public static function generarFolio()
    {
        // Define los caracteres permitidos para el folio
        $caracteresPermitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Calcula la longitud de los caracteres permitidos
        $longitudCaracteres = strlen($caracteresPermitidos);

        // Inicializa el folio como una cadena vacía
        $folio = '';

        // Genera un folio de 10 caracteres seleccionando caracteres aleatorios de la lista de permitidos
        for ($i = 0; $i < 10; $i++) {
            $folio .= $caracteresPermitidos[random_int(0, $longitudCaracteres - 1)];
        }

        return $folio;
    }
}
