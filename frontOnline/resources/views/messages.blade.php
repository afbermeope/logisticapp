@if($errors->any())
<div class="card bg-gradient-danger">
    <div class="card-header border-0">
    <h3 class="card-title">
        <i class="fas fa-th mr-1"></i>
        Error: {{ implode('', $errors->all('*:message. ')) }}
    </h3>
    <div class="card-tools">
        <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
        X
        </button>
    </div>
    </div>
</div>
    
@endif
@if($message != null)
    <div class="card bg-gradient-success">
        <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Información: {{$message ?? ''}}
        </h3>

        <div class="card-tools">
            <button type="button" class="btn bg-success btn-sm" data-card-widget="remove">
            X
            </button>
        </div>
        </div>
    </div>
@endif
@if($error != null)
    <div class="card bg-gradient-danger">
        <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Error: {{$error ?? ''}}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
            X
            </button>
        </div>
        </div>
    </div>
@endif