@extends('layouts.admin.layout')

@section('content')

    <div class="content-block" id="questions">
        <div class="block-header">
            <div class="block-title">User Messages</div>
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
                            <a href="{{url('/admin/messages/user/add')}}">
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
                            <th style="width: 70px;">user_id</th>
                            <th style="width: 70px;">message_id</th>
                            <th style="width: 70px;">opened</th>
                         
                        </tr>
                        @if(count($userMessages) > 0)
                        @foreach($userMessages as $userMessage)
                            <tr class="table-row">
                                <td class="id table-centered">{{$userMessage->id}}</td>
                                <td class="actions table-centered"><a class="edit" href="{{url('/admin/messages/user/'.$userMessage->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/messages/user/'.$userMessage->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="user table-centered">{{$userMessage->user_id}}</td>
                                <td class="message table-centered">{{$userMessage->message_id}}</td>
                                <td class="opened table-centered" >@if($userMessage->opened) {{"true"}}@else {{"false"}} @endif</td>
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
