<?php

/*
 * Weights
 * =======
 *
 * 0 - Irrelevant
 * 1 - Minor importance
 * 10 - Somewhat important
 * 50 - Important
 * 250 - Very important
 * 1000 - Very Very important
 * 5000 - Extremely important
 */

return array(
    'Age between' => array(
        'weight' => 1000,
        'value' => function () {
            return rand(18, 60);
        },
    ),
    'Marital Status' => array(
        'weight' => 1000,
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
    'Height' => array(
        'weight' => 1000,
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
        'weight' => 5000,
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
    'Education' => array(
        'weight' => 1000,
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
    'Profession' => array(
        'weight' => 250,
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
    'Home Country' => array(
        'weight' => 10,
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
);
