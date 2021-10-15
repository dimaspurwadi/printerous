<div align="right">
        <input type="button" id="prev_page" value="<" class="btn btn-white btn-xs btn-bold">
        Hal : <input type="text" name="page_num" id="page_num" size="5" class="page_num apply text-center" value="{{$pageNum}}">
        Dari {{$totalPage}} 
        <input type="hidden" id="total_page" value="<?php echo $totalPage; ?>">
        <input type="button" id="next_page" value=">" class="btn btn-white btn-xs btn-bold">
    </div>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th align="center">
                        No
                    </th>
                    <th style="min-width: 200px; text-align:center">
                        Aksi
                    </th>
                    <th style="min-width: 125px;">
                        Nama
                    </th>
                    <th style="min-width: 125px;">
                        Email
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                ?>
                @foreach($data as $list)
                    <tr>
                        <td>{{$i+$pageStart+1}}</td>
                        <td align="center">
                            <a class="btn delete" data-toggle="modal" data-toggle="tooltip" title="Hapus" data-target="#modal-delete" id="{{$list->id}}" name="{{$list->name}}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a class="btn btn-sm grey-cascade" href="{{$baseUrl.'/user/form?id='.$list->id.''}}" data-toggle="tooltip" title="Ubah">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->email }}</td>
                    </tr>
                    <?php
                        $i++;
                    ?>
                @endforeach
                
            </tbody>
        </table>
    
    </div>
    