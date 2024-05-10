
@if(sizeof($users) !== 0)
    @foreach($users as $key => $row)
    <tr>
        <td>{{ $users->firstItem() + $key}}</td>
        <td><strong>{{ $row->name }}</strong></td>
        <td>{{ $row->username }}</td>
        <td>
            <span class="badge badge-success">{{ $row->level->level }}</span>
        </td>
        <td class="text-center">
            
            <div class="dropdown">
                <a
                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                >
                    <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a hidden class="dropdown-item" href="#"
                        ><i class="dw dw-eye"></i> View</a
                    >
                    <a class="dropdown-item" href="{{url('setting/user/'.$row->id.'/edit')}}"
                        ><i class="dw dw-edit2"></i> Edit</a
                    >
                    <a class="dropdown-item delete_btn" href="#" data-id="{{ $row->id }}" data-name="{{ $row->name }}">
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

@if($users->hasPages())
    <tr>
        <td colspan="5" align="center">
        {!! $users->withQueryString()->links() !!}
        </td>
    </tr>
@endif