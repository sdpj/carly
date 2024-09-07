<!--
MIT License

Copyright (c) 2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

@extends('layouts.admin', [
    'title' => "Delete \"{$topic->name}\""
])

@section('content')
    <div class="card text-center">
        <div class="card-body">
            <h3>Are you sure that you want to delete this topic?</h3>
            <h4 class="text-danger">This can <strong>NOT</strong> be undone.</h4>
            <hr>
            <form action="{{ route('admin.manage.forum_topics.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $topic->id }}">
                <a href="{{ route('admin.manage.forum_topics.index') }}" class="btn btn-success">No</a>
                <button class="btn btn-danger" type="submit">Yes</button>
            </form>
        </div>
    </div>
@endsection
