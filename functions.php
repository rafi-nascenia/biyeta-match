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

        $data[] = array_combine($header, $line);
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

function calcScore1($name, $weight, $value, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if ($prefs == '' || in_array("Doesn't Matter", $prefValues)) {
        return array(0, 0);
    }

    $score = in_array($value, $prefValues) ? $weight : 0;
    $total = $weight;

    return array($score, $total);
}

function calcScore2($name, $weight, $value, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if ($prefs == '' || in_array("Doesn't Matter", $prefValues)) {
        return array(0, 0);
    }

    if ($name == 'Height') {
        if (in_array($value, $prefValues)) {
            $score = ($value - $prefValues[0]) * ($weight - $weight/2) / ($prefValues[count($prefValues) - 1] - $prefValues[0]) + $weight/2;
        } else {
            $score = 0;
        }
    } else {
        $score = in_array($value, $prefValues) ? $weight : 0;
    }
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

function makeChartData($rawData) {
    $colors = array(
        1 => '#e08600',
        2 => '#ffddaa',
        4 => '#da00b5',
        3 => '#ffb8f3',
    );

    $labels = array();
    $datasets = array();

    foreach ($rawData as $variation => $matches) {
        $color = $colors[$variation];

        $labels = array_keys($matches);
        $datasets[] = array(
            'label' => $variation,
            'strokeColor' => $color,
            'fillColor' => $color,
            'data' => array_values($matches),
        );
    }

    return json_encode(array(
        'labels' => $labels,
        'datasets' => $datasets,
    ));
}
