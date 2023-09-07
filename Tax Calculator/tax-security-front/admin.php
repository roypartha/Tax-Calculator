<!DOCTYPE html>

<head>
  <a href="index.php">Home </a><br>
  <h3>ADMIN</h3>
</head>

<body>
  <button name="btnsignin" id='btnsignin'>Sign In</button>
  <button name="btnregister" id='btnregister'>Register</button>

  <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
    <input type="text" id='username' name="username" hidden placeholder="Username">
    <input type="text" id='password' name="password" hidden placeholder="Password">
  </form>
  <button name="btnadminlogin" id='btnadminlogin' hidden>Login</button>
  <button name="btnadminreg" id='btnadminreg' hidden>Sign Up</button>
  <br>
  <input type="text" id='usernamelogin' name="usernamelogin" hidden readonly>
  <button name="btnusers" id='btnusers' hidden>Users</button>
  <table id="tableusers" border="1" style="width: max-content;" hidden>
    <thead>
      <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th>Enabled</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>
  <form id="formuser" action="" method="post" enctype="multipart/form-data" onsubmit="return false" hidden>
    <br>Userinfo:<br>
    ID : <input type="text" id='suserid' name="suserid" readonly><br>
    Username: <input type="text" id='susername' name="susername"><br>
    Password: <input type="text" id='spassword' name="spassword"><br>
    Role : <input type="text" id='srole' name="srole"><br>
    Enabled : <input type="text" id='senabled' name="senabled"><br>
    <button name="btnadduser" id='btnadduser'>Add</button>
    <button name="btnedituser" id='btnedituser'>Update</button>
    <button name="btndeleteuser" id='btndeleteuser'>Delete</button>
    <p id="userresult">
  </form>

</body>

<script src="jquery3.6.0.js"></script>

<script>
  var uname = '';
  var hash = '';
  $(document).ready(function() {
    $('#btnsignin').click(function() {
      toggleView(["username", "password", 'btnadminlogin'], "block")
      toggleView(['btnsignin', "btnregister", "btnadminreg"], "none")
    })
  })
  $(document).ready(function() {
    $('#btnregister').click(function() {
      toggleView(["username", "password", 'btnadminreg'], "block")
      toggleView(['btnsignin', 'btnregister', 'btnadminlogin'], "none")
    })
  })
  $(document).ready(function() {
    $('#btnadminlogin').click(function() {
      var username = document.getElementById('username').value;
      uname = username;
      var password = document.getElementById('password').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/public/login-admin`;

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
          toggleView(["usernamelogin", "btnusers"], "block")
          toggleView(["username", "password", "btnadminlogin"], "none")
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
    $('#btnadminreg').click(function() {
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/register/admin`;

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
            "id": "2"
          }],
          "enabled": true
        }),
        dataType: "json",

        success: function(result) {
          redirect("index.php?adminreg=created");
        },
        error: function(err) {
          console.log(err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btnusers').click(function() {
      toggleView(["tableusers", ], "block")
      toggleView(['btnusers', 'formuser'], "none")

      var apiUrl = 'http://localhost:8081/spring_webmvc_war_exploded/admin/get-all-users';
      $.ajax({
        url: apiUrl,
        type: "GET",
        headers: {
          'Authorization': `Basic ${hash}`
        },
        data: {},
        dataType: 'json',

        success: function(result) {
          $("#tableusers tbody").empty()

          for (var i = 0; i < result.length; i++) {
            var temp = '<tr><td>' + result[i].id + '</td>';
            temp += '<td>' + result[i].username + '</td>';
            temp += '<td>' + result[i].password + '</td>';
            temp += '<td>' + result[i].authorities.map(a => a.name.split('_')[1]).join(', ') + '</td>';
            temp += '<td>' + result[i].enabled + '</td>';
            temp += '<td><button class="btnSelect">Select</button></td></tr>';
            $('#tableusers tbody').append(temp);
          }
          console.log(result)
        },
        error: function(err) {
          console.log("err-", err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    // code to read selected table row cell data (values).
    $("#tableusers").on('click', '.btnSelect', function() {
      toggleView(["formuser"], "block")

      // get the current row
      var currentRow = $(this).closest("tr");

      var id = currentRow.find("td:eq(0)").text();
      var username = currentRow.find("td:eq(1)").text();
      var password = currentRow.find("td:eq(2)").text();
      var authorityId = currentRow.find("td:eq(3)").text().split(', ')[0];
      //authorityId = (authorityId == 'USER' ? 1 : 2);
      var enabled = currentRow.find("td:eq(4)").text() // == 'true' ? true : false;

      document.getElementById('suserid').value = id;
      document.getElementById('susername').value = username;
      document.getElementById('spassword').value = password;
      document.getElementById('srole').value = authorityId;
      document.getElementById('senabled').value = enabled;

      //var data = col1 + "\n" + col2 + "\n" + col3;
      //alert(data);
    });
  });
  $(document).ready(function() {
    $('#btnadduser').click(function() {
      //toggleView(["tableusers", ], "block")
      //toggleView(['btnusers', 'formuser'], "none")
      var username = document.getElementById('susername').value;
      var password = document.getElementById('spassword').value;
      var authorityId = document.getElementById('srole').value.toLowerCase() == 'user' ? 1 : 2;
      var apiUrl = 'http://localhost:8081/spring_webmvc_war_exploded/admin/add-user';
      $.ajax({
        url: apiUrl,
        type: "POST",
        headers: {
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          "username": username,
          "password": password,
          "authorities": [{
            "id": authorityId
          }],
          "enabled": true
        }),
        dataType: "text",

        success: function(result) {
          document.getElementById('userresult').innerHTML = result;
          console.log(result)
        },
        error: function(err) {
          console.log(err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btnedituser').click(function() {
      //toggleView(["tableusers", ], "block")
      //toggleView(['btnusers', 'formuser'], "none")
      var userid = document.getElementById('suserid').value;
      var username = document.getElementById('susername').value;
      var password = document.getElementById('spassword').value;
      var authorityId = document.getElementById('srole').value.toLowerCase() == 'admin' ? 2 : 1;
      var enabled = document.getElementById('senabled').value == 'false' ? false : true;
      var apiUrl = 'http://localhost:8081/spring_webmvc_war_exploded/admin/update-user';
      $.ajax({
        url: apiUrl,
        type: "PUT",
        headers: {
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          "id": userid * 1,
          "username": username,
          "password": password,
          "authorities": [{
            "id": authorityId
          }],
          "enabled": enabled
        }),
        dataType: "text",

        success: function(result) {
          document.getElementById('userresult').innerHTML = result;
          console.log(result)
        },
        error: function(err) {
          document.getElementById('userresult').innerHTML = err.responseText;
          console.log(err.responseText);
        }
      })
    })
  })
  $(document).ready(function() {
    $('#btndeleteuser').click(function() {
      //toggleView(["tableusers", ], "block")
      //toggleView(['btnusers', 'formuser'], "none")
      var userId = document.getElementById('suserid').value;
      var apiUrl = `http://localhost:8081/spring_webmvc_war_exploded/admin/delete-user/${userId}`;
      $.ajax({
        url: apiUrl,
        type: "DELETE",
        headers: {
          'Content-Type': 'application/json'
        },
        data: {},
        dataType: "text",

        success: function(result) {
          document.getElementById('userresult').innerHTML = result;
          console.log(result)
        },
        error: function(err) {
          document.getElementById('userresult').innerHTML = err.responseText;
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