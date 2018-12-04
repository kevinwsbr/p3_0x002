<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';

$conn = new Database();
$employee = new Employee($conn->db);
$employees = $employee->getEmployees();

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row">
      <div class="col">
        <h5>Olá, estas são as ações disponíveis:</h5>
      </div>
    </div>
    <div class="row my-3">
      <div class="col">
        <a class="btn btn-info btn-block" href="cadastrar-funcionario.php" role="button">Cadastrar funcionário</a>
      </div>
      <div class="col">
        <a class="btn btn-info btn-block" href="gerar-folha.php" role="button">Gerar folha de pagamento</a>
      </div>
      <div class="col">
        <a class="btn btn-success btn-block" href="registrar-ponto.php" role="button">Registrar ponto</a>
      </div>
      <div class="col">
        <a class="btn btn-success btn-block" href="lancar-venda.php" role="button">Lançar venda</a>
      </div>
      <div class="col">
        <a class="btn btn-success btn-block" href="lancar-taxa.php" role="button">Lançar Taxa</a>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
        <h5>Funcionários cadastrados</h5>
        <table class="table table-bordered">
          <thead class="text-white bg-success">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Endereço</th>
              <th scope="col">Tipo</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($employees as $emp) {?>
            <tr>
              <th scope="row">
                <?php echo $emp['ID']; ?>
              </th>
              <td>
                <a href="detalhar-funcionario.php?id=<?php echo $emp['ID']; ?>"><?php echo $emp['name']; ?></a>
              </td>
              <td>
                <?php echo $emp['address']; ?>
              </td>
              <td>
                <?php 
                  if ($emp['type'] == 'comissioned') {
                    echo 'Comissionado';
                  }else if ($emp['type'] == 'salaried') {
                    echo 'Assalariado';
                  }else if ($emp['type'] == 'hourly') {
                    echo 'Horista';
                  }
                ?>
              </td>
              <td>
                <div class="row no-gutters">
                  <div class="col mr-1">
                    <a class="btn btn-sm btn-block btn-success" href="editar-funcionario.php?id=<?php echo $emp['ID'];?>"
                      role="button">Editar</a>
                  </div>
                  <div class="col ml-1">
                    <a class="btn btn-sm btn-block btn-danger" href="remover-funcionario.php?id=<?php echo $emp['ID'];?>"
                      role="button">Remover</a>
                  </div>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>