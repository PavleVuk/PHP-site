<?php 

if (count($greske) > 0) : ?>
  <div class="greska">
  	<?php foreach ($greske as $greska) : ?>
  	  <p><?php echo $greska?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>