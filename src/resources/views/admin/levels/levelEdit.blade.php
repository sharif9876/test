@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="level-add">
        <div class="block-header">
            <div class="block-title">Edit Level: {{$level->level}}</div>
        </div>
        <div class="block-body">
            <div class="form task-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input num level-level">
                            <div class="input-label">
                                <label>level</label>
                            </div>
                            <div class="input">
                                <input type="number" name="level_level" value="{{$level->level}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num level-points">
                            <div class="input-label">
                                <label>points</label>
                            </div>
                            <div class="input">
                                <input type="number" name="level_points" value="{{$level->points}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input color level-color">
                            <div class="input-label">
                                <label>color</label>
                            </div>
                            <div class="input">
                                <input type="color" name="level_color" value="{{$level->container_background_color}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input image level-image">
                            <div class="input-label">
                                <label>background</label>
                            </div>
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="level_image">
                            </div>
                            <div class="preview background-cover shown" style="background-image: url({{asset('images/levels/'.$level->container_background_image_path)}})">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit" name="level_submit">SAVE LEVEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
