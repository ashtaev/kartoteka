<?php

function is_prime($num) {

    if(!is_numeric($num)) {
        throw new Exception('Не число');
    }

    if (function_exists('gmp_prob_prime')) {
        return gmp_prob_prime($num) === 2 ? 'да' : 'нет';
    }

    for($i=2; $i <= sqrt($num); $i++) {
        if($num % $i == 0) {
            return 'нет';
        }
    }
    return 'да';
}
