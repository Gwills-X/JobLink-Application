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
$applicants= $employ->getAllApplicants()
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
      <a href="dashboard.php"
        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow">
        go back to Dashboard
      </a>

    </div>
  </header>

  <main>
    <section>
      <h3 class="text-xl font-semibold my-6">Applications Received</h3>
      <?php if (empty($applicants)) : ?>
      <p class="text-gray-600">You haven’t received any applicant yet.</p>
      <?php else : ?>
      <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($applicants as $applicant) : ?>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
          <h4 class="text-lg font-semibold mb-2 text-indigo-700">
            <?php echo htmlspecialchars($applicant['job_title']); ?>
          </h4>

          <p class="text-sm text-gray-600 mb-2">
            <span class="font-semibold">Name of the Applicant:</span>
            <?php echo htmlspecialchars($applicant['applicant_name']); ?>
          </p>

          <p class="text-sm text-gray-600 mb-2">
            <span class="font-semibold">Applicants Email:</span>
            <?php echo htmlspecialchars($applicant['applicant_email']); ?>
          </p>

          <p class="text-gray-700 text-sm mb-4 wordwrap ">Cover Letter:
            <?php echo nl2br(htmlspecialchars($applicant['cover_letter'])); ?>
          </p>

          <div>
            <span class="text-gray-500 text-sm">
              <span class="font-semibold">Applied when:</span>
              <?php echo htmlspecialchars($applicant['applied_at']); ?>
            </span>


          </div>
          <!-- form div -->
          <div class="flex justify-between gap-2 items-center self-end mt-4">
            <!-- update form -->
            <form action="accept.php ?>" method="post">
              <input type="hidden" name="applicant_id" value="<?php echo $applicant["application_id"]; ?>">
              <button type="submit" class="text-yellow-600 text-sm hover:text-red-800 font-semibold transition">
                Accept
              </button>
            </form>
            <!-- delete form -->
            <form action="reject.php" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
              <input type="hidden" name="applicant_id" value="<?php echo $applicant["application_id"]; ?>">
              <button type="submit" class="text-red-600 text-sm hover:text-red-800 font-semibold transition">
                Reject
              </button>
            </form>
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