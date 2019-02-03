@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="users">
        <div class="block-header">
            <div class="block-title">Users</div>
        </div>
        <div class="block-body">
            <div class="table platform users" id="table-users">
                <div class="table-options">
                    <div class="table-search">
                        <input type="text" placeholder="search...">
                    </div>
                    <div class="table-amount">
                        <select>
                            <option value="10" selected>10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="table-field">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="table-header">
                            <th style="width: 70px;">id</th>
                            <th style="width: 200px;">name</th>
                            <th style="width: 250px;">e-mail</th>
                            <th style="width: 200px;">joined since</th>
                            <th style="width: 100px;">user level</th>
                            <th style="width: 70px;">level</th>
                            <th style="width: 100px;">points</th>
                            @foreach($user_info_types as $type)
                                <th style="width: 150px;">{{$type->name}}</th>
                            @endforeach
                        </tr>
                        @if(count($users) > 0)
                        @foreach($users as $user)
                            <tr class="table-row">
                                <td class="id table-centered">{{$user->id}}</td>
                                <td class="name">{{$user->name}}</td>
                                <td class="email">{{$user->email}}</td>
                                <td class="joined-since">{{$user->created_at}}</td>
                                <td class="user-level">{{$user->userlevel}}</td>
                                <td class="level table-centered">{{$user->level}}</td>
                                <td class="points table-centered">{{$user->points}}</td>
                                @foreach($user_info_types as $type)
                                    <?php $user_info = $user->userInfo->where('question_id', $type->id)->first(); ?>
                                    <td style="width: 150px;"><?php echo $user_info ? $user_info->info : ""; ?></td>
                                @endforeach
                            </tr>
                        @endforeach
                        @else
                            <tr class="table-empty">
                                <td></td>
                                <td class="table-empty-msg">
                                    No items found.
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="table-pagination">
                    <div class="tablep-counter">
                    </div>
                    <div class="tablep-buttons">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
