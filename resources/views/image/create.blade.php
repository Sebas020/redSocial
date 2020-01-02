@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="card">
				<div class="card-header">Subir nueva imagen</div>
				<div class="card-body">
					<form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="form-group row">
							<label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
							<div class="col-md-6">
								<input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" required="">
								<!--Validar si llega algún error en el formulario, y devuelve el primer error-->
								@if($errors->has('image_path'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('image_path') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
							<div class="col-md-6">
								<textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required=""></textarea>
								<!--Validar si llega algún error en el formulario, y devuelve el primer error-->
								@if($errors->has('description'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('description') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6 offset-md-4"><!--offset-md-4 Centrar el elemento-->
								<input type="submit" value="Subir imagen" class="btn btn-primary">
							</div>
						</div>

					</form>
				</div>
			</div>	

		</div>
	</div>
</div>
@endsection