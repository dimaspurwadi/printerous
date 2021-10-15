<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th align="center">
                    No
                </th>
                <th style="text-align:center">
                    Aksi
                </th>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Phone
                </th>
                <th>
                    Avatar
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
            ?>
            @foreach($data as $list)
                <tr>
                    <td>{{$no}}</td>
                    <td align="center">
                        <a class="btn delete" data-toggle="modal" data-toggle="tooltip" title="Hapus" data-target="#modal-delete" id="{{$list->id}}" name="{{$list->name}}">
                            <i class="fa fa-trash"></i>
                        </a>
                        <a class="btn btn-sm grey-cascade edit" data-toggle="modal" data-toggle="tooltip" title="Ubah" data-target="#modal-edit" id="{{$list->id}}" name="{{$list->name}}">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->email }}</td>
                    <td>{{ $list->phone }}</td>
                    <td><img src="{{ asset('uploads/file/'.$list->avatar.'') }}" style="width:5em"></td>
                </tr>
                <?php
                    $no++;
                ?>
            @endforeach
        </tbody>
    </table>
</div>
