<!-- Modal -->
<div class="modal fade" id="modalReservas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="tituloReserva">Agregar Reserva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="ID" id="ID">
        <input type="hidden" name="fecha" id="fecha"><br>

        <div class="form-row">
          <div class="form-group col-md-8">
            <label>Título: </label>
            <input type="text" id="titulo" class="form-control" placeholder="Título de la reserva">
          </div>
          
          <div class="form-group col-md-4">
            <label for="">Hora del evento:</label>
            
            <div class="input-group clockpicker" data-autoclose="true">
              <input type="text" id="hora" class="form-control" value="10:30">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Descripción:</label>
          <textarea id="descripcion" rows="3" class="form-control"></textarea>
        </div>

        <div class="form-group"> 
          <label>Color:</label> 
          <input type="color" value="#ff0000" id="color" class="form-control" style="height: 36px">
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="btnAgregar" class="btn btn-success" data-dismiss="modal">Agregar</button>
        <button type="button" id="btnModificar" class="btn btn-success" data-dismiss="modal">Modificar</button>
        <button type="button" id="btnEliminar" class="btn btn-danger" data-dismiss="modal">Borrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>