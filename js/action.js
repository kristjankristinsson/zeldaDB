const gameDataApiUrl = "http://localhost/magenta/API/game_database.json";

const get_user_api_url = "http://localhost/magenta/API/users.json";

// Användare login

const form_target_div = document.getElementById("login_form");
form_target_div.addEventListener("submit", (e) => {
  e.preventDefault();

  // target och user value input
  const username_div = document.getElementById("username");
  const username = username_div.value;

  // target och pass input
  const pwd_div = document.getElementById("password");
  const pwd = pwd_div.value;

  if (username == "" || username == null) {
    document.getElementById("error_username").innerHTML =
      "Email fields are required";
  } else if (pwd == "" || pwd == null) {
    document.getElementById("error_pwd").innerHTML =
      "Password fields are required";
  } else {
    // skapa json data
    const send_data = {
      username: username,
      pwd: pwd,
    };

    jsonData = JSON.stringify(send_data);

    // login kontroll
    fetch("./php_files/login_con.php", {
      method: "POST",
      body: jsonData,
      headers: {
        "Content-type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "true") {
          document.getElementById("login_error").innerHTML = "";
          document.getElementById("login_success").innerHTML = "Log In Success";
          setInterval(() => {
            window.location = "mainPage/";
          }, 1000);
        } else if (data.status === "error") {
          document.getElementById("login_success").innerHTML = "";
          document.getElementById("login_error").innerHTML = "Database Error";
        } else if (data.status === "false") {
          document.getElementById("login_success").innerHTML = "";
          document.getElementById("login_error").innerHTML =
            "Email Or PassWord is wrong. Please Try again!";
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }
});
