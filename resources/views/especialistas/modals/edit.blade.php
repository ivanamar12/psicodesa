<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background: rgb(0, 204, 204); background: linear-gradient(90deg, rgb(0, 153, 204) 0%, rgb(0, 204, 204) 100%);">
        <h5 class="modal-title" id="exampleModalLabel" >Nuevo Especialista</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="editForm">
			  @csrf
			  @method('PUT')
			  <input type="hidden" name="id" id="editEspecialistaId">
			  <div class="form-group row">
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Nombres *</label>
			    <input type="text" class="form-control" name="nombre" aria-describedby="emailHelp" placeholder="Nombres de pila" title="Nombres" required="" id="editaNombre">
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Apellidos *</label>
			    <input type="text" class="form-control" name="apellido" aria-describedby="emailHelp" placeholder="Apellidos" title="Apellidos" required="">
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Cedula *</label>
			    <input type="number" class="form-control" name="ci" aria-describedby="emailHelp" required="" placeholder="Cedula identidad solo numeros" title="Cedula" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=7;">
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Fecha de Nacimiento *</label>
			    <input type="date" class="form-control" name="fecha_nac" aria-describedby="emailHelp" required="" title="Fecha Nacimiento" id="fecha">
			    <span id="mensaje" style="color: red; display: none;"></span>
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Especialidad *</label>
			    <input type="text" class="form-control" name="especialidad" required="" aria-describedby="emailHelp" placeholder="Especialidad" title="Especialidad">
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Telefono *</label>
			    <input type="text" class="form-control" required="" name="telefono" aria-describedby="emailHelp" placeholder="0000-0000000" title="Telefono" onkeypress="var w = event.which == undefined? event.which : event.keyCode; return w>=48 && w <=57 && this.value.length<=10;">
			  </div>

			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Correo Electronico *</label>
			    <input type="email" class="form-control" required="" name="email" aria-describedby="emailHelp" placeholder="micorreo@gmail.com" title="Correo Electronico">
			  </div>
			  <div cclass="col-12 col-lg-3 mb-2">
			  	<label for="exampleInputEmail1" class="form-label">Genero *</label>
			    <select class="form-control form-control-solid select2" required="" style="width: 100%;" aria-label="Default select example" name="genero_id">
			    	<option selected>Seleccione su genero</option>
			        @foreach ($generos as $genero)

			        <option value="{{$genero->id}}">{{$genero->genero}}</option>

			        @endforeach
			    </select>
			  </div>
			  <div cclass="col-12 col-lg-3 mb-2">
			  	<label for="exampleInputEmail1" class="form-label">Estado *</label>
			    <select class="form-control form-control-solid select2" required="" style="width: 100%;" aria-label="Default select example" name="estado_id" id="selectEstado">
			    	<option selected>Seleccione un estado</option>
			        @foreach ($estados as $estado)

			        <option value="{{$estado->id}}">{{$estado->estado}}</option>

			        @endforeach
			    </select>
			  </div>
			  <div cclass="col-12 col-lg-3 mb-2">
			  	<label for="exampleInputEmail1" class="form-label">Municipio *</label>
			    <select class="form-control form-control-solid select2" required="" style="width: 100%;" aria-label="Default select example" name="municipio_id" id="selectMunicipio">
			    	<option selected>Seleccione un municipio</option>
			        @foreach ($municipios as $municipio)

			        <option value="{{$municipio->id}}">{{$municipio->municipio}}</option>

			        @endforeach
			    </select>
			  </div>
			   <div cclass="col-12 col-lg-3 mb-2">
			  	<label for="exampleInputEmail1" class="form-label">Parroquias *</label>
			    <select class="form-control form-control-solid select2" required="" style="width: 100%;" aria-label="Default select example" name="parroquia_id" id="selectParroquia">
			    	<option selected>Seleccione un parroquia</option>
			        @foreach ($parroquias as $parroquia)

			        <option value="{{$parroquia->id}}">{{$parroquia->parroquia}}</option>

			        @endforeach
			    </select>
			  </div>
			  <div class="col-12 col-lg-3 mb-2">
			    <label for="exampleInputEmail1" class="form-label">Sector *</label>
			    <input type="text" class="form-control" name="sector" required="" aria-describedby="emailHelp" placeholder="cas/edif/apt/ #, calle/vereda/avenida #, nombre del sector" title="Sector">
			  </div>
			  <label><b>(*)Campos obligatorios   </b></label><br>
			  <a href="/Especilistas" class="btn btn-secondary" tabindex="5">Cancelar</a>
			  <button type="submit" class="btn btn-primary" tabindex="5">Agregar</button>
			</div>
			</form>
      </div>
    </div>
  </div>
</div>
