<?php 
/**
 * Template Name: Tentang
 */

global $updirs;

get_header(); ?>

<section class="content-block">
  <div class="container no-pad-t">
    <div class="product-tabs">

      <ul class="nav nav-tabs nav-tabs-line-bottom line-bcolor nav-tabs-center case-u" role="tablist">
        <li class="active"><a href="#tab-latest" data-toggle="tab">logo resmi jogja</a></li>
        <li><a href="#tab-featured" data-toggle="tab">konsep &amp; makna logo</a></li>
        <li><a href="#tab-trending" data-toggle="tab">arti &amp; makna tagline</a></li>
      </ul>
      <!-- /Nav Tabs -->

      <div class="tab-content tab-no-borders">
        <div class="tab-pane active" id="tab-latest">
        
          <div class="row">
          
            <div class="col-sm-12 text-center">
              <?php $hs = new WP_Query( array(
                'post_type'   => 'page',
                'post_status' => 'publish',
                'pagename'    => 'slideshow-tentang',
              ) ); 

              if( $hs->have_posts() ) : ?>
              <?php while( $hs->have_posts() ) : $hs->the_post(); 

              // get attached images via imwp
              $gallerys = imwp_get_gallery( array(
                'image_size' => 'original',
                ) ); 

              // start looping if images found
              if( $gallerys ): ?>

              <div id="homepage-carousel" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php for($i=0; $i<count($gallerys); $i++): ?>
                  <li data-target="#homepage-carousel" data-slide-to="<?php echo $i; ?>"></li>
                  <?php endfor; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                <?php foreach( $gallerys as $t => $gallery ): ?>
                <div class="item <?php echo $t==0 ? 'active' : ''; ?>">
                <?php printf( '<img src="%s" alt="%s" title="%s" width="%d" height="%d" />', 
                          $gallery['sizes']['original']['fileurl'], 
                          $gallery['title'], 
                          $gallery['title'], 
                          $gallery['sizes']['original']['width'], 
                          $gallery['sizes']['original']['height'] 
                          ); ?>
                </div><!-- .item-->
                <?php endforeach; ?>
                </div><!-- .carousel-inner-->

                <!-- Controls -->
                <a class="left carousel-control" href="#homepage-carousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#homepage-carousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div><!-- .carousel slide -->

              <?php endif; ?>

              <?php endwhile; wp_reset_postdata(); ?>
              <?php endif; ?>
            </div><!-- /Col -->
          
          </div><!-- .row -->
        
        </div><!-- #tab-latest -->
        
        <div class="tab-pane" id="tab-featured">

          <div class="row">
            <div class="col-sm-8 col-sm-push-2 text-center">
              
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-tanpa-Istimewa.jpg">

              <p>Logo Jogja ini menggunakan huruf kecil, yang melambangkan egaliterisme, 
              kesederajatan dan persaudaraan. Dengan warna merah bata, sebagai warna perlambang 
              keraton dan spirit keberanian untuK mewarnai zaman baru (masa depan) berbekal 
              akar budaya masa lalu yang diperkaya kearifan lokal yang genuine.</p>
            </div>
          </div><!-- .row -->

          <hr>

          <div class="row">
            <div class="col-sm-2 text-center">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-dan-Aksara-Jawa.jpg">
            </div>

            <div class="col-sm-4 text-center">
              <p>Untuk mewakili kekuatan akar budaya
              masyarakat Yogyakarta, logo
              menggunakan jenis font original yang
              didesain berdasarkan Aksara Jawa.</p>
              <p>
              Dengan font modern, simple dan dinamis,
              namun tetap berpijak pada ruh tradisi dan
              kebudayaan Yogyakarta. Bentuk logo yang
              simple, modern, progresif ini juga merupakan
              manifestasi semangat Youth,
              Women, Netizen.</p>
            </div>

            <div class="col-sm-2 text-center">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Jogja-Istimewa-Huruf-G.jpg">
            </div>

            <div class="col-sm-4 text-center">
              <p>Tekad “9 Renaisance” yang menjadi cita-cita arah
              pembangunan Yogyakarta, tercermin dalam angka “9” pada
              huruf “g”. “9 Renaisance” tersebut dimanefestasikan dalam
              slogan gerakan “Jogja Gumregah” dalam bidang
              1. Pendidikan, 2. Pariwisata, 3. Teknologi, 4. Ekonomi,
              5. Energi, 6. Pangan, 7. Kesehatan, 8. Keterlindungan Warga,
              9. Tata Ruang dan Lingkungan. </p>
              <p>Dimana untuk mencapai tekad “Jogja Gumregah” tersebut,
              “Kebudayaan” akan selalu menjadi “Payung” dan “Arus Utama”
              dalam mencapai kemajuan.</p>
            </div>
          </div><!-- .row -->

          <hr>

          <div class="row">
            
            <div class="col-sm-8 col-sm-push-2 text-center">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-Biji-Daun-Ceruk.jpg">

              <p>Titik dalam “J” dalam bentuk “Biji” dan “Daun”, juga lubang pada
              huruf “G”, melambangkan filosofi “Cokro Manggilingan; Wiji
              Wutuh, Wutah Pecah, Pecah Tuwuh, Dadi Wiji”, yang akan menjadi
              pedoman untuk pembangunan yang “lestari” dan “selaras dengan
              alam” untuk lingkungan hidup yang lebih baik.</p>
            </div>
          </div><!-- .row -->

          <hr>

          <div class="row">
            
            <div class="col-sm-8 col-sm-push-2 text-center">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-GJ-Merah.jpg">

              <p>Huruf “G” dan “J” yang saling memangku dan bersinggungan
              melambangkan semangat “Hamemayu Hayuning Bhawana” yang
              menjadi pedoman bagi setiap pemimpin dan pengampu kebijakan
              untuk selalu “bercermin di kalbu rakyat” agar bisa menjadikan
              dirinya sebagai “pelayan rakyat sejati” untuk mewujudkan
              pembangunan yang “memanusiakan manusia” nya.</p>
            </div>
          </div><!-- .row -->

          <hr>

          <div class="row">

            <div class="col-sm-2">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Kraton-Yogyakarta.jpg">
            </div>
            
            <div class="col-sm-4 ">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-tanpa-Istimewa.jpg">            

              <p>Warna merah (M: 100, Y: 100, K: 10) yang digunakan sebagai
              warna resmi logo ini adalah warna yang berasal dari
              Lambang Keraton. Merah, simbol keberanian, ketegasan,
              kebulatan tekad yang utuh untuk .
              Warna merah di atas putih ini juga menggambarkan Jogja
              yang selalu menyimpan ruh ke-Indonesia-an yang berdiri
              kokoh di atas sejarah panjang kebudayaan unggul
              Nusantara.</p>
            </div>

          </div><!-- .row -->

          <hr>

          <div class="row">
            <div class="col-sm-6 col-sm-push-6">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/02/Logo-Jogja-Colorful.jpg">            

              <p>Selain warna merah sebagai warna resmi, logo ini juga dirancang
              memiliki fleksibilitas untuk diadaptasikan dengan warna-warna lain
              sebagai implementasi konsep salad bowl, yang menampung
              kekhasan akar budaya maisng-masing stake holder yang mewarnai
              Jogja, membentuk kemajemukan yang ber-Bhinneka Tunggal Ika.</p>
            </div>
          </div><!-- .row -->

          <hr>

        </div><!-- #tab-featured -->
      
        <div class="tab-pane" id="tab-trending">

          <div class="row">
            

            <div class="col-sm-8 col-sm-push-2 text-center">
              <p><img src="<?php echo $updirs['baseurl'] ?>/2015/03/Istimewa-Tagline.jpg"></p>
              <p>Setiap Pemimpin, Pejabat Pemerintahan, bahu membahu 
              bersama warga masyarakat, “manunggal kawula-gusti” dalam 
              semangat “Golong Gilig” untuk mewujudkan “Jogja Istimewa”</p> 

              <p>Agar “manunggal kawula-gusti” terwujud sebagai sarana 
              mencapai “maqom keistimewaan” tersebut, maka pedoman 
              “ing ngarsa sung tuladha, ing madya mangun karsa, tut wuri 
              handayani” harus dihidupkan kembali dan dipegang teguh.</p>

              <p>Progresif. Untuk bisa bersaing di dunia global, transparansi dan 
              keterbukaan saja tidak cukup, tapi juga harus perform dan kreatif 
              agar bisa bersaing dengan kota-kota yang lain.</p>

              <p>Integritas. Selarasnya antara pikiran, perkataan dan perbuatan.</p>

            </div>
          </div><!-- .row -->
          <hr>


          <div class="row">
            <div class="col-sm-4">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/03/Istimewa-Tagline.jpg">
            </div>

            <div class="col-sm-8">
              <p>ISTIMEWA ~ (kata benda) yang berarti beda dan lebih baik 
              dari yang lain. Inggris; (verb) beyond special.</p>

              <p>ISTIMEWA is more than special, distinctive, divine, 
              excellent or extraordinary. ISTIMEWA is the most unique word 
              on earth, no single english word can replace it.</p>

              <p>Tidak harus menggunakan bahasa Inggris untuk tagline, 
              karena kita bisa bangga dengan bahasa ibu kita. Secara 
              pengucapan, kata “Istimewa” adalah kata yang mudah 
              diucapkan oleh lidah warga internasional.</p>

              <p>ISTIMEWA bukan hanya sekedar “status politik” namun 
              menjadi “ruh” peri-kehidupan di Yogyakarta yang diwujudkan 
              dalam laku “kerja keras” untuk mencapai “maqom keistimewaan” 
              tersebut agar bisa menjadi lebih baik dari yang lain.</p>

            </div>
          </div><!-- .row -->
          <hr>


          <div class="row">

            <div class="col-sm-8">
              <p>“Branding Jogja Istimewa” harus menjadi “pusaka” peradaban hari 
              ini yang akan menjadi pedoman arah pembangunan Yogyakarta.</p>

              <p>Pemerintah Provinsi Daerah Istimewa Yogyakarta membentuk 
              semacam “Dewan City Branding” yang akan mengawal 
              implementasi dan internalisasi gerakan “Jogja Gumregah” bagi 
              seluruh pegawai pemerintahan dan pegawai melalui surat 
              keputusan Gubernur agar rumusan yang “Istimewa” ini tidak 
              terbengkalai.</p>

              <p>Dewan City Branding adalah warga sipil non-birokrat yang secara 
              independen mewakili elemen-elemen masyarakat agar ruang 
              diskusi dan partisipasi publik selalu terbuka.</p>
            </div>

            <div class="col-sm-4">
              <img src="<?php echo $updirs['baseurl'] ?>/2015/03/Istimewa-Tagline.jpg">
            </div>

          </div><!-- .row -->
          <hr>

        </div><!-- #tab-trending -->

      </div><!-- .tab-content -->
      
    </div><!-- .product-tabs -->
    
  </div><!-- .container -->
</section>

<?php get_footer();