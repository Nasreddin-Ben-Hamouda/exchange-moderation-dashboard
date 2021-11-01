@extends("layouts.app",["title"=>"test","activePage"=>"any"])
@section("content")
 @push("js")
  <script type="text/javascript" src="{{ asset("js/statistics/interactions.js") }}"></script>

 @endpush
@endsection

