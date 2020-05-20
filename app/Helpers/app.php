<?php
/*
 *  Includes a set of CSS sheets
 */
if (!function_exists('includeCss')) {
    function includeCss(...$sheets)
    {
        $sheets = collect(\Illuminate\Support\Arr::flatten($sheets));

        return $html = $sheets->reduce(function($html, $sheet){
                return $html . '<link rel="stylesheet" media="screen, print" type="text/css" href="'.asset($sheet).'">';
        });
    }
}
/*
 *  Includes a set of scripts
 */
if (!function_exists('includeScript')) {
    function includeScript(...$scripts)
    {
        $scripts = collect(\Illuminate\Support\Arr::flatten($scripts));

        return $html = $scripts->reduce(function($html, $script){
            return $html . '<script  src="'.asset($script).'"></script>';
        });
    }
}
/*
 *  check if $route is the current active Route
 */
if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route)
    {
        if (Route::currentRouteName() == $route) {
            return true;
        }

        return false;
    }
}
/*
 * get Numbers in Alpha notation
 */
if (!function_exists('numToAlpha')) {
    function numToAlpha($number)
    {
        if (is_numeric($number)) {
            $number = intval($number);
            $letter = '';
            if ($number > 0) {
                while ($number != 0) {
                    $p = ($number -1 ) % 26;
                    $number = intval(($number - $p) / 26);
                    $letter = chr(65 + $p) . $letter;
                }
            }
            return $letter;
        } else {
            throw new Exception('Variable must be numeric.');
        }
    }
}

if (!function_exists('getFormattedDate')) {
    function getFormattedDate($date)
    {
        if (stristr($date,'/')) {
            $delimiter = '/';
        } elseif (stristr($date,'.')) {
            $delimiter = '.';
        } else {
            $delimiter = '-';
        }
        $auxArray = explode($delimiter,$date);
        if (is_array($auxArray) && count($auxArray) == 3) {
            if (strlen($auxArray[0]) == 4) {
                $auxArray[1] = substr("0{$auxArray[1]}", -2);
                $auxArray[2] = substr("0{$auxArray[2]}", -2);
                return implode('-',$auxArray);
            } else {
                $auxArray[0] = substr("0{$auxArray[0]}", -2);
                $auxArray[1] = substr("0{$auxArray[1]}", -2);
                return implode('-',array_reverse($auxArray));
            }
        } else {
            return null;
        }
    }
}

if (!function_exists('makeValidation')) {
    function makeValidation($form,$url,$onSuccess = '')
    {
        return view('app.components.forms.validation',compact(['form','url','onSuccess']));
    }
}

if (!function_exists('getMainMenuItems')) {
    function getMainMenuItems()
    {

    }
}

if (!function_exists('makeDefaultView')) {
    function makeDefaultView($columns,$entity,$navBar = false)
    {
        //return view('components.views.crud', compact('columns','entity','navBar'));
    }
}

if(!function_exists('diffInHoursOrDays')){
    function diffInHoursOrDays($start_date,$end_date)
    {
        $sd = \Carbon\Carbon::parse($start_date);
        $ed = \Carbon\Carbon::parse($end_date);

        if($diff = $sd->diffInHours($ed) > 24) {
            return $sd->diffInDays($ed).' Días';
        }

        return $diff.' Horas';

    }
}

if(!function_exists('shortBigNumbers')) {
    function shortBigNumbers($n, $precision = 1) {
        if ($n < 1000) {
            // Anything less than a million
            $n_format = number_format($n);
        } elseif ($n >= 1000 && $n < 1000000){

            $n_format = number_format(($n / 1000), $precision,',','.') . 'K';
        }
        else  {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision,',','.') . 'M';
        }

        return $n_format;
    }
}


if (!function_exists('convertColumns')) {
    function convertColumns($columns)
    {
        $columns->toArray();
        return json_encode($columns);
    }
}

if(!function_exists('validateRut')) {
    function validateRut($rut)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv  = substr($rut, -1);
        $number = substr($rut, 0, strlen($rut)-1);
        $i = 2;
        $sum = 0;
        foreach(array_reverse(str_split($number)) as $v)
        {
            if($i==8)
                $i = 2;

            $sum += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($sum % 11);

        if($dvr == 11)
            $dvr = 0;
        if($dvr == 10)
            $dvr = 'K';

        if($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }
}

if (!function_exists('random_code')) {
    function random_code($length = 6)
    {
        $str_result = md5(\Carbon\Carbon::now()->toDateTimeString().rand(0,1000000));
        return substr(str_shuffle($str_result), 0, $length);
    }
}

