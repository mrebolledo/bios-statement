<?php

if (!function_exists('makeLinkRemote')) {
    function makeLinkRemote()
    {
        return ' data-toggle="modal" data-target="#remoteModal" ';
    }
}

if (!function_exists('makeLink')) {
    function makeLink($url,$caption,$icon = '',$color = 'btn-primary',$size = 'btn-md',$grouped = false)
    {
        return getButton([
            'color' => $color,
            'url' => $url,
            'caption' => $caption,
            'size' => $size,
            'icon' => $icon,
            'grouped' => $grouped
        ]);
    }
}

if (!function_exists('makeRemoteLink')) {
    function makeRemoteLink($url,$caption,$icon = '',$color = 'btn-primary',$size = 'btn-md',$grouped = false)
    {
        return getButton([
            'color' => $color,
            'url' => $url,
            'caption' => $caption,
            'size' => $size,
            'grouped' => $grouped,
            'icon' => $icon,
            'remote' => true
        ]);
    }
}

if (!function_exists('makeAddLink')) {
    function makeAddLink($url = '',$remote = true)
    {
        if($remote) {
            return makeRemoteLink('/'.$url.'/create'.$variables,'Agregar Nuevo','fa-plus','btn-primary','btn-sm');
        } else {
            return makeLink('/'.$url.'/create'.$variables,'Agregar Nuevo','fa-plus','btn-primary','btn-sm');
        }
    }
}

if (!function_exists('makeEditButton')) {
    function makeEditButton($url = '',$remote = true,$grouped = false)
    {
        if($remote) {
            return makeRemoteLink($url,'Modificar','fa-pencil-alt','btn-warning','btn-sm',$grouped);
        } else {
            return makeLink($url,'Modificar','fa-pencil-alt','btn-warning','btn-sm',$grouped);
        }
    }
}

if (!function_exists('makeLinkOnClick'))
{
    function makeLinkOnClick($url,$caption,$icon = '',$color = 'btn-primary',$size = 'btn-md',$grouped = false,$onClick = '')
    {
        return getButton([
            'color' => $color,
            'url' => $url,
            'caption' => $caption,
            'size' => $size,
            'grouped' => $grouped,
            'icon' => $icon,
            'onClick' => $onClick
        ]);
    }
}

if (!function_exists('makeDeleteButton')) {
    function makeDeleteButton($texto,$url,$aditionals = false,$grouped = false)
    {
        $onClick = 'deleteRecord(\'' . $texto . '\',\'' . $url . '\',' . $aditionals . ')';
        return makeLinkOnClick('javascript:void(0);', 'Eliminar', 'fa-trash-alt', 'btn-danger', 'btn-sm', $grouped, $onClick);
    }
}

if (!function_exists('getButton')) {
    function getButton($options)
    {
        if (!is_array($options)) {
            throw new Exception("Button options are not an array.");
        }
        if (!isset($options['url']) || trim($options['url']) == '') {
            throw new Exception('URL property must be added');
        }
        if (!isset($options['caption'])) {
            throw new Exception('Caption property must be added');
        }
        $html = '<a href="'.$options['url'].'"'.
                ' class="';
        if (isset($options['grouped']) && $options['grouped'] == true) {
            $html = $html . 'dropdown-item';
        } else {
            $html = $html . 'btn '.$options['color'].' '.$options['size'];
        }
        $html = $html .'"';
        if (isset($options['remote']) && $options['remote'] == true) {
            $html = $html . makeLinkRemote();
        }
        if (isset($options['onClick']) && $options['onClick'] != '') {
            $html = $html. ' onClick="'.$options['onClick'].'"';
        }
        $html = $html. '>';
        if (isset($options['icon']) && trim($options['icon']) != '') {
            $html = $html.'<i class="fas '.$options['icon'].'"></i>';
        }
        return  $html.' '.$options['caption'].'</a>';
    }
}

if (!function_exists('makeGroupedLinks')) {
    function makeGroupedLinks($buttons)
    {
        if (is_array($buttons)) {
            $html = '<div class="btn-group btn-group-xs">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu">';
            foreach ($buttons as $button) {
                  $html = $html. $button;
            }
            return $html . '</div></div>';
        } else {
            throw new Exception("Buttons must be an array");
        }
    }
}

if (!function_exists('makeBackButton'))
{
    function makeBackButton()
    {
        return makeLink(url()->previous(),'Volver', 'fa-arrow-left','btn-info','btn-sm');
    }
}
