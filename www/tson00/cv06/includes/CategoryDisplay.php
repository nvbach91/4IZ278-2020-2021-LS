

<div class="list-group">
          <?php foreach($category as $categories): ?>
          <a href="#" class="list-group-item"><?php echo $categories['name']; ?>(<?php echo $categories['number']; ?>)</a>
          <?php endforeach; ?>
        </div>