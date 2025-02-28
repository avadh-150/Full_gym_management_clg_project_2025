<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="row mb-1">
      <div class="col-md-4 mb-5">
        <br>
        <h3>About us</h3>
        <!-- <br> -->
        <p class="mb-5">our team of experienced trainers and staff are here to guide and support you every step of the way. join us today and bbecome a part of our fitness family!</p>
        <ul class="list-unstyled footer-link d-flex footer-social">
          <li><a href="https://x.com/" class="p-2"><span class="fa fa-twitter"></span></a></li>
          <li><a href="https://www.facebook.com/facebook/" class="p-2"><span class="fa fa-facebook"></span></a></li>
          <li><a href="https://www.linkedin.com/" class="p-2"><span class="fa fa-linkedin"></span></a></li>
          <li><a href="https://www.instagram.com/" class="p-2"><span class="fa fa-instagram"></span></a></li>
        </ul>

      </div>
      <div class="col-md-5 mb-5">
        <br>
        <h3>Contact Info</h3>
        <!-- <br> -->
        <ul class="list-unstyled footer-link">
          <li class="d-block">
            <span class="d-block">Address:</span>
            <span class="text-white">02-second floor,
              shyamdham chock, surat</span>
          </li>
          <li class="d-block"><span class="d-block">Telephone:</span><span class="text-white">+91 7567992211</span></li>
          <li class="d-block"><span class="d-block">Email:</span><span class="text-white">khushianghan@gmail.com</span></li>
        </ul>
      </div>
      <div class="col-md-3 mb-5">
        <br>
        <h3>Quick Links</h3>
        <!-- <br> -->
        <ul class="list-unstyled footer-link">
          <li><a href="about.php">About</a></li>
          <li><a href="#">Terms of Use</a></li>
          <li><a href="#">Disclaimers</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3">

      </div>
    </div>
    <div class="row">
      <div class="col-10 text-md-center text-left">
        <br>
        <br>
        <p>created by :- Gymme</p><br>
        </p>
      </div>
    </div>
  </div>
</footer>

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
  </svg></div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
<script>

  alertify.set('notifier', 'position', 'top-right');
  <?php
 
  if (isset($_SESSION['message'])) 
  {
  ?>
  alertify.set('notifier', 'position', 'top-right');


    alertify.success('<?= $_SESSION['message'] ?>');
  <?php
  unset($_SESSION['message']);
  } ?>
</script>

<script src="js/costom.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>

<script src="js/main.js"></script>