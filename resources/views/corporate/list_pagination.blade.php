
@if(sizeof($corporate) !== 0)
    @foreach($corporate as $key => $row)
    <tr>
        <td>{{ $corporate->firstItem() + $key}}</td>
        <td>
            <strong>{{ $row->company }}</strong><br>
            <p class="mb-0">{{$row->number}}</p><br>
            <p class="mb-0">{{$row->address}}</p>
        </td>
        <td>
            <p class="mb-0">{{$row->minicipio->minicipio}}</p><br>
            <p class="mb-0">{{$row->posto->posto}}</p><br>
            <p class="mb-0">{{$row->suco->suco}}</p><br>
            <p class="mb-0">{{$row->aldeia->aldeia}}</p>
        </td>
        <td>
            <strong>{{ $row->commactivity_auth->id_number }}</strong><br>
            <p class="mb-0">{{$row->commactivity_auth->description}}</p>
        </td>
        <td>{{$row->noted}}</td>
        <td>{{ $row->suco }}</td>
        <td class="text-center">
            <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a hidden class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                    <a class="dropdown-item" href="{{url('master/corporate/'.$row->id.'/edit')}}"><i class="dw dw-edit2"></i> Edit</a>
                    <a class="dropdown-item delete_btn" href="#" data-id="{{ $row->id }}" data-name="{{ $row->company }}">
                        <i class="dw dw-delete-3"></i> Delete
                    </a>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="6" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
@endif

@if($corporate->hasPages())
    <tr>
        <td colspan="6" align="center">
        {!! $corporate->withQueryString()->links() !!}
        </td>
    </tr>
@endif