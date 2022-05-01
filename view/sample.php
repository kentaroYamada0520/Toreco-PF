<div class="card-deck" style="max-width: 1140px;">
    <!-- <div class="card-deck"> -->
    <div class="card-deck">
      <div class="row">
      <?php foreach ($items as $item) { ?>
        <div class="col-xl-3">
          <div class="card h-80 text-center mb-0">
            <figure class="card-body mb-0" style="width: 200px">
                                                                   <!-- print(IMAGE_PATH . $item['image']); -->
              <img class="card-img-top" style="height: 230px" src="<?php print IMAGE_PATH .
                  $item['item_image']; ?>">
              <figcaption class="mt-4">
                  <form action="item_detail.php" method="get">
                    <input type="submit" value="<?php print h(
                        $item['item_name']
                    ); ?>" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print h(
                        $item['item_id']
                    ); ?>">
                    <input type="hidden" name="csrf_token" value="<?= $token ?>">
                  </form>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>    
    </div>
  </div>