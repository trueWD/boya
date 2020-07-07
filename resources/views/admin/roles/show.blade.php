     
   <!-- Column selectors -->
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">ROLE AİT İZİNLER <span class="text-danger text-uppercase">{{ $role->name }}</span></h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>İzin Adı</th>
                        <th>Açıklama</th>
                        <th>Seçenek</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <input
                                type="checkbox"
                                name="permissionchbox"
                                data-on-text="Evet"
                                data-off-color="danger"
                                data-on-color="success"
                                data-off-text="Hayır"
                                data-size="small"
                                data-role-id="{{ $role->id }}"
                                data-permission-id="{{ $permission->id }}"
                                @if($role->permissions->contains($permission->id)) checked="checked" @endif
                            >
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- /column selectors -->
<script>$("[name='permissionchbox']").bootstrapSwitch();</script>

<script>

    $(document).ready(function() {
        $("[name='permissionchbox']").on('switchChange.bootstrapSwitch',function(){
            var permissionId = $(this).data("permission-id");
            var roleId = $(this).data("role-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method    : "POST",
                url       : "{{ url('admin/roles/changePermission') }}",
                data      : {"roleId":roleId,"permissionId":permissionId },
                dataType  : "JSON",
                success: function(data){
                    new PNotify({
                        title: 'Başarılı!',
                        text: 'İzin başarılı olarak kayıt edildi',
                        addclass: 'alert bg-success border-success alert-styled-left'
                    });
                },
                error: function(){
                    new PNotify({
                        title: 'Hata!',
                        text: 'Ters giden birşeyler var :(' ,
                        addclass: 'alert bg-danger border-danger alert-styled-left'
                    });
                }
            });
        });
    });

</script>
