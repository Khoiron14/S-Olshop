@if (session('success'))
    <div class="container">
        <div class="alert alert-success alert-dismissible fixed-bottom fade show" style="margin: 30px;" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('info'))
    <div class="container">
        <div class="alert alert-info alert-dismissible fixed-bottom fade show" style="margin: 30px;" role="alert">
            {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('danger'))
    <div class="container">
        <div class="alert alert-danger alert-dismissible fixed-bottom fade show" style="margin: 30px;" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
