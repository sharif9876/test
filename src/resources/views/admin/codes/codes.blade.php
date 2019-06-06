@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="levels">
        <div class="block-header">
            <div class="block-title">Codes</div>
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
                            <a href="{{url('/admin/codes/add')}}">
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
                            <th style="width: 10px;">id</th>
                            <th style="width: 10px;">actions</th>

                            <th style="width: 10px;">levels</th>
                            <th style="width: 10px;">points</th>
                            <th style="width: 50px;">code</th>
                           

                        </tr>
                        @if(count($codes) > 0)
                        @foreach($codes as $code)
                            <tr class="table-row">
                                <td class="id table-centered">{{$code->id}}</td>
                                <td class="actions"><a class="edit" href="{{url('/admin/codes/'.$code->id.'/edit')}}"><i class="edit fas fa-pencil-alt"></i></a><a class="delete" href="{{url('/admin/codes/'.$code->id.'/delete')}}"><i class="far fa-trash-alt"></i></a></td>
                                <td class="points">{{$code->levels}}</td>
                                <td class="points">{{$code->points}}</td>
                                <td class="level">{{$code->code}}</td>
                               
                               
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
