@extends('layouts.template')

@section('content')
 <div class="block-header">
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-12">                        
            <h2 class="mb-2"><i class="fa fa-dashboard"></i> Dashboard</h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item">Dashboard</li>
            </ul>
        </div>           
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon"><i class="fa fa-leaf" style="color: #009688;"></i> </div>
                        <div class="content">
                            <div class="text">Trilhas</div>
                            <h5 class="number"><a href="{{ url('admin/listar-trilhas') }}">{{ App\Trilha::all()->count() }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card top_counter">
                    <div class="body">
                        <div class="icon"><i class="fa fa-id-card" style="color: orange;"></i> </div>
                        <div class="content">
                            <div class="text">Guias</div>
                            <h5 class="number"><a href="{{ url('admin/listar-guias') }}">{{ App\Guia::all()->count() }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>       
</div>
@endsection