@extends('layouts.app')
@section('link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://kit.fontawesome.com/a697c89225.js" crossorigin="anonymous"></script>
@endsection
@section('css')
@endsection
@section('content')
@auth
<div class="container">
    <br />
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Aggiungi un cliente</button>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
                <tr>
                    <th width="25%">Nome Referente</th>
                    <th width="25%">Cognome Referente</th>
                    <th width="25%">Partita IVA</th>
                    <th width="25%">Azioni</th>
                </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
</body>

</html>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Aggiunti un nuovo cliente</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Ragione Sociale : </label>
                        <div class="col-md-8">
                            <input type="text" name="ragione_sociale" id="ragione_sociale" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Nome Referente : </label>
                        <div class="col-md-8">
                            <input type="text" name="nome_referente" id="nome_referente" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Cognome Referente : </label>
                        <div class="col-md-8">
                            <input type="text" name="cognome_referente" id="cognome_referente" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Email referente : </label>
                        <div class="col-md-8">
                            <input type="text" name="Email_referente" id="Email_referente" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">SSID : </label>
                        <div class="col-md-8">
                            <input type="text" name="SSID" id="SSID" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">PEC : </label>
                        <div class="col-md-8">
                            <input type="text" name="PEC" id="PEC" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Partita IVA : </label>
                        <div class="col-md-8">
                            <input type="text" name="PIVA" id="PIVA" class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Conferma</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Sei sicuro di voler eliminare questo oggetto?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancella</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('client.index') }}",
            },
            columns: [

                {
                    data: 'nome_referente',
                    name: 'nome_referente'
                },
                {
                    data: 'cognome_referente',
                    name: 'cognome_referente'
                },
                {
                    data: 'PIVA',
                    name: 'PIVA'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $('#create_record').click(function() {
            $('.modal-title').text("Aggiungi un nuovo cliente");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
        });

        $('#sample_form').on('submit', function(event) {
            event.preventDefault();
            if ($('#action').val() == 'Add') {
                $.ajax({
                    url: "{{ route('client.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if ($('#action').val() == "Edit") {
                $.ajax({
                    url: "{{ route('client.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#sample_form')[0].reset();
                            $('#user_table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        $(document).on('click', '.edit', function() {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "/client/" + id + "/edit",
                dataType: "json",
                success: function(html) {
                    $('#ragione_sociale').val(html.data.ragione_sociale);
                    $('#nome_referente').val(html.data.nome_referente);
                    $('#cognome_referente').val(html.data.cognome_referente);
                    $('#Email_referente').val(html.data.Email_referente);
                    $('#SSID').val(html.data.SSID);
                    $('#PEC').val(html.data.PEC);
                    $('#PIVA').val(html.data.PIVA);
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Modifica");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        var user_id;

        $(document).on('click', '.delete', function() {
            user_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function() {
            $.ajax({
                url: "client/destroy/" + user_id,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        $('#user_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

    });
</script>
@endauth
@guest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Good Try</strong> Devi effettuare il login per accedere al contenuto: <a class="btn btn-warning" href="{{ route('login') }}">{{ __('Login') }}</a> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endguest
@endsection