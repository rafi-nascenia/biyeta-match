<?php

include 'functions.php';

$attributes = include 'attributes.php';

// == Fetch master data
$masterData = array(
    'female' => readCsv('data/female-prefs.csv'),
    'male' => readCsv('data/male-prefs.csv'),
);

// == Generate Possible Values
// foreach (array_keys($attributes) as $attr) {
//     echo $attr . PHP_EOL;
//     $values = array_values(array_unique(array_merge(pick($females, $attr), pick($males, $attr))));
//     sort($values);
//     print_r($values);
// }

$sampleData = array();

// == Generate Sample Data
// foreach (array('female', 'male') as $gender) {
//     $sampleData = array();
//     foreach ($masterData[$gender] as $i => $data) {
//         $masterData[$gender][$i]['@attr'] = array();
//         foreach ($attributes as $name => $attribute) {
//             $attr = randAttr($gender, $name, @$data[$name]);
//             if ($attr == "Doesn't Matter" || empty($attr)) {
//                 $attr = $attribute['value']();
//             }
// 
//             $masterData[$gender][$i]['@attr'][$name] = $attr;
//             $sampleData[$gender][$data['Name']][$name] = $attr;
//             $sampleData[$gender][$data['Name']][$name .'_Pref'] = @$data[$name];
//         }
//     }
//     file_put_contents('data/'. $gender .'-sample.json', json_encode($sampleData[$gender], JSON_PRETTY_PRINT));
// }
// 
// print_r($sampleData);exit;

foreach (array('female', 'male') as $gender) {
    $sampleData[$gender] = json_decode(file_get_contents('data/'. $gender .'-sample.json'), true);
    foreach ($masterData[$gender] as $i => $data) {
        $masterData[$gender][$i]['@attr'] = $sampleData[$gender][$data['Name']];
    }
}

$matches = array();
$mutualMatches = array();

foreach ($masterData['male'] as $male) {
    foreach ($masterData['female'] as $female) {
        $score = 0;
        $total = 0;

        foreach ($attributes as $name => $attribute) {
            list($scoreVal, $totalVal) = calcScore($name, $attribute['weight'], $female['@attr'][$name], $male[$name]);

            $score += $scoreVal;
            $total += $totalVal;
        }

        $matches[$male['Name']][$female['Name']] = 100 * $score / $total;

        $score = 0;
        $total = 0;

        foreach ($attributes as $name => $attribute) {
            list($scoreVal, $totalVal) = calcScore($name, $attribute['weight'], $male['@attr'][$name], @$female[$name]);

            $score += $scoreVal;
            $total += $totalVal;
        }

        $matches[$female['Name']][$male['Name']] = 100 * $score / $total;

        $mutualMatches[$male['Name']][$female['Name']] = sqrt(
            $matches[$male['Name']][$female['Name']]
            * $matches[$female['Name']][$male['Name']]
        );
    }
}

arsort($matches['ROHAN KHAN']);
arsort($mutualMatches['ROHAN KHAN']);
print_r($matches['ROHAN KHAN']);
print_r($mutualMatches['ROHAN KHAN']);
