<?php
  include_once("conexao.php");
  require 'header.php';
?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>    
    <style>      
      #map {
        width: 100%;
		height: 600px; 
      }
	  .carregando{
		  color:#ff0000;
		  dispaly:none;
	  }	         
    </style>
  </head>
  <body>
    <div id="map"></div><br><br>  	
    <div class="row">
      <div class="form-group col-md-5 offset-md-5">       
        <br>
        <br>
        <!-- Button modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Cadastrar</button>
        <br>
        <br>
        <!--<span id="msg"></span>-->
      </div>
    </div><!--
    <form name="search" id="search" action="" method="POST">
      <div class="form-row">
        <div class="form-group col-md-4 offset-md-4">
          <label>Listar Unidades:</label>
          <select name="estado_id" id="estado_id" class="form-control">
            <option value="">Selecione</option>
            <?php
              $result_estado = "SELECT DISTINCT est.* 
                FROM estados est
                INNER JOIN markers mak ON mak.estado_id = est.id
                ORDER BY est.estado_nome ASC";
              $resultado_estado = mysqli_query($conn, $result_estado);
              while($row_estado = mysqli_fetch_array($resultado_estado)){
                echo '<option value="'.$row_estado['id'].'">'.$row_estado['estado_nome'].'</option>';
              }
            ?>
          </select>          
        </div>
      </div>         
    </form>	
	  <span class="carregando">Aguarde, pesquisando...</span>-->
    <span id="estado"></span><br><br><br><br>      
    
    <!-- Inicio listar -->
    <span id="conteudo"></span>
    <script>

      var qnt_result_pg = 10; // quantidade de registro por pagina
      var pagina = 1; //pagina inicial
      
      $(document).ready(function(){
        listar_cad(pagina, qnt_result_pg); // Chamar a função para listar os registros
      });
      
      function listar_cad(pagina, qnt_result_pg){
        
        var dados = {
          pagina: pagina,
          qnt_result_pg: qnt_result_pg
        };

        $.post('listar_cad.php', dados, function(retorna){ // enviando via post os dados
          //substitui o valor no seletor id="conteudo"
          $("#conteudo").html(retorna);
        });
      };

    </script>
    <!-- Fim listar -->
    <!-- Inicio Modal Cadastrar -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">          
						<h5 class="modal-title" id="addModalLabel">Cadastrar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="insert_form">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nome</label>
								<div class="col-sm-10">
									<input name="name" type="text" class="form-control" id="name" placeholder="Nome da Empresa ou Filial">
								</div>
							</div>							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Endereço:</label>
								<div class="col-sm-10">
									<input name="address" type="text" class="form-control" id="address" placeholder="Digite o número e o Logradouro">
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Latitude:</label>
								<div class="col-sm-10">
									<input name="lat" type="text" class="form-control" id="lat" placeholder="Digite a latitude">
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Longitude:</label>
								<div class="col-sm-10">
									<input name="lng" type="text" class="form-control" id="lng" placeholder="Digite a longitude">
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Total efetivo:</label>
								<div class="col-sm-10">
									<input name="totalEfetivo" type="number" class="form-control" id="totalEfetivo" placeholder="Digite a longitude">
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Afastados:</label>
								<div class="col-sm-10">
									<input name="afastado" type="number" class="form-control" id="afastado" placeholder="Total do efetivo afastado">
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Afastado (%):</label>
								<div class="col-sm-10">
									<input name="percentoAfastado" type="number" class="form-control" id="percentoAfastado" placeholder="Percentual do efetivo afastado" readonly="true" step='0.01'>
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Níveis de Risco:</label>
								<div class="col-sm-10">
                <select required id="type" name="type" class="form-control" readonly=“true”>
                  <option value="">Selecione nível de risco ...</option>
                  <option value="0">Nível azul - Dentro da normalidade</option>
                  <option value="1">Nível amarelo - Atenção</option>
                  <option value="2">Nível vermelho - Perigo</option>
                  <option value="3">Nível preto - Crítico</option>			  
                </select>
								</div>
              </div>
              <div class="form-group row">
								<label class="col-sm-2 col-form-label">Estado:</label>
								<div class="col-sm-10">
                <select name="estado_id" id="estado_id" class="form-control">
                  <option value="">Selecione</option>
                  <?php
                    $result_estado = "SELECT * FROM estados est ORDER BY estado_nome ASC";
                    $resultado_estado = mysqli_query($conn, $result_estado);
                    while($row_estado = mysqli_fetch_array($resultado_estado)){
                      echo '<option value="'.$row_estado['id'].'">'.$row_estado['estado_nome'].'</option>';
                    }
                  ?>
                </select>
								</div>
              </div>
							<div class="modal-footer">								
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
									<input type="submit" name="CadUser" id="CadUser" value="Cadastrar" class="btn btn-success">								
							</div>
						</form>
					</div>
				</div>
			</div>
    </div>
    <!-- Fim Modal Cadastrar -->    
    <?php require "footer.php";?>
    <script>
      /*
      //Função Listar dados index
      $(function(){
        $('.carregando').hide();
        $('#estado_id').change(function(){
          if( $(this).val() ) {
            $('#estado').hide();
            $('.carregando').show();
            $.getJSON('emp_estados.php?search=',{estado_id: $(this).val(), ajax: 'true'}, function(j){
              var valor = '<div class="container">   <div class="row">     <table class="table table-hover"> 		  <thead> 			<tr> 			  <th scope="col">#</th> 			  <th scope="col">GB</th> 			  <th scope="col">Endereço</th> 		<th scope="col">Total Efetivo</th>	  <th scope="col">Afastado</th>   <th class="actions">Ações</th>			</tr> 		  </thead> 	</table> 	</div>   </div>	  '
              for (var i = 0; i < j.length; i++) {
                valor += '<div class="container">   <div class="row"> <table class="table table-hover"> <tbody> 			<tr> 			  <th scope="row" style="width:30px;">' + j[i].id +'</th> 			  <td style="width:200px;">' + j[i].name +'</td> 			  <td style="width:550px;">' + j[i].address +'</td> 		<td style="width:200px;">' + j[i].total_efetivo +'</td> <td style="width:400px;">	  <td style="width:200px;">' + j[i].afastado +'</td> <td style="width:400px;"><a href="edit_cad.php?id='+ j[i].id+'" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Editar</a>&ensp;<a href="exclui_cad.php?id='+ j[i].id+'" class="btn btn-danger">Excluir</a></td>			</tr> </tbody> 		</table> 	</div> </div>';
              }	
              $('#estado').html(valor).show();
              $('.carregando').hide();
            });
          } else {
            $('.carregando').hide();
            $('#estado').html('Nenhum Quartel encontrado');
          }
        });
      });*/

      // Função calcula e preenche automatico a porcentagem
      $(document).ready(function(){
        $("input[name='afastado']").blur(function(){
          var campo1 = document.getElementById('totalEfetivo').value;
          var campo2 = document.getElementById('afastado').value;
          var maior = (parseFloat(campo1) > parseFloat(campo2)? campo1 : campo2);
          var menor = (parseFloat(campo1) < parseFloat(campo2)? campo1 : campo2);
          var result = (menor/maior)*100;

          document.getElementById('percentoAfastado').value = result;	
          var campo3 = document.getElementById('percentoAfastado').value;
          
          if (campo3 <= 9) {
            document.getElementById('type').value = 0;
          } else if (campo3 >=10 && campo3 <=29) {
            document.getElementById('type').value = 1;
          } else if (campo3 >= 30 && campo3 <= 49) {
            document.getElementById('type').value = 2;
          }	else {
            document.getElementById('type').value = 3;
          }
        });
      });			
      
      // Inicio Modal Cadastro.
      $('#insert_form').on('submit', function(event){
        event.preventDefault();
        //Receber os dados do formulário
        var dados = $("#insert_form").serialize();
        $.post("proc_add.php", dados, function (retorna){
          if(retorna){
            //Alerta de cadastro realizado com sucesso
            $("#msg").html('<div class="alert alert-success" role="alert">Cadastro efetuado com sucesso.</div>');
            alert('Cadastro efetuado com sucesso!');
            
            //Limpar os campo
            $('#insert_form')[0].reset();
            
            //Fechar a janela modal cadastrar
            //$('#addModal').modal('hide');
            $('.modal fade').hide();
            
          }else{
            alert('Erro ao efetuar cadastro.');
          }          
        });
			});
      // Inicio Fim Modal Cadastro.    

      // Inicio conf Maps
      var customLabel = {
        0: {
          label: {
            color: 'blue',
            fontWeight: 'bold',
            //text: '●',
            fontSize: 'small',
          }             
        },
        1: {
          label: {
            color: 'yellow',
            fontWeight: 'bold',
            //text: '●',
            fontSize: 'small',   
               
          }         
        },
        2: {
          label: {
            color: 'red',
            fontWeight: 'bold',
            //text: '●',
            fontSize: 'small',
          }             
        },
        3: {
          label: {
            color: 'black',
            fontWeight: 'bold',
            //text: '●',
            fontSize: 'small',
          }             
        },
        bar: {
          label: 'B'
        }
      };      
      
      function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(-25.388688, -51.460237),
        zoom: 7
      });
      
      var imageIcones = ['http://localhost/bmpr/images/markers/blue_MarkerO.png', 
                          'http://localhost/bmpr/images/markers/yellow_MarkerO.png', 
                          'http://localhost/bmpr/images/markers/red_MarkerO.png', 
                          'http://localhost/bmpr/images/markers/black_MarkerO.png'
                          ];                

      var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('resultado.php', function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          Array.prototype.forEach.call(markers, function(markerElem) {
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var type = markerElem.getAttribute('type');
            var afastado = markerElem.getAttribute('afastado');
            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));

            var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));                
              
            var text = document.createElement('text');
            text.textContent = address
            infowincontent.appendChild(text);
            infowincontent.appendChild(document.createElement('br'));
            var text = document.createElement('text');
            text.textContent = 'Afastado %:'+ afastado
            infowincontent.appendChild(text);              
            var icon = customLabel[type] || {};
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              label: icon.label,
              icon: imageIcones[type] || {} //imageAzul                
            });

            marker.addListener('click', function() {
              infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });
          });
        });
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUNncpyVZvdgAfJc9Bsu8Mj1H_rMw4LRo&callback=initMap"></script>
  </body>
</html>