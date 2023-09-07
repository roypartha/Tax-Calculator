<!DOCTYPE html>

<head>
  <a href="index.php">Home </a><br>
  <h3>USER</h3>
</head>

<body>
  <button name="btnsignin" id='btnsignin'>Sign In</button>
  <button name="btnregister" id='btnregister'>Register</button>

  <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
    <input type="text" id='username' name="username" hidden placeholder="Username">
    <input type="text" id='password' name="password" hidden placeholder="Password">
  </form>

  <button name="btnuserlogin" id='btnuserlogin' hidden>Login</button>
  <button name="btnuserreg" id='btnuserreg' hidden>Sign Up</button>
  <br>
  <input type="text" id='usernamelogin' name="usernamelogin" hidden readonly>
  <button name="btncalculator" id='btncalculator' hidden>Tax Calculator</button>
  <button name="btnhistory" id='btnhistory' hidden>History</button>

  <table id="tablehistory" border="1" style="width: max-content;" hidden>
    <thead>
      <tr>
        <th>Sl</th>
        <th>Salary</th>
        <th>S Ex</th>
        <th>S Tax</th>
        <th>Houserent</th>
        <th>H Ex</th>
        <th>H Tax</th>
        <th>Medical</th>
        <th>M Ex</th>
        <th>M Tax</th>
        <th>Conveyance</th>
        <th>C Ex</th>
        <th>C Tax</th>
        <th>Incentive</th>
        <th>I Ex</th>
        <th>I Tax</th>
        <th>Bonus</th>
        <th>B Ex</th>
        <th>B Tax</th>
        <th>Total Income</th>
        <th>Total Taxable</th>
        <th>GROSS TAX</th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>
  <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
    <select id="category_select" hidden>
      <option value="General">General</option>
      <option value="Female/Senior Citizen">Female/Senior Citizen</option>
      <option value="Disabled">Disabled</option>
      <option value="Gazetted Freedom Fighters">Gazetted Freedom Fighters</option>
    </select>
    <input type="text" id='basic_salary' name="basic_salary" placeholder="Basic Salary" hidden>
    <input type="text" id='houserent' name="houserent" placeholder="House Rent" hidden>
    <input type="text" id='medical' name="medical" placeholder="Medical Allowance" hidden>
    <input type="text" id='conveyance' name="conveyance" placeholder="Conveyance" hidden>
    <input type="text" id='commision' name="commision" placeholder="Incentive/OT" hidden>
    <input type="text" id='bonus' name="bonus" placeholder="Festival Bonus" hidden>
  </form>
  <br>
  <button name="btncalculate" id='btncalculate' hidden>Calculate</button>
  <table id="tablecalculate" border="1" style="width: max-content;" hidden>
    <thead>
      <tr>
        <th>Total Income</th>
        <th>Total Taxable</th>
        <th>GROSS TAX</th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>
</body>

