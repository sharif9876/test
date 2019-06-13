@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="tasks">
        <div class="block-header">
            <div class="block-title">Tasks</div>
        </div>
        <div class="block-body">
            <div class="table platform tasks" id="table-tasks">
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
                            <a href="{{url('/admin/tasks/add')}}">
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
                            <th style="width: 200px;">title</th>
                            <th style="width: 250px;">description</th>
                            <th style="width: 70px;">level</th>
                            <th style="width: 100px;">points</th>
                            <th style="width: 200px;">start date</th>
                            <th style="width: 200px;">end date</th>
                            <th style="width: 200px;">image_path</th>
                        </tr>
                        @if(count($tasks) > 0)
                        @foreach($tasks as $task)
                            <tr class="table-row">
                                <td class="id table-centered">{{$task->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/tasks/'.$task->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/tasks/'.$task->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="title" title="{{$task->title}}">{{$task->title}}</td>
                                <td class="description" title="{{$task->description}}">{{$task->description}}</td>
                                <td class="level-min table-centered">{{$task->level_min}}</td>
                                <td class="reward-points table-centered">{{$task->reward_points}}</td>
                                <td class="date-start">{{$task->date_start}}</td>
                                <td class="date-end">{{$task->date_end}}</td>
                                <td class="image-path image-hover">/tasks/{{$task->background_image_path}}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr class="table-empty">
                                <td></td>
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
