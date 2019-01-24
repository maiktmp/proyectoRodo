<?php

namespace App\Services;


use Carbon\Carbon;

class DateFormatterService
{
    /**
     * Formats a full datetime into:
     * Sábado, 25 de Junio del 2018 a las 09:28 pm
     * @param Carbon $date
     * @return string
     */
    public static function fullDatetime($date)
    {
        $fDate = '';

        if ($date) {
            $fDate = self::dayName($date) . ', ';
            $fDate .= $date->day . ' de ' . self::monthName($date) . ' de ' . $date->year;
            $fDate .= ', ' . $date->format('h:i A');
        } else {
            $fDate = "Sin Asignar";
        }

        return $fDate;
    }

    /**
     * Formats a full date into:
     * Sábado, 25 de Junio del 2018
     * @param Carbon $date
     * @return string
     */
    public static function fullDate($date)
    {
        $fDate = self::fullDatetime($date);

        $fDate = substr(
            $fDate,
            0,
            strrpos($fDate, ','));
        return $fDate;
    }

    /**
     * Gets the localized full name of month for given date
     * @param Carbon $date
     * @return string
     */
    private static function monthName($date)
    {
        switch ($date->month) {
            case 1:
                return "Enero";
            case 2:
                return "Febrero";
            case 3:
                return "Marzo";
            case 4:
                return "Abril";
            case 5:
                return "Mayo";
            case 6:
                return "Junio";
            case 7:
                return "Julio";
            case 8:
                return "Agosto";
            case 9:
                return "Septiembre";
            case 10:
                return "Octubre";
            case 11:
                return "Noviembre";
            case 12:
                return "Diciembre";
        }
    }

    /**
     * Gets the localized full name of day for given date
     * @param Carbon $date
     * @return string
     */
    private static function dayName($date)
    {
        switch ($date->dayOfWeek) {
            case 0:
                return "Domingo";
            case 1:
                return "Lunes";
            case 2:
                return "Martes";
            case 3:
                return "Miércoles";
            case 4:
                return "Jueves";
            case 5:
                return "Viernes";
            case 6:
                return "Sábado";
        }
    }
}