<script src="jquery3.6.0.js"></script>
<script>
  var uname = '';
  var hash = '';
  $(document).ready(function() {
    $('#btnsignin').click(function() {
      toggleView(["username", "password", 'btnuserlogin'], "block")
      toggleView(['btnsignin', "btnregister", "btnuserreg"], "none")
    })
  })
  $(document).ready(function() {
    $('#btnregister').click(function() {
      toggleView(["username", "password", 'btnuserreg'], "block")
      toggleView(['btnsignin', 'btnregister', 'btnuserlogin'], "none")
    })
  })
  $(document).ready(function() {
    $('#btnuserlogin').click(function() {
      var username = document.getElementById('username').value;
      uname = username;
      var password = document.getElementById('password').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/public/login-user`;

      hash = btoa(username + ':' + password) // `Basic ${hash}`
      //console.log(hash);
      $.ajax({
        url: apiUrl,
        type: "GET",
        headers: {
          'Authorization': `Basic ${hash}`
        },
        data: {},
        dataType: 'text',

        success: function(result) {
          toggleView(["usernamelogin", "btncalculator", "btnhistory"], "block")
          toggleView(['btnsignin', "username", "password", "btnregister", "btnuserlogin"], "none")
          document.getElementById('usernamelogin').value = result;

          console.log(result)
        },
        error: function(err) {
          //console.log(redirect("index.php"))

          console.log("err-", err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btnuserreg').click(function() {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/register/user`;

      $.ajax({
        url: apiUrl,
        type: "POST",
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          "username": username,
          "password": password,
          "authorities": [{
            "id": "1"
          }],
          "enabled": true
        }),
        dataType: "json",

        success: function(result) {
          redirect("index.php?userreg=created");
        },
        error: function(err) {
          console.log('err-', err);

          console.log(err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btncalculator').click(function() {
      toggleView(["basic_salary", "houserent", "medical", "conveyance", "commision", "bonus", "category_select","btncalculate", "btnhistory"], "block")
      toggleView(["btncalculator", "tablehistory", "tablecalculate"], "none")
    })
  })
  $(document).ready(function() {
    $('#btnhistory').click(function() {
      toggleView(["btncalculator", "tablehistory"], "block")
      toggleView(["basic_salary", "houserent", "medical", "conveyance", "commision", "bonus", "btncalculate", "tablecalculate", "btnhistory"], "none")

      var apiUrl = 'http://localhost:8081/spring_webmvc_war_exploded/tax/history'

      $.ajax({
        url: apiUrl,
        type: "GET",
        headers: {
          'Authorization': `Basic ${hash}`
        },
        data: {},
        dataType: 'json',
        success: function(data) {
          $("#tablehistory tbody").empty()

          for (var i = 0; i < data.length; i++) {
            var temp = '<tr><td>' + (i + 1) + '</td>';
            temp += '<td>' + data[i].basic_salary + '</td>';
            temp += '<td>' + data[i].basic_salary_exemption + '</td>';
            temp += '<td>' + data[i].basic_salary_taxable + '</td>';
            temp += '<td>' + data[i].houserent + '</td>';
            temp += '<td>' + data[i].houserent_exemption + '</td>';
            temp += '<td>' + data[i].houserent_taxable + '</td>';
            temp += '<td>' + data[i].medical + '</td>';
            temp += '<td>' + data[i].medical_exemption + '</td>';
            temp += '<td>' + data[i].medical_taxable + '</td>';
            temp += '<td>' + data[i].conveyance + '</td>';
            temp += '<td>' + data[i].conveyance_exemption + '</td>';
            temp += '<td>' + data[i].conveyance_taxable + '</td>';
            temp += '<td>' + data[i].commission + '</td>';
            temp += '<td>' + data[i].commission_exemption + '</td>';
            temp += '<td>' + data[i].commission_taxable + '</td>';
            temp += '<td>' + data[i].bonus + '</td>';
            temp += '<td>' + data[i].bonus_exemption + '</td>';
            temp += '<td>' + data[i].bonus_taxable + '</td>';
            temp += '<td>' + data[i].totalIncome + '</td>';
            temp += '<td>' + data[i].totalTaxable + '</td>';
            temp += '<td>' + data[i].grossTax + '</td></tr>';
            $('#tablehistory tbody').append(temp);
          }
          console.log(data)
        },
        error: function(err) {
          //console.log(redirect("index.php"))

          console.log("err-", err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btncalculate').click(function() {
      toggleView(["tablecalculate"], "block")

      var category_select = document.getElementById('category_select').value || 'General';
      var basic_salary = document.getElementById('basic_salary').value || 0;
      var houserent = document.getElementById('houserent').value || 0;
      var medical = document.getElementById('medical').value || 0;
      var conveyance = document.getElementById('conveyance').value || 0;
      var commision = document.getElementById('commision').value || 0;
      var bonus = document.getElementById('bonus').value || 0;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/tax/calculate`;

      $.ajax({
        url: apiUrl,
        type: "POST",
        headers: {
          'Authorization': `Basic ${hash}`,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          "category": category_select,
          "basic_salary": basic_salary,
          "houserent": houserent,
          "medical": medical,
          "conveyance": conveyance,
          "commission": commision,
          "bonus": bonus
        }),
        dataType: "json",

        success: function(result) {
          $("#tablecalculate tbody").empty()
          var temp = '<tr><td>' + result.totalIncome + '</td>';
          temp += '<td>' + result.totalTaxable + '</td>';
          temp += '<td>' + result.grossTax + '</td></tr>';
          $('#tablecalculate tbody').append(temp);
          console.log(result)
        },
        error: function(err) {
          console.log(err.responseText);
        }
      })
    })
  })

  function toggleView(x, state) {
    x.forEach(element => {
      var y = document.getElementById(element);
      if (y.style.display != state)
        y.style.display = state;
    });
  }

  function redirect(url) {
    window.location.assign(url);
  }
</script>

</html>