<?php

function addClearNames() {
    $action = $_POST['action'] ?? '';
    $nameInput = $_POST['name'] ?? '';
    $nameList = $_POST['namelist'] ?? '';
    
    if ($action === 'clear') {
        return "";
    }
    
    if ($action === 'add') {

        $nameParts = explode(" ", trim($nameInput));
        $firstName = ucfirst(strtolower($nameParts[0]));
        $lastName = ucfirst(strtolower($nameParts[1]));
        

        $formattedName = $lastName . ", " . $firstName;

        $namesArray = [];
        if (!empty($nameList)) {
            $namesArray = explode("\n\n", trim($nameList));
        }
      
        array_push($namesArray, $formattedName);

        sort($namesArray);

        $output = implode("\n\n", $namesArray);
        
        return $output;
    }
    
    return $nameList;
}

?>