@extends("layout.base")
@section('base.title')
{{$page->page_name}}
@endsection

@section('base.content')
<section id="page" class="flex flex-col px-2">
    {!! $page->page_html !!}
   </div>
</section>
@endsection