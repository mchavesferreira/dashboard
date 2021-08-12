<html>
  <head>
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="utf-8" />
    
    <script>
   $(document).ready(function (){  
   $("#calendario").datepicker({  
       dateFormat: 'dd/mm/yyyy',  
     dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],  
     dayNamesMin: ['D','S','T','Q','Q','S','S','D'],  
     dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],  
     monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],  
     monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']  
   }       
       );   
 });  
    </script>
    <title>Calendário jQuery</title>

  </head>
  <body>
  
  <div class="container py-2">
    <div class="row">
        <div class="col-md-3">
            <div class="input-group">
                <input class="form-control bg-transparent py-2 border-right-0 border" type="date" value="date1" id="example-input">
                <span class="input-group-append ml-n4 z-index-1">
                    <button class="btn btn-light border-left-0 border bg-white">
                        <i class="fa fa-calendar-alt"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>


  </body>
</html>
