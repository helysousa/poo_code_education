<!DOCTYPE html>

<?php

require_once "Cliente.php";
require_once "ClienteRepository.php";


/*
 *  Criar clientes utilizando biblioteca Faker
 *  Efeito colateral => refresh da tela apresenta nova lista de clientes
 *  Vantagem => posso alterar para qualquer quantidade de clientes, apenas alterando o índice do loop
 *
 */

    $clientes = ClienteFakeRepository::getClientes(10);

?>

<html ng-app="listStore">
<head >
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Lista de Clientes POO</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>

    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="angular-resource.js"></script>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Lista de clientes</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Página inicial</a></li>
                </ul>
                <!--
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
                -->
            </div>
        </div>
    </nav>

    <div class="table-responsive"  ng-controller="ListController as list">
        <table class="table table-striped">
            <thead>
                <th>Código</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>UF</th>
            </thead>

            <tfoot>
                <tr>
                    <td colspan="4">Clientes listados: {{ list.clientes.length }}</td>
                </tr>
            </tfoot>

            <tbody ng-repeat="cliente in list.clientes | orderBy:'-Nome'">

                    <TR>
                        <TD>{{ cliente.Codigo }}</TD>
                        <TD>{{ cliente.Nome }}</TD>
                        <TD>{{ cliente.Cidade }}</TD>
                        <TD>{{ cliente.UF }}</TD>
                    </TR>

            </tbody>
        </table>
    </div>

</body>

</html>
