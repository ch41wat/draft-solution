@extends('frontend.frontend')

@section('frontend-title') {{ config('app.name') }} @endsection
@section('frontend-content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('create-form', ['form' => 'customer']) }}" class="btn btn-primary btn-lg">
                            Create draft
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
