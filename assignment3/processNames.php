<?php
// Process names from a source

function processNames($names) {
    $processedNames = [];
    foreach ($names as $name) {
        $processedNames[] = trim($name);
    }
    return $processedNames;
}

// Example usage
$names = [" Alice ", " Bob ", " Charlie "];
$cleanedNames = processNames($names);
print_r($cleanedNames);
?>