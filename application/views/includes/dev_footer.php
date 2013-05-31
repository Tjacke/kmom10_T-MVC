<!-- Footer -->
<div id="dev_footer">
    <h3>Developement Footer</h3>
<footer>
     <?
    $router =& load_class('Router', 'core');
    $router1 = $this->router->fetch_class();
    $router2 = $this->router->fetch_method();
    $current = $router1;
   
   // echo '<p>Tjacke testar: '.$current.'</p>';

    ?>
  <p>Verktyg:
  <a href="http://validator.w3.org/check/referer">HTML5</a>  
  <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
  <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS3</a>
  <a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">Unicorn</a>
  <a href="http://validator.w3.org/i18n-checker/check?uri=<?php echo base_url(); ?>">i18n</a>
  <a href="http://validator.w3.org/checklink?uri=<?php echo base_url(); ?>">Links</a>
  <a href="source.php">Källkod</a>
  </p>

  <p>Manualer:
  <a href="http://www.w3.org/2009/cheatsheet/">Cheatsheet</a>
  <a href="http://dev.w3.org/html5/spec/">HTML5</a> 
  <a href="http://www.w3.org/TR/CSS2/">CSS2</a> 
  <a href="http://www.w3.org/Style/CSS/current-work#CSS3">CSS3</a> 
  <a href="http://php.net/manual/en/index.php">PHP</a> 
  </p>
 

</footer>
</div>