<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKF Finance Ltd</title>
    <!-- including jquery and bootstrap cdn for designing -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
  integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
  crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
  integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  </head>
</head>
<body>

    <?php
      // Fetch all the rates here
        $pa = 10000;
        $rate = 6.95;
        $tenure = 3;

        $ratem=6.05;
        $rateq=6.15;
        $ratehy=6.25;
        $ratey=6.25;

        //Setting compounding frequency according to the tenure
        $cf=0;
        if($tenure > 1){
            $cf=2;
        }
        else{
            $cf=1;
        }

        //applying formulaes
        $a = (1+(($rate/100)/$cf));
        $b = pow($a,($cf*$tenure));
        $ans = $pa*$b;
        $ip=$ans-$pa;

        //rendering html with calculated amounts
        echo "
        <div class='container'>
        <div class='row py-5'></div>
        <div class='row'>
            <div class='col-6'>

            </div>
            <div class='col-6'>
            <div id='regular'>
            <table class='table'>
              <thead>
              <tr>
                <th scope='col'>Interest Rate</th>
                <th scope='col'>Interest Payout</th>
                <th scope='col'>Maturity Amount</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                    <td id='ratecell'>{$rate}%</td>
                    <td id='interestpayoutcell'>₹{$ip}</td>
                    <td id='macell'>₹{$ans}</td>
                </tr>
              </tbody>
            </table>
        </div>
            </div> 
        </div>
        </div>
        ";
    ?>
</body>
</html>