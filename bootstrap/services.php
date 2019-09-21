<?php

/**
 * @param mixed ...$vars
 * @return string
 */
function generateHashId(...$vars) {
    return md5(join('', $vars));
}

/**
 * @param $array
 * @param $paramName
 * @return array
 */
function mergeArrayItemsByParam($array, $paramName)
{
    $params = [];
    foreach ($array as $item) {
        foreach ($item[$paramName] as $key => $param) {
            $params[$key] = $param;
        }
    }

    return $params;
}

/**
 * Walk through $array and insert each $kk => $vv in its sub arrays
 *
 * @param $array
 * @param $keysValues
 * @param null $subKey
 * @return mixed
 */
function insertKeysValuesInEachArraySubArray($array, $keysValues, $subKey = null) {
    foreach ($array as &$v) {
        if (is_array($v)) {
            foreach ($keysValues as $kk => $vv) {
                if (!$subKey) {
                    $v[$kk] = $vv;
                } else {
                    $v[$subKey][$kk] = $vv;
                }
            }
        }
    }

    return $array;
}

/**
 * Check whether $value is presented in at least one of $array's $keys
 *
 * @param $value
 * @param $array
 * @param $keys
 * @return bool
 */
function isValuePresentedInKeys($value, $array, $keys) {
    foreach ($keys as $key) {
        if (str_contains($array[$key], $value)) {
            return true;
        }
    }

    return false;
}

/**
 * @param array $array
 * @return int|null|string
 */
function getFirstNullValuesKey(array $array) {
    foreach ($array as $key => $item) {
        if (is_null($item)) {
            return $key;
        }
    }

    return null;
}

/**
 * @param \App\Http\Controllers\Controller $controller
 * @param $function
 * @return string
 * @throws ReflectionException
 */
function getApiSourceNameAlias(\App\Http\Controllers\Controller $controller, string $function): string {
    $classShortName = str_replace('Controller', '', (new \ReflectionClass($controller))->getShortName());

    return snake_case($classShortName . '_' .  $function);
}

/**
 * @param $need
 * @param $word
 * @return bool
 */
function soundsSimilar($need, $word) {
    return
        $need == $word ||
        soundex($need) == soundex($word) ||
        levenshtein($need, $word) <= 3;
}

/*-- QParam seeds - helpers --*/
/**
 * @param $word
 * @return string
 */
function underscoreToSentence($word) {
    return ucfirst(strtolower(str_replace('_', ' ', $word)));
}

/**
 * @param $tt
 * @return string
 */
function buildTitleForParam($tt) {
    return 'What is your ' . lcfirst($tt) . ' ?';
}

/**
 * @param $text
 * @return bool
 */
function isNotOriginal($text) {
    return strpos($text, 'original') === false;
}
/*-- /QParam seeds - helpers --*/


/**
 * Get array from csv file
 *
 * @param $inputName
 * @return array|\Illuminate\Support\Collection
 */
function csvFromInputFileToArray($inputName)
{
    $data = collect();

    if ($file = request()->file($inputName)) {
        foreach (\League\Csv\Reader::createFromFileObject($file->openFile()) as $index => $row) {
            $data[] = $row;
        }
    }

    return $data;
}

function rand_color() {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

function rand_color_unique($uniqueId) {
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

function is_connected_to_internet()
{
    $connection = @fsockopen("www.example.com", 80);

    if ($connection) {
        fclose($connection);

        return true;
    }

    return false;

}
