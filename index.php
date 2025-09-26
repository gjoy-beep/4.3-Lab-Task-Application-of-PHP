<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome - Student CRUD App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #ffdee9, #b5fffc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      overflow-x: hidden;
    }

    /* Animated ribbons */
    .ribbon {
      position: absolute;
      width: 200%;
      height: 200px;
      background: rgba(255, 255, 255, 0.2);
      transform: rotate(-5deg);
      left: -50%;
      animation: moveRibbon 12s linear infinite;
    }
    .ribbon:nth-child(2) {
      top: 30%;
      background: rgba(255, 182, 193, 0.3);
      animation-duration: 18s;
    }
    .ribbon:nth-child(3) {
      top: 60%;
      background: rgba(173, 216, 230, 0.3);
      animation-duration: 22s;
    }
    .ribbon:nth-child(4) {
      top: 80%;
      background: rgba(221, 160, 221, 0.3);
      animation-duration: 16s;
    }

    @keyframes moveRibbon {
      from { transform: translateX(-50%) rotate(-5deg); }
      to   { transform: translateX(50%) rotate(-5deg); }
    }

    .card {
      background: #fff;
      color: #333;
      border-radius: 1rem;
      box-shadow: 0 6px 25px rgba(0,0,0,0.15);
      padding: 3rem 2rem;
      z-index: 2;
      position: relative;
    }

    .btn-lg {
      border-radius: 30px;
      padding: 0.75rem 2rem;
      font-size: 1.2rem;
    }

    /* Pink button style */
    .btn-pink {
      background-color: #ff4da6;
      border: none;
      color: white;
    }
    .btn-pink:hover {
      background-color: #e60073;
      color: white;
    }
  </style>
</head>
<body>

  <!-- Cute ribbons -->
  <div class="ribbon"></div>
  <div class="ribbon"></div>
  <div class="ribbon"></div>
  <div class="ribbon"></div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card">
          <h1 class="mb-4">🎓 Student Records</h1>
          <p class="mb-4">Add, view, edit, and delete records with ease.</p>
          <div class="d-flex justify-content-center gap-3">
            <a href="select.php" class="btn btn-pink btn-lg">📖 Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
