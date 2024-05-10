@extends('layout._template')


@section('page_header_right')
    <a href="{{url('setting/user')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('setting/user') : url('setting/user/'.$users->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($users) ? $users->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Fullname</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="name" type="text" value="{{old('name',isset($users) ? $users->name : '')}}" placeholder="Fullname" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Username</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" name="username" type="text" value="{{old('username',isset($users) ? $users->username : '')}}" placeholder="Username" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Privilege</label>
            <div class="col-sm-12 col-md-10">
                <select name="user_level" id="user_level" class="form-control" value="{{$users->user_level}}">
                    <option value="">-- Choose privilege --</option>
                    @isset($levels)
                        @foreach($levels as $l)
                            <option {{isset($users) ? ($users->user_level == $l->id ? 'selected' : '') : ''}} value="{{$l->id}}">{{$l->level}}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Password</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" name="password" type="password" value="" placeholder="********" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Password confirm</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" name="password_confirm" type="password" value="" placeholder="********" />
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
    @include('user/form_js')
@endsection