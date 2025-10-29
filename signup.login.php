<?php 
require_once "./config.php";
require_once './Classes/Signup/SignupView.php';
$error = new SignupView()
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up / Login | JobLink</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="images/Black_and_white_minimalist_jewelry_logo-removebg-preview2.png">


  <title>Job listing Application</title>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-white shadow-sm ">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-6">
      <img src="images/Black_and_white_minimalist_jewelry_logo-removebg-preview.png" class="w-[100px] h-[100px]" alt="">
      <a href="./index.php" class="text-blue-600 hover:underline">← Back to Home</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col items-center justify-center py-10">
    <h2 class="text-3xl font-semibold text-gray-800 mb-8">Join or Login to Continue</h2>

    <div class="grid md:grid-cols-2 gap-10 max-w-4xl w-full px-6">

      <!-- Sign Up -->
      <section class="bg-white shadow-md rounded-lg p-8 border border-gray-100">

        <h3 class="text-xl font-semibold text-gray-800 mb-6">New Here? Sign Up</h3>
        <p>
          <?php
          $error->showError()
          ?>
        </p>
        <form action="./includes/signupnew.php" method="post" class="space-y-5">

          <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" id="username" name="username"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
          </div>

          <div>
            <label for="pwd" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="pwd" name="pwd"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
          </div>

          <div>
            <label for="account" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="account" id="account"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
              <option value="employer">Employer</option>
              <option value="job_seeker">Job Seeker</option>
            </select>
          </div>

          <button type="submit" name="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
            Sign Up
          </button>
        </form>
      </section>

      <!-- Login -->
      <section class="bg-white shadow-md rounded-lg p-8 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-6">Already Have an Account? Login</h3>
        <form action="includes/loginNew.php" method="post" class="space-y-5">

          <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" id="username" name="username"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="pwd" name="pwd"
              class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
          </div>

          <button type="submit" name="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
            Login
          </button>
        </form>
      </section>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 text-center py-6 mt-auto">
    <p>&copy; <?php echo date('Y'); ?> JobLink. All Rights Reserved.</p>
  </footer>

</body>

</html>