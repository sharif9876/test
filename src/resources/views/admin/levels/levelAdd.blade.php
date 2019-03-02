@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="level-add">
        <div class="block-header">
            <div class="block-title">Level {{ $nextLevel }}</div>
        </div>
        <div class="block-body">
            <div class="form task-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input num task-title">
                            <div class="input-label">
                                <label>points</label>
                            </div>
                            <div class="input">
                                <input type="number" name="level_points" min="{{$points_min}}" value="{{$points_min}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input color task-description">
                            <div class="input-label">
                                <label>color</label>
                            </div>
                            <div class="input">
                                <input type="color" name="level_color">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit" name="task_submit">CREATE LEVEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
