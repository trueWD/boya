                          
<table class="table table-striped table-bordered table-hover table-sm myDataTable1">
<thead>
    <tr>
        <th>#</th>
        <th>İslem</th>
        <th>Ürün Adı</th>
        <th>Tonaj</th>  
        <th>Boy</th>
        <th>Kalite</th>
        <th>Tolreansi</th>
    </tr>
</thead>
<tbody>
    @foreach($urun02 as $urun)
    <tr>
        <td>{{ $urun->id }}</td>
        <td>
          <button type="button" class="btn btn-primary"><i class="icon-printer"></i></button>
        </td>
        <td>{{ $urun->urunadi }}</td>
        <td>{{ $urun->tonaj }}</td>
        <td>{{ $urun->boy }}</td>
        <td>{{ $urun->kalite }}</td>
        <td>{{ $urun->tolerans }}</td>
    </tr>
    @endforeach
</tbody>
</table>