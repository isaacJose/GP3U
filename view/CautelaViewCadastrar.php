<?php
session_start();
include '../validasessaoativa.php';
include '../validasessao.php';
include_once '../controller/CautelaController.php';
include_once '../controller/PolicialController.php';
include_once '../controller/ItemController.php';
include 'includes/header.html';
?>

  <?php
  include 'includes/style/CautelaViewCadastrar.html';
  ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="PrincipalView.php">SIGEP</a>

      

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <a class="navbar-brand mr-1" href="">Bem vindo(a), <?php echo ($_SESSION['nome_funcional']); ?></a>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="exit">
            <i class="material-icons" >menu</i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <!--
            <a class="dropdown-item" href="#">Configurações</a>
            <a class="dropdown-item" href="#">Perfil</a>            
            <a class="dropdown-item" href="OperadorView.php">Operador</a>
            -->       
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutModal">Sobre</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li>
          <div class="imagem">
          <img src="../img/sigeplogo.png">
          </div>                  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="PrincipalView.php">
          <i class="material-icons">home</i>
            <span class="spanmenu">Principal</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="UnidadeView.php">
          <i class="material-icons">star</i>
            <span class="spanmenu">Unidades</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="SubunidadeView.php">
          <i class="material-icons">star_border</i>
            <span class="spanmenu">Subunidades</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="PolicialView.php">
          <i class="material-icons">person</i>
            <span class="spanmenu">Policiais</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ItemView.php">
          <i class="material-icons">storage</i>
            <span class="spanmenu">Itens</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="CautelaView.php">
          <i class="material-icons">attach_file</i>
            <span class="spanmenu">Cautelas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="InspecaoView.php">
          <i class="material-icons">find_in_page</i>
            <span class="spanmenu">Inspeções</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="LogAcessoView.php">
          <i class="material-icons">how_to_reg</i>
            <span class="spanmenu">Acessos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="OperadorView.php">
          <i class="material-icons">group</i>
            <span class="spanmenu">Operadores</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="../view/CautelaView.php">Cautelas</a>
            </li>
            <li class="breadcrumb-item active">Cadastrar</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
            <i class="material-icons">grid_on</i>
              <span class="spanmenu">Cautela - Formulário de cadastro</span>
            </div>
            <div class="card-body">
              <form action="../controller/CautelaController.php" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="row">   
                    
                    
                    <div class="col-lg-6">
                         <div class="form-group">
                            <label>Policial</label>
                            <select id="idPolicial" name="idPolicial" class="form-control" required>
                              <option value="">-- Selecione um policial --</option>
                            <?php
                              $opt = new PolicialController();
                              $opt->listaOptions();
                            ?>
                            </select>
                        </div>
                      </div>
                    
                    <div class="col-lg-6">
                    <div class="form-group">
                      <label>Tipo de Cautela</label>
                      <select id="permanente" name="permanente" class="form-control" required>
                          <option value="">-- Selecione o tipo --</option>
                          <option value="0">Temporária</option>
                          <option value="1">Permanente</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-5">
                        
                      </div>
                  </div>

                  <div class="input-group mb-3 col-lg-6">
                        <input id="serialItem" type="text" class="form-control" placeholder="Nº de série ou código do item" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <input id="qtdItem" type="text" class="form-control" placeholder="Quantidade" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button id="btnAdicionarItem" class="btn btn-outline-success" type="button">Adicionar item</button>                            
                        </div>
                    </div>                  
          
                  

                      </div>
                      <!-- Tabela de acrodo com os docs do projeto -->
                    </div>

                    

                    <div class="row">
                      <div class="col-lg-12">
                        <button id="btnCadastrarCautela" type="button" name="cadastrar" class="btn btn-success">Finalizar cautela</button>
                        <!-- <button type="button" id="teste" name="teste" class="btn btn-primary">Teste DB</button> -->
                        <input type="reset" class="btn btn-secundary" id="voltar" name="voltar" value="Cancelar" onClick="history.go(-1)">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

                  <div class="container-fluid">

           
            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
              <i class="material-icons">grid_on</i>
                <span class="spanmenu">Itens inseridos</span>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-sm" id="dataTableItems" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Modelo</th>
                        <th>Serial</th>
                        <th>Qtd</th>                                                
                        <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $lista = new ItemController();
                        //$lista->listaItemTeste();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>            
            </div>
          
        
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
        include 'includes/footer.html';
        ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <?php
          include 'includes/logaout_in_navbar.html';
          ?>
        </div>
      </div>
    </div>

    <?php
    include 'includes/modalabout.html'
    ?>

    <?php
    include 'includes/script.html';
    ?>

  </body>

