<?php

include_once("templates/header.php");
?>
<div class="container">
  <?php require_once("templates/backbtn.html"); ?>
  <h1 id="main-title">Criar Contato</h1>
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
    <input type="hidden" name="type" value="create">
    <div class="form-group">
      <label for="name">Nome do Contato:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do contato" required>
    </div>
    <br>
    <div class="form-group">
      <label for="phone">Telefone do Contato:</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone do contato" required>
    </div>
    <br>
    <div class="form-group">
      <label for="observations">Observacoes do Contato:</label>
      <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Digite as observacoes deste contato" required rows="3"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary"> Cadastrar </button>
  </form>
</div>

<?php
include_once("templates/footer.php");
?>