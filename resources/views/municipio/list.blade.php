@extends('layout._template')

@section('page_header_right')
    <a href="{{url('master/municipio/create')}}" class="btn btn-primary btn-fw">Add new</a>
@endsection

@section('content')

@include('layout._notification')
<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            
        </div>
		<div class="pull-right">
            <input value="{{isset($search) ? $search : ''}}" type="text" id="search" name="search" class="form-control form-control-sm ms-2" placeholder="Search"  autofocus>
        </div>
    </div>
    <table class="table table-striped list-table">
        <thead>
            <tr>
                <th width="5%"></th>
                <th style="width:20%">Code</th>
                <th style="width:20%">Municipio</th>
                <th style="width:20%">Sort number</th>
                <th class="text-center" style="width:10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @include('municipio.list_pagination')
        </tbody>
    </table>
</div>

@include('helper.modal_confirm')
@endsection

@section('script')
<script>
    
    $(document).on('change','#search', function(){
        fetch_tabledata('/master/municipio');
    })

    $('.delete_btn').click(function(e){
        e.preventDefault();
        var modalConfirm = $('#modal_confirm');
        modalConfirm.find('form').attr('action',"{{url('master/municipio')}}/"+$(this).data('id'));
        modalConfirm.find('#confirm_title').html('Delete municipio ');
        modalConfirm.find('#confirm_titlecaption').html('Are you sure delete municipio ');
        modalConfirm.find('#confirm_titlename').html($(this).data('name'));
        modalConfirm.find('#confirm_titlebtn').html('Delete');
        modalConfirm.find('#id').val($(this).data('id'));
        modalConfirm.modal('show');
    })

</script>
@endsection