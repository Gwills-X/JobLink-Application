<?php
require_once "./Classes/Dbh.php";
require_once "./Classes/Signup/SignupModel.php";
require_once "./Classes/Signup/SignupControl.php";

$signupControl = new SignupControl("", "", "", "");
$jobs = $signupControl->showAllJobs();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>

  <title>Job listing Application</title>
</head>

<body class="bg-gray-50 text-gray-800">
  <!-- Header -->
  <header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-3xl font-bold text-indigo-700">JobLink</h1>
      <a href="./signup.login.php"
        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Sign Up / Login</a>
    </div>
  </header>

  <main>
    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
      <h2 class="text-4xl font-bold mb-4">Find or Post Jobs Easily</h2>
      <p class="text-lg mb-8">Whether you're a freelancer looking for your next gig or an employer looking to hire,
        we've got you covered.</p>
      <a href="./signup.login.php"
        class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Get
        Started</a>
    </section>

    <!-- Available Jobs -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">🔥 Latest Job Openings</h2>
      <h3 class="text-xl font-bold text-center text-gray-800 mb-10">Signup To Apply</h3>

      <?php if (!empty($jobs)): ?>
      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($jobs as $job): ?>
        <div
          class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition p-6 flex flex-col justify-between border border-gray-100">
          <div>
            <h3 class="text-xl font-semibold text-indigo-700 mb-2">
              <?php echo htmlspecialchars($job['title']); ?>
            </h3>
            <p class="text-gray-600 text-sm mb-3">
              <?php echo htmlspecialchars(substr($job['description'], 0, 100)); ?>...
            </p>

            <div class="flex items-center justify-between text-sm text-gray-500">
              <span class="font-medium">
                <i class="fa-solid fa-location-dot mr-1"></i>
                <?php echo htmlspecialchars($job['location']); ?>
              </span>
              <span class="font-semibold text-green-600">
                $<?php echo number_format($job['salary'], 2); ?>
              </span>
            </div>
          </div>

          <div class="pt-5 mt-4 border-t border-gray-100 flex justify-between items-center">
            <span class="text-sm text-gray-400">
              Posted on <?php echo date('M d, Y', strtotime($job['created_at'])); ?>
            </span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php else: ?>
      <p class="text-center text-gray-500 text-lg">No jobs available at the moment. Check back later.</p>
      <?php endif; ?>
    </section>

    <!-- About Section -->
    <section class="bg-white py-20 border-t border-gray-200">
      <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/3076/3076822.png" alt="About JobLink"
          class="w-72 mx-auto md:w-96">
        <div>
          <h3 class="text-3xl font-bold text-gray-800 mb-4">About JobLink</h3>
          <p class="text-gray-600 mb-4">
            JobLink is an innovative online platform that bridges the gap between employers and job seekers. We make it
            simple for companies to find qualified talent and for applicants to discover exciting opportunities that
            match their skills.
          </p>
          <p class="text-gray-600 mb-4">
            Our mission is to empower individuals and businesses through easy access to career growth and recruitment
            tools. Whether you're looking for your dream job or searching for the right candidate, JobLink brings
            everything you need to one place.
          </p>
          <p class="text-gray-600">
            Join thousands of professionals already growing their careers and businesses with JobLink today.
          </p>
        </div>
      </div>
    </section>

    <!-- How It Works -->
    <section class="max-w-6xl mx-auto py-16 px-6 grid md:grid-cols-2 gap-10 items-center">
      <div class="flex flex-col justify-center">
        <h3 class="text-2xl font-bold mb-4 text-gray-800">How It Works</h3>
        <p class="text-gray-600 mb-4">
          Employers can create job listings, specify roles, and review applications.
          Freelancers can browse job posts and apply with ease. Everything happens in one platform.
        </p>
        <a href="./signup.login.php" class="text-indigo-600 font-medium hover:underline">Join now to get started →</a>
      </div>
      <img src="https://cdn-icons-png.flaticon.com/512/944/944992.png" alt="Jobs Illustration"
        class="w-72 mx-auto md:w-96">
    </section>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 text-center py-6 mt-10">
    <p>&copy; <?php echo date('Y'); ?> JobLink. All Rights Reserved.</p>
  </footer>
</body>

</html>