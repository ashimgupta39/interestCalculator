<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PKF Finance Ltd</title>
  <!-- including jquery and bootstrap cdn for designing -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <style>
    .slidecontainer {
      width: 100%;
      /* Width of the outside container */
    }

    .slider {
      -webkit-appearance: none;
      width: 100%;
      height: 15px;
      border-radius: 5px;
      background: #d3d3d3;
      outline: none;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }

    .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #007bff;
      cursor: pointer;
    }

    .slider::-moz-range-thumb {
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background: #04AA6D;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <?php
  // Fetch all the rates here
  $pa = 5000;
  $rate = 6.25;
  $tenure = 1;

  //cumilative rates
  // regular
  $rate1 = 6.25;
  $rate2 = 6.35;
  $rate3 = 6.60;
  $rate4 = 6.70;
  $rate5 = 6.85;
  // senior citizen
  $srate1 = 6.50;
  $srate2 = 6.60;
  $srate3 = 6.85;
  $srate4 = 6.95;
  $srate5 = 7.10;
  // non-cumilative rates
  // quaterly
  // regular
  $rateq1 = 6.15;
  $rateq2 = 6.25;
  $rateq3 = 6.50;
  $rateq4 = 6.60;
  $rateq5 = 6.75;
  // senior citizen
  $srateq1 = 6.40;
  $srateq2 = 6.50;
  $srateq3 = 6.75;
  $srateq4 = 6.85;
  $srateq5 = 7.00;

  // monthly
  // regular
  $ratem1 = 6.05;
  $ratem2 = 6.15;
  $ratem3 = 6.40;
  $ratem4 = 6.50;
  $ratem5 = 6.65;
  // senior citizen
  $sratem1 = 6.30;
  $sratem2 = 6.40;
  $sratem3 = 6.65;
  $sratem4 = 6.75;
  $sratem5 = 6.90;

  $ratem = 6.05;
  $rateq = 6.15;
  $ratehy = 6.25;
  $ratey = 6.25;

  //Setting compounding frequency according to the tenure
  $cf = 0;
  if ($tenure > 1) {
    $cf = 2;
  } else {
    $cf = 1;
  }

  //applying formulaes
  //cumilative
  $a = (1 + (($rate / 100) / $cf));
  $b = pow($a, ($cf * $tenure));
  $ans = $pa * $b;
  $ip = $ans - $pa;

  //non-cumilative
  $ipm = $pa * $ratem / 1200;
  $ipq = $pa * $rateq / 400;
  $iphy = $pa * $ratehy / 2;
  $ipy = $pa * $ratey;

  //rendering html with calculated amounts
  echo "
        <div class='container'>
        <div class='row py-5'>
          <div class='col-3'></div>
          <div class='col-5'>
          <button type='button' id='regbtn' class='btn bg-primary text-light'>Regular Scheme</button>
          <button type='button' id='scbtn' class='btn bg-light text-dark'>Senior Citizen Scheme</button>
          </div>
          <div class='col-4'></div>
        </div>
        <div class='row'>
            <div class='col-6'>
            <br><br>
            <div class='slidecontainer'>
            <input type='range' min='5000' max='10000000' steps='1000' value='5000' class='slider' id='myRange'>
          </div>
          <div id='demo'></div>
            </div>
            <div class='col-6'>
            <div id='regular'>
            <table class='table table-bordered'>
              <thead class='bg-primary text-light'>
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
        <br><br><br>
        <div class='row'>
          <div class='col-6'>
          <br><br><br>
          <div class='slidecontainer'>
          <input type='range' min='12' max='60' value='12' steps='10' class='slider' id='myRange1'>
        </div>
        <div id='demo1'></div>
          </div>
          <div class='col-6'>
          <table class='table table-bordered'>
              <thead class='bg-primary text-light'>
              <tr>
                <th scope='col'>Period</th>
                <th scope='col'>Interest Rate</th>
                <th scope='col'>Interest Payout</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                    <td>Monthly</td>
                    <td id='ratemcell'>{$ratem}%</td>
                    <td id='ipmcell'>₹{$ipm}</td>
                </tr>
                <tr>
                    <td>Quaterly</td>
                    <td id='rateqcell'>{$rateq}%</td>
                    <td id='ipqcell'>₹{$ipq}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        </div>
        ";
  ?>
  <script>
    var slider = document.getElementById("myRange");
    var output = document.getElementById("demo");
    var slider1 = document.getElementById("myRange1");
    var output1 = document.getElementById("demo1");
    var ratecell = document.getElementById("ratecell");
    var interestpayoutcell = document.getElementById("interestpayoutcell")
    var macell = document.getElementById("macell")
    var ratemcell = document.getElementById("ratemcell")
    var ipmcell = document.getElementById("ipmcell")
    var rateqcell = document.getElementById("rateqcell")
    var ipqcell = document.getElementById("ipqcell")
    output1.innerHTML = slider1.value; // Display the default slider value
    output.innerHTML = slider.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Display the default slider value

    var scheme = 1;
    var rb = document.getElementById("regbtn")
    var sb = document.getElementById("scbtn")
    scbtn.onclick = function() {
      scheme = 2;
      sb.classList.remove('bg-light', 'text-dark')
      sb.classList.add('bg-primary', 'text-light')
      rb.classList.remove('bg-primary', 'text-light')
      rb.classList.add('bg-light', 'text-dark')
      hello();
    }
    regbtn.onclick = function() {
      scheme = 1;
      rb.classList.remove('bg-light', 'text-dark')
      rb.classList.add('bg-primary', 'text-light')
      sb.classList.remove('bg-primary', 'text-light')
      sb.classList.add('bg-light', 'text-dark')
      hello();
    }
    // Update the current slider value (each time you drag the slider handle)

    slider.oninput = function() {
      output.innerHTML = this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      var pa = this.value;
      var tenure = slider1.value;
      var rate = '<?= $ratehy ?>';
      var cf = 1;
      var srate = '<?= $ratehy ?>';
      if (tenure == 12) {
        cf = 2;
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure < 24 && tenure > 12) {
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rate = '<?= $rate2 ?>';
        srate = '<?= $srate2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rate = '<?= $rate3 ?>';
        srate = '<?= $srate3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rate = '<?= $rate4 ?>';
        srate = '<?= $srate4 ?>';
      } else if (tenure == 60) {
        rate = '<?= $rate5 ?>';
        srate = '<?= $srate5 ?>';
      }
      if (scheme == 1) {
        var a = (1 + ((rate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = rate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } else {
        var a = (1 + ((srate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = srate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      }


      var rateq = '<?= $rateq1 ?>';
      var ratem = '<?= $ratem1 ?>';
      var srateq = '<?= $ratem1 ?>';
      var sratem = '<?= $ratem1 ?>';

      if (tenure < 24 && tenure >= 12) {
        rateq = '<?= $rateq1 ?>';
        ratem = '<?= $ratem1 ?>';
        srateq = '<?= $srateq1 ?>';
        sratem = '<?= $sratem1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rateq = '<?= $rateq2 ?>';
        ratem = '<?= $ratem2 ?>';
        srateq = '<?= $srateq2 ?>';
        sratem = '<?= $sratem2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rateq = '<?= $rateq3 ?>';
        ratem = '<?= $ratem3 ?>';
        srateq = '<?= $srateq3 ?>';
        sratem = '<?= $sratem3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rateq = '<?= $rateq4 ?>';
        ratem = '<?= $ratem4 ?>';
        srateq = '<?= $srateq4 ?>';
        sratem = '<?= $sratem4 ?>';
      } else if (tenure == 60) {
        rateq = '<?= $rateq5 ?>';
        ratem = '<?= $ratem5 ?>';
        srateq = '<?= $srateq5 ?>';
        sratem = '<?= $sratem5 ?>';
      }
      if (scheme == 1) {
        var ansq = pa * rateq / 400;
        var ansm = pa * ratem / 1200;
        ratemcell.innerHTML = ratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = rateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } 
      else {
        var ansq = pa * srateq / 400;
        var ansm = pa * sratem / 1200;
        ratemcell.innerHTML = sratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = srateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      }

    }

    // Update the current slider value (each time you drag the slider handle)
    slider1.oninput = function() {
      output1.innerHTML = this.value;

      var pa = slider.value;
      var tenure = this.value;
      var rate = '<?= $ratehy ?>';
      var cf = 1;
      var srate = '<?= $ratehy ?>';
      if (tenure == 12) {
        cf = 2;
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure < 24 && tenure > 12) {
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rate = '<?= $rate2 ?>';
        srate = '<?= $srate2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rate = '<?= $rate3 ?>';
        srate = '<?= $srate3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rate = '<?= $rate4 ?>';
        srate = '<?= $srate4 ?>';
      } else if (tenure == 60) {
        rate = '<?= $rate5 ?>';
        srate = '<?= $srate5 ?>';
      }
      if (scheme == 1) {
        var a = (1 + ((rate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = rate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } else {
        var a = (1 + ((srate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = srate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      }


      var rateq = '<?= $rateq1 ?>';
      var ratem = '<?= $ratem1 ?>';
      var srateq = '<?= $ratem1 ?>';
      var sratem = '<?= $ratem1 ?>';

      if (tenure < 24 && tenure >= 12) {
        rateq = '<?= $rateq1 ?>';
        ratem = '<?= $ratem1 ?>';
        srateq = '<?= $srateq1 ?>';
        sratem = '<?= $sratem1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rateq = '<?= $rateq2 ?>';
        ratem = '<?= $ratem2 ?>';
        srateq = '<?= $srateq2 ?>';
        sratem = '<?= $sratem2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rateq = '<?= $rateq3 ?>';
        ratem = '<?= $ratem3 ?>';
        srateq = '<?= $srateq3 ?>';
        sratem = '<?= $sratem3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rateq = '<?= $rateq4 ?>';
        ratem = '<?= $ratem4 ?>';
        srateq = '<?= $srateq4 ?>';
        sratem = '<?= $sratem4 ?>';
      } else if (tenure == 60) {
        rateq = '<?= $rateq5 ?>';
        ratem = '<?= $ratem5 ?>';
        srateq = '<?= $srateq5 ?>';
        sratem = '<?= $sratem5 ?>';
      }
      if (scheme == 1) {
        var ansq = pa * rateq / 400;
        var ansm = pa * ratem / 1200;
        ratemcell.innerHTML = ratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = rateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } 
      else {
        var ansq = pa * srateq / 400;
        var ansm = pa * sratem / 1200;
        ratemcell.innerHTML = sratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = srateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      }
    }
    function hello(){
      var pa = slider.value;
      var tenure = slider1.value;
      var rate = '<?= $ratehy ?>';
      var cf = 1;
      var srate = '<?= $ratehy ?>';
      if (tenure == 12) {
        cf = 2;
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure < 24 && tenure > 12) {
        rate = '<?= $rate1 ?>';
        srate = '<?= $srate1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rate = '<?= $rate2 ?>';
        srate = '<?= $srate2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rate = '<?= $rate3 ?>';
        srate = '<?= $srate3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rate = '<?= $rate4 ?>';
        srate = '<?= $srate4 ?>';
      } else if (tenure == 60) {
        rate = '<?= $rate5 ?>';
        srate = '<?= $srate5 ?>';
      }
      if (scheme == 1) {
        var a = (1 + ((rate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = rate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } else {
        var a = (1 + ((srate / 100) / cf));
        var b = Math.pow(a, (cf * Math.floor(tenure / 12)));
        var ans = pa * b;
        var ip = ans - pa;
        ratecell.innerHTML = srate + '%';
        interestpayoutcell.innerHTML = '₹ ' + Math.round(ip).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        macell.innerHTML = '₹ ' + Math.round(ans).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      }


      var rateq = '<?= $rateq1 ?>';
      var ratem = '<?= $ratem1 ?>';
      var srateq = '<?= $ratem1 ?>';
      var sratem = '<?= $ratem1 ?>';

      if (tenure < 24 && tenure >= 12) {
        rateq = '<?= $rateq1 ?>';
        ratem = '<?= $ratem1 ?>';
        srateq = '<?= $srateq1 ?>';
        sratem = '<?= $sratem1 ?>';
      } else if (tenure >= 24 && tenure < 36) {
        rateq = '<?= $rateq2 ?>';
        ratem = '<?= $ratem2 ?>';
        srateq = '<?= $srateq2 ?>';
        sratem = '<?= $sratem2 ?>';
      } else if (tenure >= 36 && tenure < 48) {
        rateq = '<?= $rateq3 ?>';
        ratem = '<?= $ratem3 ?>';
        srateq = '<?= $srateq3 ?>';
        sratem = '<?= $sratem3 ?>';
      } else if (tenure >= 48 && tenure < 60) {
        rateq = '<?= $rateq4 ?>';
        ratem = '<?= $ratem4 ?>';
        srateq = '<?= $srateq4 ?>';
        sratem = '<?= $sratem4 ?>';
      } else if (tenure == 60) {
        rateq = '<?= $rateq5 ?>';
        ratem = '<?= $ratem5 ?>';
        srateq = '<?= $srateq5 ?>';
        sratem = '<?= $sratem5 ?>';
      }
      if (scheme == 1) {
        var ansq = pa * rateq / 400;
        var ansm = pa * ratem / 1200;
        ratemcell.innerHTML = ratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = rateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      } 
      else {
        var ansq = pa * srateq / 400;
        var ansm = pa * sratem / 1200;
        ratemcell.innerHTML = sratem + '%';
        ipmcell.innerHTML = '₹ ' + Math.round(ansm).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        rateqcell.innerHTML = srateq + '%';
        ipqcell.innerHTML = '₹ ' + Math.round(ansq).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    }}
  </script>
</body>

</html>