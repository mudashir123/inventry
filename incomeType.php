<?php  include('header.php');
?>


<!-- The Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Income Type</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form class="user" method="post" action="" id="myForm">
                    <input type="hidden" name="saveType" id="saveType" value="1">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="form-group">
                        <label for="bname">Income Type title</label>
                        <input type="text" class="form-control" id="incometypename" name="incometypename">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="insert" id="submit" class="btn btn-primary btn-user">Save Changes</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage <span class="text-s font-weight-bold text-primary mb-1">Income
            Types</span></h1>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
    </div>
</div><br>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <button class="btn btn-primary btn-user" data-toggle="modal" data-target="#myModal">Add Income Types </button>
    </div>
</div><br>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Manage Income Types</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dtable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Income Type Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {


    $('#dtable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        'serverMethod': 'post',

        "ajax": "operation/datatable/incomeType.php",

        'columns': [{
                "data": "id",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                "data": 'incometypename'
            },
            {
                "data": 'status'
            },
            {
                "data": 'action'
            }
        ]
    });
    $("#reset").click(function(e) {
        e.preventDefault();
        $("#incometypename").val("");
        $("#id").val("");
        $("#saveType").val("1");
    });


    function refreshData() {
        $('#dtable').DataTable().ajax.reload();

    }
    $(document).on("click", '#btnEdit', function() {
        $("#saveType").val("2");
        $("#id").val($(this).attr("data-id"));
        $("#incometypename").val($(this).attr("data-incometypename"));
        $("#status").val($(this).attr("data-status"));
        $('#myModal').modal('show');
    });

    $("#submit").click(function(e) {
        e.preventDefault();
        var form = $('form').serialize();
        saveData(form, 'operation/save/incomeType.php');
    });
    $(document).on("click", '#btnDelete', function() {
        var jid = $(this).attr("data-id");
        deleteData(jid, 'operation/delete/incomeType.php')
    });

    function saveData(frm, url) {
        $.ajax({
            type: 'POST',
            url: url,
            data: frm,
            success: function(resp) {
                var status = JSON.parse(resp);
                if (status.code == 1) {
                    $.dreamAlert({
                        'type': 'success',
                        'message': 'Operation completed!',
                        'position': 'right',
                        'summary': 'Data Submitted'
                    });

                    $('#myModal').modal('hide');
                    refreshData();
                    $("#myForm")[0].reset();
                }
            },
            error: function() {
                $.dreamAlert({
                    'type': 'error',
                    'message': 'Data Not Saved',
                    'position': 'right',
                    'summary': 'Data Submitted'
                });
            }
        });
        $("#saveType").val("1");
    }

    function deleteData(did, url) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: did
            },
            success: function(resp) {
                var status = JSON.parse(resp);
                if (status.code == 1) {
                    $.dreamAlert({
                        'type': 'success',
                        'message': 'Data deleted Successfully!',
                        'position': 'right',
                        'summary': 'Data Submitted'
                    });

                    refreshData();
                }
            },
            error: function() {
                $.dreamAlert({
                    'type': 'success',
                    'message': 'Data not deleted !',
                    'position': 'right',
                    'summary': 'Data Submitted'
                });
            }
        });
    }

});
</script>
<?php include('footer.php');?>