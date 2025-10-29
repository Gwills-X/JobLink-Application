<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Apply for Job</title>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-10">

  <!-- Container -->
  <div
    class="bg-white shadow-xl rounded-2xl w-full max-w-lg sm:max-w-2xl md:max-w-3xl p-6 sm:p-8 lg:p-10 transition-all">

    <!-- Header -->
    <header class="text-center mb-6">
      <h1 class="text-2xl sm:text-3xl font-bold text-indigo-700 mb-2">Apply for Job</h1>
      <p class="text-gray-600 text-sm sm:text-base">Submit your cover letter to apply for this position</p>
    </header>

    <!-- Job Info Card -->
    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 sm:p-6 mb-6 text-center sm:text-left">
      <h2 class="text-lg sm:text-xl font-semibold text-indigo-800">
        <?php echo $_SERVER["REQUEST_METHOD"]==="POST" ? htmlspecialchars($_POST['job_title']) : 'N/A'; ?>
      </h2>
      <p class="text-sm text-gray-600 mt-2">
        <span class="font-medium">Job ID:</span>
        <?php echo $_SERVER["REQUEST_METHOD"]==="POST" ? htmlspecialchars($_POST['job_id']) : 'N/A'; ?>
      </p>
    </div>

    <!-- Application Form -->
    <form action="./applyForJob.php" method="post" class="space-y-6">
      <!-- Hidden Inputs -->
      <input type="hidden" name="job_id"
        value="<?php echo $_SERVER["REQUEST_METHOD"]==="POST" ? htmlspecialchars($_POST['job_id']) : ''; ?>">
      <input type="hidden" name="employer_id"
        value="<?php echo $_SERVER["REQUEST_METHOD"]==="POST" ? htmlspecialchars($_POST['employer_id']) : ''; ?>">
      <input type="hidden" name="job_title"
        value="<?php echo $_SERVER["REQUEST_METHOD"]==="POST" ? htmlspecialchars($_POST['job_title']) : ''; ?>">

      <!-- Cover Letter -->
      <div>
        <label for="cover_letter" class="block text-sm font-semibold text-gray-700 mb-2">
          Cover Letter
        </label>
        <textarea id="cover_letter" name="cover_letter" rows="6" placeholder="Write your cover letter here..."
          class="w-full border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 rounded-lg px-4 py-3 resize-none shadow-sm text-sm sm:text-base"></textarea>
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" name="submit"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200 ease-in-out text-sm sm:text-base">
          Submit Application
        </button>
      </div>
    </form>

    <!-- Back Link -->
    <div class="text-center mt-6">
      <a href="dashboard.php"
        class="inline-block text-indigo-600 hover:text-indigo-800 text-sm sm:text-base font-medium transition">
        ← Back to Dashboard
      </a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="mt-10 text-center text-xs sm:text-sm text-gray-500">
    &copy; <?php echo date("Y"); ?> Job Portal. All rights reserved.
  </footer>

</body>

</html>