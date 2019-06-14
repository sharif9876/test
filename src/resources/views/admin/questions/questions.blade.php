@extends('layouts.admin.layout')

@section('content')

    <div class="content-block" id="questions">
        <div class="block-header">
            <div class="block-title">Questions</div>
        </div>
        <div class="block-body">
            <div class="table platform questions" id="table-questions">
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
                            <a href="{{url('/admin/questions/add')}}">
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
                            <th style="width: 100px;">name</th>
                            <th style="width: 300px;">question</th>
                            <th style="width: 70px;">level</th>
                            <th style="width: 70px;">age</th>
                            <th style="width: 70px;">image_path</th>
                        </tr>
                        @if(count($questions) > 0)
                        @foreach($questions as $question)
                            <tr class="table-row">
                                <td class="id table-centered">{{$question->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/questions/'.$question->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/questions/'.$question->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="name">{{$question->name}}</td>
                                <td class="description">{{$question->question}}</td>
                                <td class="level-min table-centered">{{$question->level_min}}</td>
                               

                                <td class="reward-points table-centered">{{$question->age_min}}</td>
                                <td onmousemove="move(event)" onmouseleave="del()" onmouseover="display('/onlineoffline/guestlist/src/public/images/questions/{{$question->background_image_path}}')"  class="image-hover">{{$question->background_image_path}}</td>
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
