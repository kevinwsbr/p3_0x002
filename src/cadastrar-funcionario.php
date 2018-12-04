<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';

$conn = new Database();
$employee = new Employee($conn->db);
$employee->register();

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Cadastrar Funcionário | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Cadastrar novo funcionário</h3>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
        <form action="cadastrar-funcionario.php" method="POST">
          <div class="form-group">
            <label for="name">Nome</label>
            <input required type="text" name="name" class="form-control" id="name" placeholder="Nome do funcionário">
          </div>
          <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="ex.: Rua Sem Futuro, nº 185.">
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="salary">Salário base</label>
                <input type="text" name="baseSalary" class="form-control" id="baseSalary" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="salary">Salário por hora</label>
                <input disabled type="text" name="hourlySalary" class="form-control" id="hourlySalary" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="salary">Comissão por venda</label>
                <input disabled type="text" name="comission" class="form-control" id="comission" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="type">Tipo de vínculo</label>
                <select name="type" class="form-control" id="type">
                  <option selected value="salaried">Assalariado</option>
                  <option value="hourly">Horista</option>
                  <option value="comissioned">Comissionado</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="syndicate">Filiado a sindicato?</label>
                <select class="form-control" name="syndicate" id="syndicate">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="syndicateTax">Taxa sindical</label>
                <input disabled type="text" name="syndicateTax" class="form-control" id="syndicateTax" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/register.js"></script>
</body>

</html>