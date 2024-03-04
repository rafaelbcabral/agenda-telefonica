<?php

include_once("templates/header.php");
?>
<div class="container">
  <?php require_once("templates/backbtn.html"); ?>
  <h1 id="main-title">Editar Contato</h1>
  <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
    <input type="hidden" name="type" value="edit">
    <input type="hidden" name="id" value="<?= $contact['id'] ?>">
    <div class="form-group">
      <label for="name">Nome do Contato:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do contato" value="<?= $contact['name'] ?>" required>
    </div>
    <br>
    <div class="form-group">
      <label for="phone">Telefone do Contato:</label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone do contato" value="<?= $contact['phone'] ?>" required>
    </div>
    <br>
    <div class="form-group">
      <label for="observations">Observacoes do Contato:</label>
      <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Digite as observacoes deste contato" required rows="3"><?= $contact['observations'] ?></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary"> Salvar </button>
  </form>
</div>

<?php
include_once("templates/footer.php");
?>