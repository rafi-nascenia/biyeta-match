<?php

function readCsv($filename) {
    $file = new SplFileObject($filename);
    $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

    $header = null;
    $data = array();

    foreach ($file as $i => $line) {
        if ($header == null) {
            $header = $line;
            continue;
        }

        $size = min(count($header), count($line));
        $data[] = array_combine(array_slice($header, 0, $size), $line);
    }

    return $data;
}

function pick($data, $attr) {
    $values = array();
    foreach ($data as $row) {
        $values = array_merge($values, explode(',', $row[$attr]));
    }
    return array_unique($values);
}

function parsePrefs($name, $prefs) {
    $prefValues = explode(',', $prefs);

    if ($name == 'Age between') {
        list($lower, $upper) = explode(' To ', $prefs);
        $prefValues = range($lower, $upper);
    } elseif ($name == 'Height') {
        $limits = explode(',', $prefs);
        list(, $lower) = explode(' - ', $limits[0]);
        list(, $upper) = explode(' - ', $limits[1]);
        $prefValues = range(intval($lower), intval($upper));
    }

    return $prefValues;
}

function calcScore($name, $weight, $value, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if ($prefValues == '' || in_array("Doesn't Matter", $prefValues)) {
        return array(0, 0);
    }

    $score = in_array($value, $prefValues) ? $weight : 0;
    $total = $weight;

    return array($score, $total);
}

function randAttr($gender, $name, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if (in_array($name, array('Age between', 'Height', 'Education'))) {
        return $gender == 'male' ? end($prefValues) : current($prefValues);
    }

    return $prefValues[array_rand($prefValues)];
}
