@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="level-add">
        <div class="block-header">
            <div class="block-title">Add Level</div>
        </div>
        <div class="block-body">
            <div class="form task-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input num code-code">
                            <div class="input-label">
                                <label>Code</label>
                            </div>
                            @if($errors != null && $errors->has('code_code'))
                                <div class="input-errors">
                                    - {{$errors->first('code_code')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="code_code" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num code-points">
                            <div class="input-label">
                                <label>points</label>
                            </div>
                            @if($errors != null && $errors->has('code_points'))
                                <div class="input-errors">
                                    - {{$errors->first('code_points')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="code_points" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num code-levels">
                            <div class="input-label">
                                <label>levels</label>
                            </div>
                            @if($errors != null && $errors->has('code_levels'))
                                <div class="input-errors">
                                    - {{$errors->first('code_levels')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="code_levels">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-submit code-submit">
                            <button class="submit" type="submit" name="code_submit">CREATE CODE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
