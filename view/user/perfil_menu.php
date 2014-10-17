<ul class="nav nav-tabs" role="tablist">
  <li class="<?php if($template['menuPerfil']===0){echo 'active';}?>"><a href="perfil.php">Perfil</a></li>
  <li class="<?php if($template['menuPerfil']===1){echo 'active';}?>"><a href="projetos_apoiados.php">Projetos apoiados</a></li>
  <li class="<?php if($template['menuPerfil']===2){echo 'active';}?>"><a href="meus_projetos.php">Meus projetos</a></li>
  <?php
  $vip = $db->getVipList();
  if(in_array($_SESSION['email'], $vip)) {
  ?>
  <li class=""><a href="admin.php" target="blank">Área administrativa</a></li>
  <?php 
  }
  ?>

</ul>