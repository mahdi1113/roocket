@extends('admin.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              {{ $breadcrumb }}
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            @include('message')
            </div>
            {{ $slot }}
        </div>
        </div>
      </section>
    </div>

@endsection

@section('script')
{{ $script ?? '' }}
@endsection