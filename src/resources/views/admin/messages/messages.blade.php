@extends('layouts.admin.layout')

@section('content')

    <div class="content-block" id="questions">
        <div class="block-header">
            <div class="block-title">Messages</div>
        </div>
        <div class="block-body">
            <div class="table platform messages" id="table-messages">
                <div class="table-options">
                    <div class="table-search">
                        <input type="text" placeholder="search...">
                    </div>
                    <div class="table-amount">
                        <select>
                            <option value="10" selected>10</option>
                            <option value="25" selected>25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="table-add">
                        <div class="add-button">
                            <a href="{{url('/admin/messages/add')}}">
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
                            <th style="width: 100px;">title</th>
                            <th style="width: 300px;">message</th>
                            <th style="width: 70px;">level</th>
                            <th style="width: 70px;">global</th>
                        </tr>
                        @if(count($messages) > 0)
                        @foreach($messages as $message)
                            <tr class="table-row">
                                <td class="id table-centered">{{$message->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/messages/'.$message->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/messages/'.$message->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="title">{{$message->title}}</td>
                                <td class="message">{{$message->message}}</td>
                                <td class="level-min table-centered">{{$message->level_min}}</td>
                                <td class="global table-centered">@if($message->global) Global @else Unique @endif</td>
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
