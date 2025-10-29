<?php
require_once "../../../config.php";
require_once "../auth_page.php";
requireRole("job_seeker");

$username = $_SESSION["username"] ?? "Guest";
$account  = $_SESSION["account"] ?? "job_seeker";
$applicantId = intval($_SESSION["userid"] ?? 0);

require_once "../../../Classes/Dbh.php";
require_once "../JobSeeker/AddApplication/AddAppModel.php";
require_once "../JobSeeker/AddApplication/AddAppControl.php";

$jobsAvailable = new AddAppControl(0, 0, $applicantId, "");
// Fetch all available jobs the user is yet to apply for
$result = $jobsAvailable->sendAllJobs();

// Fetch jobs the user has applied for
$appliedJobs = $jobsAvailable->sendAppliedJobs();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo ucfirst($account) ?> Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <!-- Navbar -->
  <nav class="bg-indigo-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <h1 class="text-xl font-semibold">Job Portal</h1>
      <div class="flex items-center space-x-4">
        <span class="text-sm">Welcome, <strong><?php echo htmlspecialchars($username); ?></strong></span>
        <a href="../../../logout.php"
          class="text-sm bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded transition">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-white shadow-md py-8">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-2xl font-bold mb-1">Your Dashboard</h2>
      <p class="text-gray-600">Account Type: <span
          class="font-semibold capitalize"><?php echo htmlspecialchars($account); ?></span></p>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow max-w-6xl mx-auto px-4 py-10">

    <!-- available Jobs -->
    <section>
      <h3 class="text-xl font-semibold mb-6">Jobs You are yet to apply for</h3>
      <?php if (empty($result)) : ?>
      <p class="text-gray-600">No jobs available at the moment. Check back later.</p>
      <?php else : ?>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($result as $job) : ?>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition duration-300">
          <h4 class="text-lg font-semibold mb-2 text-indigo-700">
            <?php echo htmlspecialchars($job['title']); ?>
          </h4>

          <p class="text-sm text-gray-600 mb-1">
            <span class="font-semibold">Location:</span> <?php echo htmlspecialchars($job['location']); ?>
          </p>
          <p class="text-sm text-gray-600 mb-1">
            <span class="font-semibold">Applicants:</span> <?php echo htmlspecialchars($job['applicants']); ?>
          </p>
          <p class="text-sm text-gray-600 mb-4">
            <span class="font-semibold">Salary:</span> ₦<?php echo number_format($job['salary'], 2); ?>
          </p>

          <p class="text-gray-700 text-sm mb-4 line-clamp-3">
            <?php echo nl2br(htmlspecialchars($job['description'])); ?>
          </p>

          <div class="flex justify-between items-center mt-4">
            <p class="text-xs text-gray-400">
              Posted on <?php echo date("M d, Y", strtotime($job['created_at'])); ?>
            </p>

            <!-- APPLY FORM -->
            <form action="../JobSeeker/applyJob.php" method="POST">
              <input type="hidden" name="job_id" value="<?php echo $job["id"]; ?>">
              <input type="hidden" name="employer_id" value="<?php echo $job["employer_id"]; ?>">
              <input type="hidden" name="job_title" value="<?php echo htmlspecialchars($job["title"]); ?>">
              <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                Apply
              </button>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>

    <!-- job You have applied for  -->
    <section>
      <h3 class="text-xl font-semibold my-6">Jobs You have applied for</h3>
      <?php if (empty($appliedJobs)) : ?>
      <p class="text-gray-600">You have not applied for any Job, Please do apply.</p>
      <?php else : ?>
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($appliedJobs as $job) : ?>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition duration-300">
          <h4 class="text-lg font-semibold mb-2 text-indigo-700">
            <?php echo htmlspecialchars($job['title']); ?>
          </h4>

          <p class="text-sm text-gray-600 mb-1">
            <span class="font-semibold">Location:</span> <?php echo htmlspecialchars($job['location']); ?>
          </p>

          <p class="text-sm text-gray-600 mb-4">
            <span class="font-semibold">Salary:</span> ₦<?php echo number_format($job['salary'], 2); ?>
          </p>

          <p class="text-gray-700 text-sm mb-4 line-clamp-3">
            <?php echo nl2br(htmlspecialchars($job['description'])); ?>
          </p>

          <div class="flex justify-between items-center mt-4">


            <!-- Status -->
            <p><?php echo $job["status"]; ?></p>

          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t mt-10">
    <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
      &copy; <?php echo date("Y"); ?> Job Portal. All rights reserved.
    </div>
  </footer>

</body>

</html>