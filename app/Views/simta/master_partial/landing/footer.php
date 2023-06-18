<footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url(../landing_assets/images/footer.jpg); background-attachment:fixed;">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-7">
            <div class="ftco-footer-widget mb-4">
              <h2><a class="navbar-brand" href="index.html"><img class="images" style="height: 30px;" src="<?=base_url('../landing_assets/images/logo-uns-biru.png')?>">&nbsp;D3 Teknik Informatika PSDKU <br><small>Universitas Sebelas Maret</small></a></h2>
              <p>Sistem Informasi Prodi D3 Teknik Informatika Madiun merupakan website yang dikembangkan oleh Civitas Akademika UNS. Pembuatan website ini memiliki tujuan untuk menyatukan beberapa sistem website yang berkaitan dengan Prodi D3 Teknik Informatika Kampus Madiun agar Civitas Akademika dapat dengan mudah melaksanakan kegiatan yang berkaitan dengan prodi.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-2">
             <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Site Links</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Home</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Courses</a></li>
                <li><a href="#" class="py-2 d-block">Students</a></li>
                <li><a href="#" class="py-2 d-block">Video</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Jl. Imam Bonjol, Sumbersoko, Pandean, Kec. Mejayan, Kabupaten Madiun, Jawa Timur 63153</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">035 1388296</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">d3ti.psdku.uns@uns.ac.id</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | D3 Teknik Informatika PSDKU</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>

  <script src="<?=base_url('../landing_assets/js/jquery.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery-migrate-3.0.1.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/popper.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.easing.1.3.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.waypoints.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.stellar.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/owl.carousel.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.magnific-popup.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/aos.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.animateNumber.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/bootstrap-datepicker.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/jquery.timepicker.min.js') ?>"></script>
  <script src="<?=base_url('../landing_assets/js/scrollax.min.js') ?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?=base_url('') ?>js/google-map.js"></script>
  <script src="<?=base_url('../landing_assets/js/main.js') ?>"></script>
  <script src="<?= base_url('../register.js') ?>"></script>
  <!-- Load PWA -->
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('<?= base_url('../serviceworker.js') ?>');
      });
    }
  </script>
  <script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(100, 0).slideUp(100, function(){
                $(this).remove();
            });
        }, 4000);
    });    
  </script>
  </body>
</html>
