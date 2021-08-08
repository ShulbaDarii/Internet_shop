<?php

//$product

use yii\bootstrap4\Carousel;
use yii\helpers\Html;



// $product = json_encode($product);
// $js =<<<JS
//     var product = $product;
//     console.log(product[0].name);
// JS;

// $this->registerJs($js);
?>

<style>
.carousel {

  height: 300px;
  
  margin-bottom: 30px;
  
}
</style>

<?=Carousel::widget([
    'items' => $images_array
])
?>

<div class="row">
  <?php
  foreach($products as $product)
  {
    $images= json_decode($product->url_images,true);
    echo '<div class="col-md-2">
    <a  href="product/'.$product->id.'/index" style="color:black;">  
      <div class="card" style="height:100%">
        <img src="'.$images[0].'" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$product->name.'</h5>
          <p class="card-text">'.$product->description.'</p>
        </div>
      </div>
      </a>
    </div>';
  }

  ?>
</div>


<!-- <i class="bi bi-alarm"></i> -->