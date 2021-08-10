<h2 class="text-center text-info">
	Solicitudes de Empleados Konecta 
</h2>
<button type="button" class="btn btn-success float-right mb-4" onclick="add()" title="Agregar empleado"> <i class="fa fa-plus"></i> Agregar solicitud</button>

<div class="table-responsive mt-4">
	<div class="col-md-12">
		<form action="<?php echo base_url($controller.'/index') ?>" method="get">
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 ml-0">
						<input type="text" placeholder="Buscar por código" class="form-control" value="<?php echo $q ?>" name="nombre">
					</div>
					<div class="col-md-4">
						<input type="submit" value="Buscar solicitud" class="btn btn-info">
					</div>
				</div>
			</div>
		</form>
	</div>
	<table class="table table-hovered">
		<thead>
			<tr>
				<th>
					Código
				</th>
				<th>
					Descripción
				</th>
				<th>
					Resumen
				</th>
				<th>
					Empleado
				</th>
			</tr>
		</thead>
		<?php if (empty($solicitudes)): ?>
			<tr>
				<td colspan="4" class="text-center">
					No hay solicitudes registradas
				</td>
			</tr>
		<?php else: ?>
			<?php foreach ($solicitudes as $key => $value): ?>
				<tr>
					<td><?php echo $value->codigo ?></td>
					<td><?php echo $value->descripcion ?></td>
					<td><?php echo $value->resumen ?></td>
					<td><?php echo $value->empleado ?></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</div>

<!-- Add modal content -->
	<div id="add-modal" class="modal fade" tabindex="-1" role="dialog"
		aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="text-center bg-info p-3">
					<h4 class="modal-title text-white" id="info-header-modalLabel">Agregar solicitud</h4>
				</div>
				<div class="modal-body">
					<form id="add-form" method="post" class="pl-3 pr-3">								
                        <div class="row">
 							<input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="11" required>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="codigo"> Codigo: <span class="text-danger">*</span> </label>
									<input type="text" id="codigo" name="codigo" class="form-control" placeholder="Codigo" maxlength="50" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="descripcion"> Descripcion: <span class="text-danger">*</span> </label>
									<input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" maxlength="50" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="resumen"> Resumen: <span class="text-danger">*</span> </label>
									<input type="text" id="resumen" name="resumen" class="form-control" placeholder="Resumen" maxlength="50" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="id_empleado"> Empleado: <span class="text-danger">*</span> </label>
									<select type="number" id="id_empleado" name="id_empleado" class="form-control" number="true" required>
										<?php if (empty($empleados)): ?>
											<option value="">Seleccionar</option>
										<?php else: ?>
											<?php foreach ($empleados as $key => $value): ?>
												<option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
							</div>
						</div>
																				
						<div class="form-group text-center">
							<div class="btn-group">
								<button type="submit" class="btn btn-success" id="add-form-btn">Agregar solicitud</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar / Cancelar</button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	

<script>

function add() {

	$(document).ready(function() {
		$("#add-form")[0].reset();
		$(".form-control").removeClass('is-invalid').removeClass('is-valid');		
		$('#add-modal').modal('show');
		
		$("#add-form").submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?php echo base_url($controller.'/add') ?>',						
				type: 'post',
				data: $("#add-form").serialize(), // /converting the form data into array and sending it to server
				dataType: 'json',
				beforeSend: function() {
					$('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
				},					
				success: function(response) {

					if (response.success === true) {

						Swal.fire({
							position: 'bottom-end',
							icon: 'success',
							title: response.messages,
							showConfirmButton: false,
							timer: 3000
						}).then(function() {
							location.reload();
						})

					} else {

						Swal.fire({
							position: 'bottom-end',
							icon: 'error',
							title: response.messages,
							showConfirmButton: false,
							timer: 3000
						})
					}
					$('#add-form-btn').html('Agregar solicitud');
				}
			});
		});

	});
}
 
</script>