</html>

<script>
$(document).ready(function(){
    
    $('#btnAdicionarItem').on('click', function(){
        
        var serialItem = $('#serialItem').val();        
        var qtdItem = $('#qtdItem').val();
        var botaoRemove = '<button class="btn btn-danger btn-xs remove">Remover item</button>';

        if($('#serialItem').val() == ''){
            alert("Por favor informe o serial");
            $('#serialItem').focus();
        }
        else if($('#qtdItem').val() == ''){
            alert("Por favor selecione a quantidade");
            $('#qtdItem').focus();
        }
        else{
            $.ajax
            ({
                type: 'POST',
                dataType: 'json',
                url: '../controller/ItemCautelaController.php',
                data:
                {
                    serialItem: serialItem,
                    qtdItem: qtdItem
                },
                success: function(data)
                {                    
                    $('#dataTableItems tbody:last-child').append
                    (
                        '<tr>' +
                            '<td>' + data[0].id + '</td>' +
                            '<td>' + data[0].modelo + '</td>' +
                            '<td>' + data[0].serial + '</td>' +
                            '<td>' + qtdItem + '</td>' +
                            '<td align="center">' + botaoRemove + '</td>' +
                        '</tr>'
                    );
                    //alert("Item adicionado");
                    $('#serialItem').val('');
                    $('#qtdItem').val('');
                },
                error: function()
                {
                    //alert("Deu alguma merda"+data[0].erro);
                    swal({
                        title: "Ops! Tivemos um problema.",
                        text: "Número de série incorreto ou a quantidade superior ao estoque. Verifique as informações inseridas",
                        icon: "warning",
                        buttons: false,
                        dangerMode: true,
                    })
                }
            });
        }        
    });



    //--------- remover linha dos itens inseridos -------------------------

    
    $(document).on('click', '.remove', function(){
        $(this).parents('tr').remove();
        swal("Item removido!")
    });


    // --------- botão finalizar cautela ----------------------------------

    $('#btnCadastrarCautela').on('click', function(){

        if($('#idPolicial').val() == ''){
            alert("Por favor selecione um policial");
            $('#idPolicial').focus();
        }
        else if($('#permanente').val() == ''){
            alert("Por favor selecione o tipo de cautela");
            $('#permanente').focus();
        }
        else{
            var table_data = [];
        
        //foreach para pegar os dados
        $('#dataTableItems tr').each(function(row, tr){
            
            if($(tr).find('td:eq(0)').text() == ""){

            }
            else{
                var sub = {
                    'permanente' : $('#permanente').val(),
                    'id_policial' : $('#idPolicial').val(),
                    'id_item' : $(tr).find('td:eq(0)').text(),
                    'quantidade' : $(tr).find('td:eq(3)').text()
                };

                var permanente = $('#permanente').val();
                var id_policial = $('#idPolicial').val();
                var id_item = $(tr).find('td:eq(0)').text();
                var quantidade = $(tr).find('td:eq(3)').text();
                
                $.ajax({
                        url: '../controller/VandersonController.php',
                        method: 'POST',
                        data : 
                        { 
                            permanente : permanente,
                            id_policial : id_policial,
                            id_item : id_item,
                            quantidade : quantidade
                        }
                    });               
                table_data.push(sub);                
                }
            });
            console.log(table_data);
            swal("Tudo certo!", "Cautela cadastrada com sucesso.", "success");
            setTimeout( function() {
                window.location.replace("http://localhost/GP3U/view/CautelaView.php");
            }, 2000 );
        }        
    });
});
</script>

