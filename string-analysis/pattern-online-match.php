<?php

    set_time_limit(0);
    ini_set('memory_limit', '256M');

    function get_link_list($link)
    {
        $string = file_get_contents($link);
        $out = preg_match_all('/<td><a href=\".*?\">([A-Z]*)[ ]?<\/a>.*?<\/td>/', $string, $matchs);

        return $matchs[1];
    }

    function save_link_list($link, $file)
    {
        $array = get_link_list($link);

        $handle = fopen($file, 'w');

        fwrite($handle, '<list>');

        foreach ($array as $chiaveuno => $nome) {
            fwrite($handle, '<item>'.$nome.'</item>');
        }

        fwrite($handle, '</list>');

        fclose($handle);

        return $array;
    }

    function get_file_list($file)
    {
        $xml = simplexml_load_file($file);

        return $xml->item;
    }
