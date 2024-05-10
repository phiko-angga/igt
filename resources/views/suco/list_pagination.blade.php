
@if(sizeof($suco) !== 0)
    @foreach($suco as $key => $row)
    <tr>
        <td>{{ $suco->firstItem() + $key}}</td>
        <td><strong>{{ $row->suco }}</strong></td>
        <td>{{ $row->suco }}</td>
        <td class="text-center">
            <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a hidden class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                    <a class="dropdown-item" href="{{url('master/suco/'.$row->id.'/edit')}}"><i class="dw dw-edit2"></i> Edit</a>
                    <a class="dropdown-item delete_btn" href="#" data-id="{{ $row->id }}" data-name="{{ $row->suco }}">
                        <i class="dw dw-delete-3"></i> Delete
                    </a>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
@endif

@if($suco->hasPages())
    <tr>
        <td colspan="5" align="center">
        {!! $suco->withQueryString()->links() !!}
        </td>
    </tr>
@endif