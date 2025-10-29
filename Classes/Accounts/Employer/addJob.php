<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add a Job | Employer Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col justify-center items-center py-12 px-4">

  <!-- Card Container -->
  <section class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-3xl border border-gray-100">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-8">Add a New Job</h1>

    <form action="../Employer/addNewJob.php" method="post" class="space-y-6">

      <!-- Title -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
        <input type="text" id="title" name="title" placeholder="e.g. Frontend Developer"
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
      </div>

      <!-- Location -->
      <div>
        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
        <input type="text" id="location" name="location" placeholder="e.g. Remote or Lagos, Nigeria"
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
      </div>

      <!-- Applicants -->
      <div>
        <label for="applicants" class="block text-sm font-medium text-gray-700 mb-2">Expected Number of
          Applicants</label>
        <input type="number" id="applicants" name="applicants" min="1" placeholder="e.g. 10"
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
      </div>

      <!-- Description -->
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description</label>
        <textarea id="description" name="description" rows="6"
          placeholder="Describe the role, skills required, and responsibilities..."
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3 resize-none"></textarea>
      </div>

      <!-- Salary -->
      <div>
        <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary (₦)</label>
        <input type="number" id="salary" name="salary" placeholder="e.g. 350000"
          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-4 py-2">
      </div>

      <!-- Submit Button -->
      <div class="pt-4">
        <button type="submit" name="submit"
          class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200 ease-in-out">
          Add Job
        </button>
      </div>
    </form>
  </section>

  <!-- Optional Footer -->
  <footer class="mt-10 text-gray-500 text-sm">
    &copy; <?php echo date("Y"); ?> Job Portal. All rights reserved.
  </footer>

</body>

</html>