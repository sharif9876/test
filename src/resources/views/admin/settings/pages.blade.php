@extends('layouts.admin.layout')
@section('stylesheets')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector:'textarea',
            
    });


</script>


@endsection

@section('content')
    <div class="content-block" id="settings_pages">
        <div class="block-header">
            <div class="block-title">Pages settings</div>
        </div>
        <div class="block-body">
            <div class="form pages-settings">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input textarea pages_about_text">
                            <div class="input-label">
                                <label>About page text</label>
                            </div>
                            @if($errors != null && $errors->has('pages_about_text'))
                                <div class="input-errors">
                                    - {{$errors->first('pages_about_text')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="pages_about_text" max="1000">{{$settings['pages_about_text']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea pages_tos_text">
                            <div class="input-label">
                                <label>Terms Of Service page text</label>
                            </div>
                            @if($errors != null && $errors->has('pages_tos_text'))
                                <div class="input-errors">
                                    - {{$errors->first('pages_tos_text')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="pages_tos_text" max="1000">{{$settings['pages_tos_text']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea pages_pp_text">
                            <div class="input-label">
                                <label>Privacy Policy page text</label>
                            </div>
                            @if($errors != null && $errors->has('pages_pp_text'))
                                <div class="input-errors">
                                    - {{$errors->first('pages_pp_text')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="pages_pp_text" max="1000">{{$settings['pages_pp_text']}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit pages-settings-submit">
                            <button class="submit" type="submit" name="pages_settings_submit">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
