@if(\Session::has('flash_notification'))
    @foreach (Session::get('flash_notification') as $message)
        <div class="alert alert-{{ $message['level'] }}">   
			<i class="fa fa fa-warning"></i>         
            <strong>Atenção! </strong>{!! $message['message'] !!}			
        </div>
    @endforeach
@endif    
{{ Session::forget('flash_notification') }}
@if ($errors->any())
	@foreach($errors->all() as $error)

	<div class="alert alert-warning">
		<i class="fa fa fa-warning"></i>
		<strong>Atenção! </strong> {!! $error !!}
	</div>

	@endforeach
@endif