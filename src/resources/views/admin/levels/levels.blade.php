@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="levels">
        <div class="block-header">
            <div class="block-title">levels</div>
        </div>
        <div class="block-body">
            <div class="table platform levels" id="table-levels">
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
                            <a href="{{url('/admin/levels/add')}}">
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
                            <th style="width: 70px;">points</th>
                            <th style="width: 70px;">color</th>

                        </tr>
                        @if(count($levels) > 0)
                        @foreach($levels as $level)
                            <tr class="table-row">
                                <td class="id table-centered">{{$level->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/levels/'.$level->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/levels/'.$level->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="points">{{$level->points}}</td>
                                <td class="color">{{$level->container_background_color}}</td>
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
