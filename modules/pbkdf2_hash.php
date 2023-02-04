<?php

/**
 * Hashing function with xxh32, xxh128 and then sha256-PBKDF2
 * @param string $pswd
 * @param string $user
 * @return string Hash output
 */
function pbkdf2(String $pswd, String $user) {
    $hashedPSWD = hash("xxh128",hash("xxh32", $pswd)); // SHA-512 Cryptographic hash, hashed by RipeMD320

    $iterations = 500000;
    $salt = "asdald".$user[0]."kjsfsdfsdfu".$user[2]."bsfiubsfisfUE".$user[3]."FVACBATVBALBVA123".$user[2]."254234BUDYF".$user[5]."OSADF;L'F#]FAFDFSFAS".$user."FSS";

    $hash = hash_pbkdf2("sha256", $hashedPSWD, $salt, $iterations, 18); // PBKDF2 Hashing

    return $hash;
}

?>