@if(Session::has('successMsg'))
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none';">
            <i class="material-icons">close</i>
        </button>
        <span><b>Success - </b> {{ Session::get('successMsg') }}</span>
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close"
                    onclick="this.parentElement.style.display='none';">
                <i class="material-icons">close</i>
            </button>
            <span><b>Danger - </b> {{ $error }}</span>
        </div>
    @endforeach
@endif
