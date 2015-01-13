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
//     $values = array_values(array_unique(array_merge(pick($masterData['female'], $attr), pick($masterData['male'], $attr))));
//     sort($values);
//     print_r($values);
// }

$sampleData = array();

// == Generate Sample Data
// foreach (array('female', 'male') as $gender) {
//     $sampleData = array();
//     foreach ($masterData[$gender] as $i => $data) {
//         $sampleData[$gender][$data['Name']]['Name'] = $data['Name'];
// 
//         foreach ($attributes as $name => $attribute) {
//             $attr = randAttr($gender, $name, @$data[$name]);
//             if ($attr == "Doesn't Matter" || empty($attr)) {
//                 $attr = $attribute['value']();
//             }
// 
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
}

$matches = array();
$mutualMatches = array();

foreach ($sampleData['male'] as $male) {
    foreach ($sampleData['female'] as $female) {
        // Male to Female match
        $score = 0;
        $total = 0;

        foreach ($attributes as $name => $attribute) {
            list($scoreVal, $totalVal) = calcScore(
                $name
                , $attribute['weight']
                , $female[$name]
                , $male[$name .'_Pref']
            );

            $score += $scoreVal;
            $total += $totalVal;
        }

        $sampleData['male'][$male['Name']]['matches'][$female['Name']] = 100 * $score / $total;

        // Female to Male match
        $score = 0;
        $total = 0;

        foreach ($attributes as $name => $attribute) {
            list($scoreVal, $totalVal) = calcScore(
                $name
                , $attribute['weight']
                , $male[$name]
                , @$female[$name .'_Pref']
            );

            $score += $scoreVal;
            $total += $totalVal;
        }

        $sampleData['female'][$female['Name']]['matches'][$male['Name']] = 100 * $score / $total;

        // Mutual match
        $mutualMatch = sqrt(
            $sampleData['male'][$male['Name']]['matches'][$female['Name']]
            * $sampleData['female'][$female['Name']]['matches'][$male['Name']]
        );
        $sampleData['male'][$male['Name']]['mutualMatches'][$female['Name']] = $mutualMatch;
        $sampleData['female'][$female['Name']]['mutualMatches'][$male['Name']] = $mutualMatch;
    }
}

foreach ($sampleData as $gender => $people) {
    foreach ($people as $name => $data) {
        arsort($data['matches']);
        arsort($data['mutualMatches']);

        file_put_contents('data/'. $name .'.json', json_encode($data, JSON_PRETTY_PRINT));
    }
}
