<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Daftar Master Fisik</h3>
                </div>
                <div class="box-body">
                    <table id="example" class="table table-bordered" datatable="ng">
                        <thead>
                            <tr>
                                <th align="center" valign="middle">No.</th>
                                <th align="center" valign="middle">Nama</th>
                                <th class="aksi" align="center" valign="middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="r in hasils">
                                <td>{{$index+1}}</td>
                                <td>{{r.nama_fisik}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-default">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success">
                                        <i class="fa fa-tags"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>