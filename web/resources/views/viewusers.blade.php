@extends('template\main')

@section('title')
    View Users
@endsection

@section('content')
    <div class="clearfix">
        <div class="pull-right ">
            <p>
                <a href="/create-user"><button class="btn btn-md btn-success"><i class="ace-icon fa fa-plus"></i> Create New</button></a>
            </p>
        </div>
    </div>
    <table id="simple-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="center">
                    No.
                </th>
                <th class="center">
                    Username
                </th>
                <th class="center">
                    Name
                </th>
                <th class="center">
                    Email
                </th>
                <th class="center">
                    Role
                </th>
                <th class="center">
                    Gender
                </th>
                <th class="center">
                    Address
                </th>
                <th class="center">
                    Settings
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                foreach($user as $u){
                    echo "<tr>";
                    echo "<td class='center'>".$no."</td>";
                    echo "<td class='center'>".@$u['username']."</td>";
                    echo "<td class='center'>".@$u['name']."</td>";
                    echo "<td class='center'>".@$u['email']."</td>";
                    $status = false;
                    foreach($role as $r){
                        if($u['role_id']==$r['_id']){
                            echo "<td class='center'>".@$r['name']."</td>";
                            $status = true;
                        }
                    }
                    if($status==false){
                        echo "<td class='center'></td>";
                    }
                    echo "<td class='center'>".@$u['gender']."</td>";
                    echo "<td class='center'>".@$u['address']."</td>";
                    echo "<td class='center'>";
                    echo "  <a href='/edit-user?_id=".$u['_id']."'>";
                    echo "<button class='btn btn-xs btn-warning'><i class='ace-icon fa fa-pencil'></i> Edit</button>";
                    echo "</a>  ";
                    echo "  <a href='/delete-user?_id=".$u['_id']."'>";
                    echo "<button class='btn btn-xs btn-danger'><i class='ace-icon fa fa-trash'></i> Delete</button>";
                    echo "</a>  ";
                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
            @endphp
        </tbody>
    </table>
@endsection