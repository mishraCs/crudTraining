<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Footer</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<footer class="footer">
  <div class="footer__parralax">
    <div class="footer__parralax-trees"></div>
    <div class="footer__parralax-moto"></div>
    <div class="footer__parralax-secondplan"></div>
    <div class="footer__parralax-premierplan"></div>
    <div class="footer__parralax-voiture"></div>
  </div>
  <div class="container">
    <div class="footer__columns">
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="shopping-bag"></i> <span>My Official</span></h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
            <li class="footer__nav-item">
              <a href="https://www.linkedin.com/in/er-aakash-mishra-690292266/" class="footer__nav-link">
                Linkedin
              </a>
            </li>
            <li class="footer__nav-item">
              <a href="" class="footer__nav-link">
                Politique de confidentialité
              </a>
            </li>
            <li class="footer__nav-item">
              <a href="" class="footer__nav-link">
                CGV
              </a>
            </li>
            <li class="footer__nav-item">
              <a href="" class="footer__nav-link">
                Livraisons et retours
              </a>
            </li>
            <li class="footer__nav-item">
              <a href="" class="footer__nav-link">
                Règlement concours
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="share-2"></i> <span>About Web</span></h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
            <li class="footer__nav-item">
                <a id="temp" class="footer__nav-link" href="#"></a>
              </a>
            </li>
            <li class="footer__nav-item">
            <a  class="footer__nav-link" href="#">
                  <?php $date1 = date_create("2024-06-04");
                    $date2 = new DateTime();
                    $diff = date_diff($date1, $date2);
                    echo "Twd: " . ltrim($diff->format("%R%a"), '+');?>
                </a>
            </li>
            <li class="footer__nav-item">
            <a class="footer__nav-link" href="#"><?= "Total visited user :".$userId ?></a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="footer__col">
        <h3 class="footer__col-title">
          <i data-feather="send"></i> <span>Contact</span></h3>
        <nav class="footer__nav">
          <ul class="footer__nav-list">
            <li class="footer__nav-item">
              <a href="mailto:contact.laboiserie@gmail.com" class="footer__nav-link">
                mishrathink0096@gmail.com
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
      <div class="footer__copyrights">
        <p>My github <a href="https://github.com/mishraCs" target="_blank">@mishraCs</a></p>
      </div>
  </div>
</footer>
<!-- partial -->
  <script src='https://unpkg.com/feather-icons'></script>

</body>
</html>
