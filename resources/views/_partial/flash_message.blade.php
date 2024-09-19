@if (Session::has('flash_message'))
	@if (Session::has('penting'))
    <div class="alert alert-danger">
    @else
    <div class="alert alert-success">
    @endif
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_message') }}
    </div>
@endif