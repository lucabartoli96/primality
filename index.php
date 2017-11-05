<!DOCTYPE html>
<?php include "prime_numbers.php" ?>
<html>
  <head>
    <link type="text/css" rel="stylesheet" href="main.css"/>
    <script type="text/javascript" src="main.js" data-number="<?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          echo $_POST["number"];
        }
    ?>">
    </script>
  </head>
  <body>
  <form method="post">
   <input type="number" name="number"/>
   <input type="submit" name="test" value=""/>
  </form>
    <ul>
    <?php
    
      function add($l1, $l2) {
          echo "<li>\n".
                $l1.
                "</li>\n".
                "<li>\n".
                $l2.
                "</li>\n";
      }
        
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $number = $_POST["number"];
        
          if ($number == null) {
            $number = 0;
          }
          
          $number = intval($number);
        
          if (is_prime($number)) {
              
              add(
                "Primality",
                "$number is prime"
              );
              
          } else {
           
              add(
                "Primality",
                "$number is not prime"
              );
           
                if ($number < -1 or $number > 1) {
                    add(
                        "Dividers",
                        "<div id='dividers' class='number_group'>\n".
                        "<span>" . 
                        dividers_html($number, "</span>,\n <span>") . 
                        "</span>\n" .
                        "</div>"
                    );
                }
          }
          
          if ( abs($number) < 870000 ) {
              
                add(
                  "Factorization of ". abs($number),
                  "<p id='factorization'>". factorize_html($number) ." </p>"
                );
          
          
                if (abs($number) > 1 and abs($number) <= 870000) {
                    add(
                        "Prime numbers between 2 and ". abs($number),
                        "<div  class='number_group'>\n".
                        "<span>" . 
                        sieve_of_erastothenes_html($number, "</span>,\n <span>") . 
                        "</span>\n".
                        "</div>"
                    );
                }
              
          }
          
      }

    ?>
      </ul>
  </body>
</html>
