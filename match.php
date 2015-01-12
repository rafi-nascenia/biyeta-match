<?php

$attributes = array(
    'Age between' => array(
        'weight' => 1000,
        'value' => function () {
            return rand(18, 60);
        },
    ),
    'Marital Status' => array(
        'weight' => 250,
        'value' => function () {
            $values = array(
                'AL',
                'Divorced',
                'Never Married',
                'Widowed',
            );

            return $values[array_rand($values)];
        },
    ),
    'Children' => array(
        'weight' => 10,
        'value' => function () {
            $values = array(
                'No',
                'Yes. Living together',
                'Yes. Not living together',
            );

            return $values[array_rand($values)];
        },
    ),
    'Height' => array(
        'weight' => 10,
        'value' => function () {
            return rand(130, 200);
        },
    ),
    'Body Type' => array(
        'weight' => 50,
        'value' => function () {
            $values = array(
                'Athletic',
                'Average',
                'AL',
                'Heavy',
                'Slim',
            );

            return $values[array_rand($values)];
        },
    ),
    'Complexion' => array(
        'weight' => 250,
        'value' => function () {
            $values = array(
                'Dark',
                'Fair',
                'Very Fair',
                'Wheatish',
                'Wheatish Brown',
                'Wheatish Medium',
            );

            return $values[array_rand($values)];
        },
    ),
    'Religion' => array(
        'weight' => 1000,
        'value' => function () {
            $values = array(
                'Christian',
                'Hindu',
                'Muslim',
                'Other',
            );

            return $values[array_rand($values)];
        },
    ),
    'Mother Tongue' => array(
        'weight' => 50,
        'value' => function () {
            $values = array(
                'Bengal',
                'Bengali',
                'Englis',
                'English',
                'Other',
            );

            return $values[array_rand($values)];
        },
    ),
    'Family Value' => array(
        'weight' => 250,
        'value' => function () {
            $values = array(
                'Liberal',
                'Moderate',
                'Traditional',
            );

            return $values[array_rand($values)];
        },
    ),
    'Education' => array(
        'weight' => 250,
        'value' => function () {
            $values = array(
                'Bachelor',
                'Diploma',
                'Doctorate',
                'Graduate',
                'HSC',
                'Honours degree',
                'Masters',
                'Phd/Doctorate',
                'SSC',
                'Undergraduate',
            );

            return $values[array_rand($values)];
        },
    ),
    'Area' => array(
        'weight' => 250,
        'value' => function () {
            $values = array(
                'Administrative services',
                'Advertising/ Marketing',
                'Architecture',
                'Armed Forces',
                'Arts',
                'Commerce',
                'Computers/ IT',
                'Education',
                'Engineering/ Technology',
                'Fashion',
                'Finance',
                'Fine Arts',
                'Home Science',
                'Law',
                'Management',
                'Medicine',
                'No',
                'Nursing/ H',
                'Nursing/ Health Science',
                'Office administration',
                'Science',
                'Shipping',
                'Travel & Tourism',
            );

            return $values[array_rand($values)];
        },
    ),
    'Profession' => array(
        'weight' => 50,
        'value' => function () {
            $values = array(
                'Accountant',
                'Actor',
                'Administration Professional',
                'Advertising Professiona',
                'Advertising Professional',
                'Architect',
                'BCS Cadre',
                'Banker',
                'Beautician',
                'Business Person',
                'Chartered Accountant',
                'Civil Engineer',
                'Computer Professional',
                'Consultant',
                'Contractor',
                'Cost Accountant',
                'Customer Support Professional',
                'Defense E',
                'Defense Employee',
                'Dentist',
                'Designer',
                'Do',
                'Doctor',
                'Engineer',
                'Executive',
                'Fashion Designer',
                'Garment Employee',
                'Government Employee',
                'HR & Administration',
                'HR Administration',
                'Health Care Profes',
                'Health Care Professional',
                'Home Maker',
                'HotelResta',
                'HotelRestaurant Professional',
                'IT / Telecom Professional',
                'IT/Telecom profession',
                'Journalist',
                'Lecture',
                'Lecturer',
                'Legal Professional',
                'Manager',
                'Me',
                'Medical Professional',
                'Merchandiser',
                'No',
                'No Job',
                'Nurse',
                'Pharmacist',
                'Private Service',
                'Professor',
                'Scientist',
                'Self-employed Person',
                'Software Consultant',
                'Student',
                'Teacher',
                'Transportation Professional',
            );

            return $values[array_rand($values)];
        },
    ),
    'Diet' => array(
        'weight' => 10,
        'value' => function () {
            $values = array(
                'Eggetarian',
                'Non-Veg',
                'Occasionally Non-Veg',
                'Veg',
            );

            return $values[array_rand($values)];
        },
    ),
    'Smoke' => array(
        'weight' => 10,
        'value' => function () {
            $values = array(
                'AL',
                'No',
                'Occasionally',
            );

            return $values[array_rand($values)];
        },
    ),
    'Drink' => array(
        'weight' => 50,
        'value' => function () {
            $values = array(
                'No',
                'Occasionally',
                'AL',
            );

            return $values[array_rand($values)];
        },
    ),
    'Home Country' => array(
        'weight' => 50,
        'value' => function () {
            $values = array(
                'Australia',
                'Bahrain',
                'Bangladesh',
                'Belgium',
                'Bhut',
                'Bhutan',
                'Brazil',
                'Brunei',
                'Canada',
                'China',
                'Cyprus',
                'Czech Republic',
                'Denmark',
                'Egypt',
                'Finland',
                'France',
                'Germany',
                'Greece',
                'Hong Kong',
                'India',
                'Indonesia',
                'Ireland',
                'Italy',
                'Japan',
                'Jorda',
                'Jordan',
                'Kenya',
                'Kuwa',
                'Kuwait',
                'Macau',
                'Malaysia',
                'Maldives',
                'Mexico',
                'Morocco',
                'Nepal',
                'Netherlan',
                'Netherlands',
                'New Zeal',
                'New Zealand',
                'Nigeria',
                'Norway',
                'Oman',
                'Portugal',
                'Qatar',
                'Saudi Arabia',
                'Singapore',
                'South Africa',
                'Spain',
                'Swaziland',
                'Sweden',
                'Switzerland',
                'Thailand',
                'United Arab Emirates',
                'United Kingdom',
                'United States',
            );

            return $values[array_rand($values)];
        },
    ),
    'City' => array(
        'weight' => 0,
        'value' => function () {
            $values = array(
                'No',
            );

            return $values[array_rand($values)];
        },
    ),
    'Residency Status' => array(
        'weight' => 10,
        'value' => function () {
            $values = array(
                'Permanent Resident',
                'Work Permit',
            );

            return $values[array_rand($values)];
        },
    ),
);

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

    if (in_array("Doesn't Matter", $prefValues)) {
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
