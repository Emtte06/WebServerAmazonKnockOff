<div class="header">

<div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- "More" Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">more</span>
    </button>

    <!-- Search Form -->
    <form class="form-inline my-2 my-lg-0 d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>
    <div class="collapse" id="navbarToggleExternalContent" data-bs-theme="dark">
  <div class="bg-dark p-4" style="background-color:>
  <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
      <div class="bg-body-tertiary border rounded-3">
        <br><br><br><br><br><br><br><br><br><br>
      </div>
      <div class="bg-body-tertiary border rounded-3">
        <br><br><br><br><br><br><br><br><br><br>
      </div>
    </div>
    <h5 class="text-body-emphasis h4">Collapsed content</h5>
    <span class="text-body-secondary">Toggleable via the navbar brand.</span>
  </div>
</div>

    
    
</div>
<div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use class="shadow" xlink:href="#gentle-wave" x="48" y="0" fill="rgba(7, 200, 31,0.7)" />
                <use class="shadow" xlink:href="#gentle-wave" x="48" y="3" fill="rgba(7, 200, 128,0.5)" />
                <use class="shadow" xlink:href="#gentle-wave" x="48" y="5" fill="rgba(79, 200, 7,0.3)" />
                <use class="shadow" xlink:href="#gentle-wave" x="48" y="7" fill="#07ad1c" />
            </g>
        </svg>
</div>

<style>

    
    .waves {
    transform: scaleY(-1);
    position: relative;
    width: 100%;
    height: 15vh;
    margin-bottom: -7px;
    min-height: 100px;
    max-height: 400px;
  }
  /* Animation */
  .parallax>use {
    animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
  }
  .parallax>use:nth-child(1) {
    animation-delay: -2s;
    animation-duration: 7s;
  }
  .parallax>use:nth-child(2) {
    animation-delay: -3s;
    animation-duration: 10s;
  }
  .parallax>use:nth-child(3) {
    animation-delay: -4s;
    animation-duration: 13s;
  }
  .parallax>use:nth-child(4) {
    animation-delay: -5s;
    animation-duration: 20s;
  }
  @keyframes move-forever {
    0% {
      transform: translate3d(-90px, 0, 0);
    }
    100% {
      transform: translate3d(85px, 0, 0);
    }
  }
  /*Shrinking for mobile*/
  @media (max-width: 768px) {
    .waves {
      height: 40px;
      min-height: 40px;
    }
    .content {
      height: 30vh;
    }
  }
</style>