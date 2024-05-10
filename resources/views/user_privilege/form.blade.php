@extends('layout._template')


@section('page_header_right')
    <a href="{{url('setting/user-privilege')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('setting/user-privilege') : url('setting/user-privilege/'.$userLevel->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($userLevel) ? $userLevel->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Privilege</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="level" type="text" value="{{old('name',isset($userLevel) ? $userLevel->level : '')}}" placeholder="Privilege" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Permissions</label>
            <div class="col-sm-12 col-md-10">
                @isset($menu_parent)
                    @foreach($menu_parent as $in => $p)
                    <div class="mb-2">
                        <p class="mb-0 {{$in > 0 ? 'mt-4' : ''}}"><b>{{$p->name}}</b></p>
                        <hr class="mt-2">
                        @php
                            $menuChild = $menu[$p->name];
                        @endphp
                        @isset($menuChild)
                            @foreach($menuChild as $m)
                                <div class="custom-control custom-checkbox mb-5">
                                    @php
                                        $selected = '';
                                        if(isset($menu_selected) && in_array($m->id,$menu_selected)) $selected = 'checked';
                                    @endphp
                                    <input {{$selected}} name="menu[]" type="checkbox" class="custom-control-input" value="{{$m->id}}" id="check{{$m->id}}">
                                    <label class="custom-control-label" for="check{{$m->id}}">{{$m->name}}</label>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')

@endsection