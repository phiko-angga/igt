
@if(sizeof($worker) !== 0)
    @foreach($worker as $key => $row)
    <tr>
        <td>{{ $worker->firstItem() + $key}}</td>
        <td>
            <strong>{{ $row->name }}</strong><br>
            <p class="mb-0">
                {{$row->phone}}
            </p>
        </td>
        <td>
            <span class="badge badge-pill {{$row->type == 'Local' ? 'bg-success' : 'bg-warning' }}">{{$row->type}}</span>
        </td>
        <td>
            <p class="mb-0">
                <strong>{{ $row->corporate->company }}</strong><br>
                {{$row->corporate->number}}<br>
                {{$row->corporate->address}}<br>
                {{$row->position->name}}
            </p>
        </td>
        <td>
            {{$row->pob}}, {{\Carbon\Carbon::parse($row->dob)->format('d M Y')}}
        </td>
        <td>
            <p class="mb-0">
                <strong>{{ \Carbon\Carbon::parse($row->work_startdate)->format('d M Y') }}</strong><br>
                {{$row->work_period}}
            </p>
        </td>
        <td>
            {{$row->c_university == 1 ? 'University, ' : ''}}
            {{$row->c_institute == 1 ? 'Institute, ' : ''}}
            {{$row->c_diploma == 1 ? 'Diploma, ' : ''}}
            {{$row->c_academy == 1 ? 'Academy, ' : ''}}
            {{$row->c_senior_hs == 1 ? 'Senior High School, ' : ''}}
            {{$row->c_junior_hs == 1 ? 'Junior High School, ' : ''}}
        </td>
        <td>
            {{$row->c_good_behavior_letter == 1 ? 'Good Behavior Letter, ' : ''}}
            {{$row->c_health_certificate == 1 ? 'Health Certificate, ' : ''}}
            {{$row->c_photo_3x4 == 1 ? 'Photo 3x4, ' : ''}}
            {{$row->c_diploma2 == 1 ? 'Diplomas, ' : ''}}
            {{$row->c_birth_certificate == 1 ? 'Birth Certificate, ' : ''}}
            {{$row->c_identity_card == 1 ? 'Identity Card, ' : ''}}
        </td>
        <td class="text-center">
            <div class="dropdown">
                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a hidden class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                    <a class="dropdown-item" href="{{url('transaction/worker/'.$row->id.'/edit')}}"><i class="dw dw-edit2"></i> Edit</a>
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
        <td colspan="9" align="center">
            <h4 class="text-center">No Data Available</h4>
        </td>
    </tr>
@endif

@if($worker->hasPages())
    <tr>
        <td colspan="9" align="center">
        {!! $worker->withQueryString()->links() !!}
        </td>
    </tr>
@endif