@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<div class="card">
				<div class="card-header">Editar mi imagen</div>
				<div class="card-body">
					<form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="image_id" value="{{ $image->id }}">
						<div class="form-group row">
							<label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
							<div class="col-md-6">
								@if($image->user->image)
				                    <div class="container-avatar">
                       					<img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="avatar">   
				                    </div>
				                    <!--url('/user/avatar/'.Auth::user()->image)-->
			                    @endif
								<input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}">
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
								<textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required="">{{ $image->description }}</textarea>
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
								<input type="submit" value="Actualizar imagen" class="btn btn-primary">
							</div>
						</div>

					</form>
				</div>
			</div>	

		</div>
	</div>
</div>
@endsection