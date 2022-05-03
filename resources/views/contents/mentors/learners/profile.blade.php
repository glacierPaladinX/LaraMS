@extends('layouts.admin')


@section("content")

<x-box.profile-top-header :user="$user" />

<x-box.profile-review-box />

<div class="row">
    <div class="col-7">
        <div class="card shadow mb-4 border-bottom-primary">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ __("Terms") }}</h6>
                <div class="dropdown no-arrow">



                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <x-modules.terms.all :terms="$terms" />
            </div>
        </div>
    </div>


    <div class="col-5">

        <div class="card shadow mb-4 border-bottom-warning">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold ">
                    <i class="fa fa-comment"></i>
                    {{ __('Last Activity') }}

                </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                @forelse($lastActivities as $workout)
                    <x-box.workout-item :workout="$workout" />
                @empty
                @endforelse
            </div>
        </div>

    </div>
</div>


@endsection