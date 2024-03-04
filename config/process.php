<?php

session_start();

require_once("connection.php");
require_once("url.php");

$data = $_POST;

if (!empty($data)) {

  // criar contato
  if ($data["type"] === "create") {

    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];

    $query = "INSERT INTO contacts(name, phone, observations) VALUES (:name, :phone, :observations)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato adicionado com sucesso!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "erro: $error";
    }
  } else if ($data["type"] === "edit") {

    $name = $data["name"];
    $phone = $data["phone"];
    $observations = $data["observations"];
    $id = $data["id"];

    $query = "UPDATE contacts
                SET name = :name, phone = :phone, 
                observations = :observations  WHERE id = :id";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":observations", $observations);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $_SESSION["msg"] = "Contato atualizado com sucesso!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "erro: $error";
    }
  } else if ($data["type"] === "delete") {

    $id = $data["id"];
    $query = "DELETE FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();

      $updateQuery = "SET @counter = 0;
      UPDATE contacts SET id = @counter := @counter + 1;
      ALTER TABLE contacts AUTO_INCREMENT = 1;";
      $updateStmt = $conn->prepare($updateQuery);
      $updateStmt->execute();

      $_SESSION["msg"] = "Contato deletado com sucesso!";
    } catch (PDOException $e) {
      $error = $e->getMessage();
      echo "erro: $error";
    }
  }

  // redirect 

  header("location:" . $BASE_URL . "../index.php");
} else {

  $id;

  if (!empty($_GET)) {
    $id = $_GET["id"];
  }

  // retorna o dado de um contato

  if (!empty($id)) {
    $query = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $contact = $stmt->fetch();
  } else {
    //retorna todos os contatos
    $contacts = [];

    $query = "SELECT * FROM contacts";

    $stmt = $conn->prepare($query);

    $stmt->execute();

    $contacts = $stmt->fetchAll();
  }
}


// fechar conn

$conn = null;
