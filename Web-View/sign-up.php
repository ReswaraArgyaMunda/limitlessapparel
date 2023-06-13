<?php
session_start();

// Koneksi ke database
require "../function/connect.php";

$id_user = "0";
$rand_char = "0123456789";

do {
    $id_user = "0"; // Reset nilai id_user sebelum loop
    for ($i = 0; $i < 6; $i++) {
        $id_user .= $rand_char[rand(0, strlen($rand_char) - 1)];
    }
    $sql = "SELECT id FROM users WHERE id = '$id_user'";
} while (($koneksi->query($sql))->num_rows >= 1);

$email_temp = "";
$err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['lname'] . $_POST['fname'];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $birth_date = $_POST["yyyy"] . $_POST["mm"] . $_POST["dd"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $err = "";

    $hashedPassword = md5($password);

    // Periksa apakah username atau email sudah terdaftar
    $checkSql = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $checkResult = $koneksi->query($checkSql);

    if ($checkResult->num_rows > 0) {
        $err = "Username atau Email telah terdaftar.";
    }

    // Masukkan data ke dalam tabel 'users'
    $insertSql = "INSERT INTO users VALUES ('$id_user', '$name', '$email', '$phone_number', '$birth_date', '$username', '$hashedPassword')";

    if ($koneksi->query($insertSql) === TRUE) {
        header("Location: login.php");
        exit;
    } else {
        $err .= $koneksi->error;
    }
}

$koneksi->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-image: url("../assets/image/login-bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            font-family: "Poppins", sans-serif;
        }

        #regForm {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            padding: 40px;
            background: rgba(223, 223, 223, 1);
            opacity: 95%;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        h2 {
            margin: 0 0 30px;
            padding: 0;
            color: black;
            text-align: center;
        }

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            border: 1px solid #aaaaaa;
        }

        /* Mark input boxes that get an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        .tab input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: black;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            background: transparent;
        }

        .tab label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: black;
            pointer-events: none;
            transition: 0.5s;
        }

        .tab input:focus ~ label,
        .tab input:valid ~ label {
            top: -20px;
            left: 0;
            color: black;
            font-size: 12px;
        }

        button {
            background: rgb(123, 122, 122);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.8;
        }

        #prevBtn {
            background: rgb(123, 122, 122);
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 10px;
            width: 10px;
            margin: 0 1px;
            background: rgb(123, 122, 122);
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        .login-alert {
            font-size: 13px;
            text-align: center;
            font-style: italic;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background: rgb(123, 122, 122);
        }
    </style>
</head>
<body>
<form id="regForm" method="POST" action="">
    <h2>Sign Up</h2>

    <!-- One "tab" for each step in the form: -->
    <div class="tab">
        <?php if ($err) { ?>
            <div class="login-alert">
                <p><?php echo $err ?></p>
            </div>
        <?php } ?>
        <p>
            <input
                placeholder="First name..."
                oninput="this.className = ''"
                name="fname"
            />
        </p>
        <p>
            <input
                placeholder="Last name..."
                oninput="this.className = ''"
                name="lname"
            />
        </p>
    </div>
    <div class="tab">
        <p>
            <input
                placeholder="E-mail..."
                oninput="this.className = ''"
                name="email"
            />
        </p>
        <p>
            <input
                placeholder="Phone..."
                oninput="this.className = ''"
                name="phone_number"
            />
        </p>
    </div>
    <div class="tab">
        <p>
            <input placeholder="dd" oninput="this.className = ''" name="dd" />
        </p>
        <p>
            <input placeholder="mm" oninput="this.className = ''" name="mm" />
        </p>
        <p>
            <input placeholder="yyyy" oninput="this.className = ''" name="yyyy" />
        </p>
    </div>
    <div class="tab">
        <p>
            <input
                placeholder="Username..."
                oninput="this.className = ''"
                name="username"
            />
        </p>
        <p>
            <input
                placeholder="Password..."
                oninput="this.className = ''"
                name="password"
                type="password"
            />
        </p>
    </div>
    <div style="overflow: auto">
        <div style="float: right">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">
                Previous
            </button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
    </div>
    <!-- Circles which indicate the steps of the form: -->
    <div style="text-align: center; margin-top: 40px">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == x.length - 1) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n);
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x,
            y,
            i,
            valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                alert("Input Form Tidak Boleh Kosong...");
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className +=
                " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i,
            x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }
</script>
</body>
</html>
