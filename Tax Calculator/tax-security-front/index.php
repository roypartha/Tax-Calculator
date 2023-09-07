<!DOCTYPE html>
<!-- <script src="./exchangeRate.js"></script> -->

<head>
  <h3>Salary Tax Calculator</h3>
</head>

<body>
  <a href="admin1.php"> Admin </a> &nbsp;
  <a href="user1.php"> User </a> &nbsp;
  <!-- <button name="btntest" id='btntest'>Calculate</button>

  <p id="newUser"> -->
    <!-- 
  <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
    <label for="username">Username:</label>
    <input type="text" id='username' name="username" autofocus>
    <br>
  
    <label for="password">Password:</label>
    <input type="text" id='password' name="password">
    <br>

    <button name="login" id='login'>Login</button>
  </form>
  <br>
  <p id="result"></p> -->
</body>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#btntest').click(function() {
      $.ajax({
        url: 'http://localhost:8081/spring_webmvc_war_exploded/register/test',
        type: "GET",
        headers: {
          'Authorization': `Basic ${btoa('user1:12345')}`
        },
        data: {},
        dataType: 'text',

        success: function(result) {
          console.log(result)
        },
        error: function(err) {
          console.log("err-", err.responseText);
        }
      })
    })
  })
</script> -->
<!--  <script>
  $(document).ready(function() {
    $('#login').click(function() {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/public/login-success`;

      var hash = btoa(username + ':' + password) // `Basic ${hash}`
      console.log(hash)
      /* 
      var settings = {
      //   "url": "http://localhost:8081/spring_webmvc_war_exploded/public/username",
      //   "method": "GET",
      //   "timeout": 0,
      //   "headers": {
      //     "Authorization": `Basic ${hash}`,
      //   },
      // };

      // $.ajax(settings).done(function(response) {
      //   console.log(response);
      // });

      // Post Tax Calculate
      // var settings = {
      //   "url": "http://localhost:8081/spring_webmvc_war_exploded/tax/calculate",
      //   "method": "POST",
      //   "timeout": 0,
      //   "headers": {
      //     "Authorization": `Basic ${hash}`,
      //     "Content-Type": "application/json"
      //   },
      //   "data": JSON.stringify({
      //     "category": "General",
      //     "name": "user1",
      //     "basic_salary": 2000000,
      //     "houserent": 2000,
      //     "medical": 2000,
      //     "conveyance": 1000,
      //     "commission": 2000,
      //     "bonus": 2000
      //   }),
      // };

      // $.ajax(settings).done(function(response) {
      //   console.log(response);
      // });
      */

      $.ajax({
        url: apiUrl,
        headers: {
          "Authorization": `Basic ${hash}`,
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        type: "GET",
        /* or type:"PUT" */
        dataType: "json",
        data: {},
        success: function(result) {
          console.log(result)
          // var rate = result.rate
          // if (rate == 0) {
          //   document.getElementById('result').innerHTML = `Invalid ${fromCurrency} to ${toCurrency} conversion!`;
          //   return;
          // }

          // var amount = document.getElementById('amount').value;
          // var converted = amount * rate;
          // document.getElementById('result').innerHTML = converted;
        },
        error: function(err) {
          console.log(err.responseText);
        }
      })
    })
  })
</script>  -->

</html>