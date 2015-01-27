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
    if (strpos($prefs, '-') !== false) {
        list($lower, $upper) = explode('-', $prefs);
        $prefValues = range(trim($lower), trim($upper));
    } else {
        $prefValues = array_map('trim', explode(',', $prefs));
    }

    return $prefValues;
}

function calcScore1($type, $name, $weight, $value, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if ($value == '' || $prefs == '') {
        return array(0, 0);
    }

    $score = in_array($value, $prefValues) ? $weight : 0;
    $total = $weight;

    return array($score, $total);
}

function calcScore2($type, $name, $weight, $value, $prefs) {
    $prefValues = parsePrefs($name, $prefs);

    if ($value == '' || $prefs == '') {
        return array(0, 0);
    }

    $valueInRange = in_array($value, $prefValues);
    $start = $prefValues[0];
    $end = $prefValues[count($prefValues) - 1];
    $log = 1 - log(abs($value - average($start, $end)));
    $log10 = 10 - log(abs($value - average($start, $end)));

    if ($type == 'm2f' && in_array($name, array('বয়স', 'উচ্চতা'))) {
        $score = $weight * ($valueInRange ? 1 + log($end/$value) : 0.01 * $log10);
    } elseif ($type == 'm2f' && in_array($name, array('গড়ন', 'শিক্ষাগত যোগ্যতা'))) {
        $score = $weight * ($valueInRange ? 1 : ($log == 1 ? 0.1 : 0.1 * $log));
    } elseif ($type == 'm2f' && in_array($name, array('গায়ের রং', 'নামাজ (muslims only)', 'রোজা (muslims only)'))) {
        $score = $weight * ($valueInRange ? 1 + log($value/$start) : ($log == 1 ? 0.1 : 0.1 * $log));
    } elseif ($type == 'f2m' && in_array($name, array('বয়স'))) {
        $score = $weight * ($valueInRange ? 1 : ($log > 0 ? $log : 0));
    } elseif ($type == 'f2m' && in_array($name, array('উচ্চতা'))) {
        $score = $weight * ($valueInRange ? 1 + log($value/$start) : 0.01 * $log10);
    } elseif ($type == 'f2m' && in_array($name, array('শিক্ষাগত যোগ্যতা', 'নামাজ (muslims only)', 'রোজা (muslims only)', 'গায়ের রং'))) {
        $score = $weight * ($valueInRange ? 1 + log($value/$start) : ($log == 1 ? 0.1 : 0.1 * $log));
    } elseif ($type == 'f2m' && in_array($name, array('গড়ন'))) {
        $score = $weight * ($valueInRange ? 1 : ($log == 1 ? 0.1 : 0.1 * $log));
    } else {
        $score = $valueInRange ? $weight : 0;
    }
    $total = $weight;

    return array($score, $total);
}

function makeChartData($rawData) {
    $colors = array(
        1 => '#ff5500',
        2 => '#ffb692',
        4 => '#009dfe',
        3 => '#b0e1ff',
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

function average($from, $to) {
    return ($from + $to) / 2;
}
