<?php
require_once "../../../config.php";
require_once "../../../Classes/Dbh.php";
require_once "../Employer/AddJob/AddJobModel.php";
require_once "../Employer/AddJob/AddJobControl.php";
require_once "../auth_page.php";

requireRole("employer");
$username = $_SESSION["username"];
$account  = $_SESSION["account"];
$userId   = $_SESSION["userid"];


$employ = new AddJobControl("", "", 0, "", "", $userId);
$jobs = $employ->getJobs(); // assuming this returns an array of jobs





?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($account); ?> Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <!-- Navbar -->
  <nav class="bg-indigo-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <h1 class="text-xl font-semibold">Job Portal</h1>
      <div class="flex items-center space-x-4">
        <span class="text-sm">Welcome, <strong><?php echo htmlspecialchars(strtoupper($username)); ?></strong></span>
        <a href="../../../logout.php" class="text-sm bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-white shadow py-8">
    <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
      <div>
        <h2 class="text-2xl font-bold">Your Employer Dashboard</h2>
        <p class="text-gray-600">Manage your job postings below</p>
      </div>
      <a href="addJob.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow">
        + Create New Job
      </a>
      <a href="showApplicants.php"
        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow">View Applicants</a>
    </div>
  </header>

  <!-- Main Section -->
  <main class="flex-grow max-w-6xl mx-auto px-4 py-10">

    <!-- Jobs the employer created -->
    <section>
      <h3 class="text-xl font-semibold mb-6">Jobs You’ve Created</h3>
      <?php if (empty($jobs)) : ?>
      <p class="text-gray-600">You haven’t created any jobs yet. Click the “Create New Job” button above to start.</p>
      <?php else : ?>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($jobs as $job) : ?>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
          <h4 class="text-lg font-semibold mb-2 text-indigo-700">
            <?php echo htmlspecialchars($job['title']); ?>
          </h4>

          <p class="text-sm text-gray-600 mb-2">
            <span class="font-semibold">Location:</span> <?php echo htmlspecialchars($job['location']); ?>
          </p>

          <p class="text-sm text-gray-600 mb-2">
            <span class="font-semibold">Applicants:</span> <?php echo htmlspecialchars($job['applicants']); ?>
          </p>

          <p class="text-gray-700 text-sm mb-4 ">
            <?php echo nl2br(htmlspecialchars($job['description'])); ?>
          </p>

          <div>
            <span class="text-gray-500 text-sm">
              <span class="font-semibold">Salary:</span> ₦<?php echo number_format($job['salary'], 2); ?>
            </span>


          </div>
          <!-- form div -->
          <div class="flex justify-between gap-2 items-center">
            <!-- update form -->
            <form action="updateJob.php ?>" method="post">
              <input type="hidden" name="job_id" value="<?php echo $job["id"]; ?>">
              <button type="submit" class="text-yellow-600 text-sm hover:text-red-800 font-semibold transition">
                Update
              </button>
            </form>
            <!-- delete form -->
            <form action="delete_job.php" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
              <input type="hidden" name="job_id" value="<?php echo $job["id"]; ?>">
              <button type="submit" class="text-red-600 text-sm hover:text-red-800 font-semibold transition">
                Delete
              </button>
            </form>
          </div>
          <p class="text-xs text-gray-400 mt-3">
            Posted on <?php echo date("M d, Y", strtotime($job['created_at'])); ?>
          </p>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>

    <!-- the applications the employer receives -->

  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mt-10">
    <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
      &copy; <?php echo date("Y"); ?> Job Portal. All rights reserved.
    </div>


  </footer>

</body>

</html>