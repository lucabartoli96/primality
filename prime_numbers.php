<?php

function is_prime($n) {
    
    if ($n < 0) {
        $n = -$n;
    }

    if ($n == 0 or $n == 1 or 
        $n % 2 == 0 or $n % 3 == 0) {
        return false;
    } else {
        
        for($i = 5; $i * $i < $n; $i += 6) {
            if ($n % $i == 0 or $n % ($i + 2) == 0) {
                return false;
            }
        }
    }
    return true;
}


function dividers($n) {
    
    if ($n < 0) {
        $n = -$n;
    }

    if ($n == 0) {
        return null;
    } else if ($n == 1) {
        return array(-1, 1);
    } else if ($n == 2 or $n == 3) {
        return array(-$n,-1, 1, $n);
    } else {
        $dividers_list = array(-1, 1);
        for($i = 2; $i <= $n /2; $i++) {
            if ($n % $i == 0) {
                array_unshift($dividers_list, -$i);
                array_push($dividers_list, $i);
            }
        }
        array_unshift($dividers_list, -$n);
        array_push($dividers_list, $n);
    }
    
    return $dividers_list;
}


function sieve_of_erastothenes($n) {
     
    if ($n == 0) {
        return array();
    } else if ($n < 0) {
        $n = -$n;
    }

    $a = array_fill(2, $n - 1, 1);

    for ( $i = 2; $i <= ceil(sqrt($n)); $i++) {
        for( $j=$i*$i; $j <= $n; $j += $i ) {
            $a[$j] = 0;
        }
    }

    $prime = array();

    for($i = 2; $i <= $n; $i++) {
        if ( $a[$i] ) {
            array_push($prime, $i);
        }
    }

   return $prime;
}


function factorize($n) {
    
    if ($n < 0) {
        $n = -$n;
    }

    $fact = array();
    
    if($n == 1 or $n == 0 or is_prime($n)) {
        
        $fact[$n] = 1;
        
    } else {
        
        $prime = sieve_of_erastothenes($n);
        
        for($i = 0; $n > 1 and $i < count($prime) ; $i++) {

            $p = $prime[$i];

            while( $n > 1 and $n % $p == 0 ) {
                if (array_key_exists($p, $fact)) {
                    $fact[$p]++;
                } else {
                    $fact[$p] = 1;
                }
                $n /= $p;
            }
        }
    }
    return $fact;
}

function sieve_of_erastothenes_html($n, $glue) {
    return implode($glue, sieve_of_erastothenes($n));
}

function dividers_html($n, $glue) {
    return implode($glue, dividers($n));
}

function factorize_html($n) {
    
    $fact = factorize($n);
    $fact_string = "";

    foreach ( $fact as $p => $e ) {
        $fact_string .= "$p";
        if ( $e > 1 ) {
            $fact_string .= "<sup>$e</sup>";
        }
        if ( $p !=  max(array_keys($fact)) ) {
            $fact_string .= " * ";
        }
    }
    
    return $fact_string;
}


?>