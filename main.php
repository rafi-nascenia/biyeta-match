<?php

include 'functions.php';

$attributes = include 'attributes.php';
$variations = array(1, 2);

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

foreach ($sampleData['male'] as $male) {
    foreach ($sampleData['female'] as $female) {
        foreach ($variations as $variation) {
            // Male to Female match
            $score = 0;
            $total = 0;

            foreach ($attributes as $name => $attribute) {
                list($scoreVal, $totalVal) = call_user_func(
                    'calcScore'. $variation
                    , $name
                    , $attribute['weight']
                    , $female[$name]
                    , $male[$name .'_Pref']
                );

                $score += $scoreVal;
                $total += $totalVal;
            }

            $sampleData['male'][$male['Name']]['matches'. $variation][$female['Name']] = 100 * $score / $total;

            // Female to Male match
            $score = 0;
            $total = 0;

            foreach ($attributes as $name => $attribute) {
                list($scoreVal, $totalVal) = call_user_func(
                    'calcScore'. $variation
                    , $name
                    , $attribute['weight']
                    , $male[$name]
                    , @$female[$name .'_Pref']
                );

                $score += $scoreVal;
                $total += $totalVal;
            }

            $sampleData['female'][$female['Name']]['matches'. $variation][$male['Name']] = 100 * $score / $total;

            // Mutual match
            $mutualMatch = sqrt(
                $sampleData['male'][$male['Name']]['matches'. $variation][$female['Name']]
                * $sampleData['female'][$female['Name']]['matches'. $variation][$male['Name']]
            );
            $sampleData['male'][$male['Name']]['mutualMatches'][$variation][$female['Name']] = $mutualMatch;
            $sampleData['female'][$female['Name']]['mutualMatches'][$variation][$male['Name']] = $mutualMatch;
        }
    }
}

$outputDir = 'output';
if(!is_dir($outputDir)) {
    mkdir($outputDir);
}

foreach ($sampleData as $gender => $people) {
    foreach ($people as $data) {
        $html = array();
        $html[] = '<!doctype html>';
        $html[] = '<meta charset="utf-8">';
        $html[] = '<script src="../js/Chart.min.js"></script>';
        // match graph

        // mutual-match graph
        $html[] = '<canvas id="mutual-match" width="3840" height="480"></canvas>';
        $chartData = makeChartData($data['mutualMatches']);
        $html[] = <<<JS
<script>
(function() {
    var ctx = document.getElementById('mutual-match').getContext('2d');

    var data = {$chartData}
    var options = {
        animation: false,
        datasetFill: false
    };

    new Chart(ctx).Line(data, options);
})();
</script>
JS;

        // attributes
        $html[] = '<table>';
        $html[] = '<tr><th>Name</th><td>'. $data['Name'] .'</td><td></td></tr>';
        foreach ($attributes as $name => $attribute) {
            if ($attribute['weight'] == 0) {
                continue;
            }
            $html[] = '<tr><th>'. $name .'</th><td>'. $data[$name] .'</td><td>'. $data[$name .'_Pref'] .'</td></tr>';
        }
        $html[] = '</table>';

        // others
        foreach ($sampleData[$gender == 'male' ? 'female' : 'male'] as $otherData) {
            $html[] = '<table>';
            $html[] = '<tr><th>Name</th><td>'. $otherData['Name'] .'</td><td></td></tr>';
            foreach ($attributes as $name => $attribute) {
                if ($attribute['weight'] == 0) {
                    continue;
                }
                $html[] = '<tr><th>'. $name .'</th><td>'. $otherData[$name] .'</td><td>'. $otherData[$name .'_Pref'] .'</td></tr>';
            }
            $html[] = '</table>';
        }

        file_put_contents($outputDir .'/'. $data['Name'] .'.html', implode("\n", $html));
    }
}
