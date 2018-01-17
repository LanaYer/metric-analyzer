@extends('layouts.app')

@section('content')
<div class="container">
    <div class="dashboard">
         @if (Auth::guest())
              @include("auth.login")
         @else
             <div class="container">
                 @include("dashboard.index")
             </div>
         @endif
    </div>
</div>
@endsection
