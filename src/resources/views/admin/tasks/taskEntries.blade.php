@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="task-entries">
        <div class="block-header">
            <div class="block-title">Submitted tasks</div>
        </div>
        <div class="block-body">
            <div class="table platform tasks" id="table-task-entries">
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
                    <div class="table-add">
                        <div class="add-button">
                            <a href="{{url('/admin/tasks/entries/add')}}">
                                <div class="add-left">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="add-right">
                                    ADD
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-field">
                    <table cellpadding="0" cellspacing="0">
                        <tr class="table-header">
                            <th style="width: 70px;">id</th>
                            <th style="width: 70px;">actions</th>
                            <th style="width: 200px;">submit date</th>
                            <th style="width: 120px;">status</th>
                            <th style="width: 200px;">answer</th>
                            <th style="width: 100px;">user</th>
                            <th style="width: 300px;">task</th>
                        </tr>
                        @if(count($task_entries) > 0)
                        @foreach($task_entries as $entry)
                            <tr class="table-row">
                                <td class="id">{{$entry->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/tasks/entries/'.$entry->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/tasks/entries/'.$entry->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="submit-date">{{$entry->date_submit}}</td>
                                <td class="status">{{$entry->status}}</td>
                                <td onmousemove="move(event)" onmouseleave="del()" onmouseover="display('/onlineoffline/guestlist/src/public/images/taskentries/{{$entry->answer}}')" class="answer" title="{{$entry->answer}}">{{$entry->answer}}</td>
                                <td class="user">{{$entry->user->name}}</td>
                                <td class="task">{{$entry->task["title"]}}</td>
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
