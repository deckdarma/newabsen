<table class="table table-striped custom-table m-b-0">
    <thead>
    <tr>
        <th>Employee</th>
        @for($i =1; $i <= $daysInMonth; $i++)
            <th>{{ $i }}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($employeeAttendence as $key => $datashift)
        <tr>
            <td> {{ substr($key, strripos($key,'#')+strlen('#')) }} </td>
            @foreach($datashift as $day)
                <td>{!! $day !!}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
