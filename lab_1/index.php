<?php
// Part 1
echo "Hello, World!"; 
echo "<br>";

// Part 2
$stringVar = "Hello"; 
$intVar = 123; 
$floatVar = 12.34; 
$boolVar = true; 

echo $stringVar, "<br>";
echo $intVar, "<br>";
echo $floatVar, "<br>";
echo $boolVar, "<br>";

var_dump($stringVar);
echo "<br>";
var_dump($intVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($boolVar);
echo "<br>";

// Part 3
$firstName = "Hello";
$lastName = "World!";

$fullName = $firstName . " " . $lastName;

echo $fullName;
echo "<br>";

// Part 4
$number = 10;

if ($number % 2 == 0) {
    echo "$number - Even number.<br>";
} else {
    echo "$number - Odd number.<br>";
}

$number = 3;

if ($number % 2 == 0) {
    echo "$number - Even number.<br>";
} else {
    echo "$number - Odd number.<br>";
}

// Part 5
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br>";

// Part 6
$student = [
    "name" => "Zhemerenko",
    "surname" => "Andrii",
    "age" => 19,
    "specialty" => "122 - Computer Science"
];

echo "Surname: " . $student['surname'] . "<br>";
echo "Name: " . $student['name'] . "<br>";
echo "Age: " . $student['age'] . "<br>";
echo "Specialty: " . $student['specialty'] . "<br>";

$student['gpa'] = 91.38;

var_dump($student);
