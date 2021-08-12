<html>
  <head>
 
  <style type="text/css">
/* hide the html5 date picker spin arrows */
.form-control[type=date]::-webkit-inner-spin-button, 
.form-control[type=date]::-webkit-clear-button,
.form-control[type=date]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

.form-control[type=date]::-webkit-calendar-picker-indicator {
    color: rgba(0,0,0,0);
    background-color: rgba(0,0,0,0);
    position: relative;
    z-index: 1;
    transform: translateX(16px);
    cursor: pointer;
}

.z-index-1 {
    position: relative;
    z-index: -1;
}

/* hide the blue outline */
.form-control:focus {
    outline: 0 !important;
    border-color: initial;
    box-shadow: none;

</style>
	
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
