@extends('layouts.admin')


@section("content")
<div class="row">
    @can('rubric.index')
    <div class="col-3">

        <div class="card">
            <img class="card-img-top img-circle" src="{{ asset('img/admin/menu/department.png') }}" alt="{{ __('Department') }}">
            <div class="card-footer">
                <a href="{{ route('rubric.index') }}" class="font-weight-800">
                    {{ __('rubric') }}
                </a>
            </div>

        </div>

    </div>
    @endcan

    @can('feedback.index')
    <div class="col-3">

        <div class="card">
            <img class="card-img-top img-circle" src="{{ asset('img/admin/menu/course.png') }}" alt="{{ __('Course') }}">
            <div class="card-footer">
                <a href="{{ route('feedback.index') }}" class="font-weight-800">
                    {{ __('feedback') }}
                </a>
            </div>

        </div>
    </div>
    @endcan
    @can('file.index')
    <div class="col-3">

        <div class="card">
            <img class="card-img-top img-circle" src="{{ asset('img/admin/menu/term.png') }}" alt="{{ __('terms') }}">
            <div class="card-footer">
                <a href="{{ route('file.index') }}" class="font-weight-800">
                    {{ __('Files') }}
                </a>
            </div>
        </div>

    </div>
    @endcan

    @can('document.index')
    <div class="col-3">

        <div class="card">
            <img class="card-img-top img-circle" src="{{ asset('img/admin/menu/session.png') }}" alt="{{ __('Sessions') }}">
            <div class="card-footer">
                <a href="{{ route('document.index') }}" class="font-weight-800">
                    {{ __('document') }}
                </a>
            </div>
        </div>

    </div>
    @endcan

</div>
@endsection