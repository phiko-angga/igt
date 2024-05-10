
<div class="page-header">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="title">
				<h4>@isset($breadcrumb) {{$breadcrumb[count($breadcrumb)-1]}} @endisset</h4>
			</div>
			<nav aria-label="breadcrumb" role="navigation">
				<ol class="breadcrumb">
                    @isset($breadcrumb)
                        @foreach($breadcrumb as $index => $item)
                            @if($index < (count($breadcrumb)-1 ))
                            <li class="breadcrumb-item">
                                <a href="index.html">{{$item}}</a>
                            </li>
                            @else
                            <li class="breadcrumb-item active" aria-current="page">
                                {{$item}}
                            </li>
                            @endif
                        @endforeach
                    @endisset
				</ol>
			</nav>
		</div>
        <div class="col-md-6 col-sm-12 text-right">
            @yield('page_header_right')
        </div>
	</div>
</div>